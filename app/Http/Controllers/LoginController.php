<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountBank;
use App\Models\User;
use App\Models\Users_Balance;
use App\Models\Users_Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Auth.index');
    }

    public function indexLogin()
    {
        return view('Auth.login');
    }

    public function indexDaftar()
    {
        return view('Auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255|unique:users,username',
            'fullname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|numeric',
            'address' => 'required|max:255',
            'password' => 'required',
        ], [
            'username.required' => 'username harus diisi',
            'username.max' => 'karakter username terlalu panjang',
            'username.unique' => 'nama sudah ada',

            'fullname.required' => 'fullname harus diisi',
            'fullname.max' => 'karakter fullname terlalu panjang',

            'email.required' => 'email harus diisi',
            'email.email' => 'email tidak valid',
            'email.max' => 'karakter email terlalu panjang',

            'telephone.required' => 'telephone harus diisi',
            'telephone.numeric' => 'telephone harus diisi dengan angka',

            'address.required' => 'alamat harus diisi',
            'address.max' => 'karakter alamat terlalu panjang',

            'password.required' => 'password harus diisi',
        ]);

        // try {
        $password = Hash::make($request->password);

        $user = new User();
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->address = $request->address;
        $user->password = $password;

        if ($user->username == 'admin') {
            $user->role = 'admin';
        } else {
            $user->role = 'parent';
        }
        $user->save();


        // dd($accountNumber);

        // Create an account entry in the accountbank table
        $account = new AccountBank();
        $account->id = $user->id;

        // Generate a unique account number
        $bankCode = '0001'; // Replace with your actual bank code
        $randomNumbers = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $id = str_pad($user->id, 5, '0', STR_PAD_LEFT); // Assuming user ID is unique
        $accountNumber = $bankCode . $randomNumbers . $id;

        $account->account_number = $accountNumber;
        $account->balance = 500000; // You can initialize the balance as needed
        $account->save();

        return redirect()->to('/')->with('success', 'data berhasil ditambahkan');
        // } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'data gagal ditambahkan');
        // }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required'
        ], [
            'email.required' => 'email harus diisi',
            'email.email' => 'email tidak valid',
            'email.max' => 'karakter email terlalu panjang',

            'password.required' => 'password harus diisi'
        ]);

        $email = $request->email;
        $password = $request->password;

        $result = User::where('email', $email)->first();
        if ($result) {
            if (password_verify($password, $result->password)) {
                if ($result->role == "admin") {
                    $level = "admin";
                } else {
                    $level = "parent";
                }

                $userBalance = AccountBank::where('id', $result->id)->first();
                $accountNumber = $userBalance->account_number; 
                $date = date('Y-m-d', strtotime($result->created_at));
                if ($userBalance) {
                    $balanceAmount = $userBalance->balance;
                } else {
                    $balanceAmount = 0;
                }
                
                session([
                    'login' => true,
                    'username' => $result->username,
                    'fullname' => $result->fullname,
                    'email' => $result->email,
                    'role' => $level,
                    'id' =>  $result->id,
                    'balance' => $balanceAmount,
                    'account_number' => $accountNumber,
                    'date' => $date,
                ]);

                return redirect()->to('dashboard');
            } else {
                return redirect()->to('/')->with('error', 'Email Atau Password Salah');
            }
        } else {
            return redirect()->to('/')->with('error', 'akun tidak ditemukan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        session()->flush();
        return redirect()->to('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('pages.profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request)
    {
        $request->validate([
            'nama'  =>  'required|max:255',
            'email' => 'required|email|max:255'
        ], [
            'nama.required' =>  'nama harus diisi',
            'nama.max' =>  'karakter nama terlalu panjang',
            'email.required' =>  'email harus diisi',
            'email.email'   =>  'email tidak valid',
            'email.max' =>  'karakter email terlalu panjang',
        ]);

        try {
            User::where('id', session()->get('id'))->update([
                'username'  =>  $request->username,
                'email' => $request->email
            ]);
            $id = session()->get('id');

            $result = User::where('id', session()->get('id'))->first();
            session()->forget('username');
            session()->forget('email');
            session([
                'username'  =>  $result->username,
                'email' =>  $result->email
            ]);

            return redirect()->back()->with('success', 'data berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
