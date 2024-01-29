<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendOTP;
use App\Models\AccountBank;
use App\Models\Child;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Users_Balance;
use App\Models\Users_Data;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

        try {
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
            $account->user_id = $user->id;

            // Generate a unique account number
            $bankCode = '0001'; // Replace with your actual bank code
            $randomNumbers = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $id = str_pad($user->id, 5, '0', STR_PAD_LEFT); // Assuming user ID is unique
            $accountNumber = $bankCode . $randomNumbers . $id;

            $account->account_type = $user->role;
            $account->account_number = $accountNumber;
            $account->balance = 500000; // You can initialize the balance as needed
            $account->save();

            return redirect()->to('/')->with('success', 'data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'data gagal ditambahkan');
        }
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
        $child = Child::where('email', $email)->first();
        

        if ($result && !$child) {
            if (password_verify($password, $result->password)) {
                if ($result->role == "admin") {
                    $level = "admin";
                } elseif ($result->role == "parent") {
                    $level = "parent";
                } else {
                    return redirect("/")->with("error", "Role Not Found");
                }
                $id_bank = DB::table('bankaccount')
                ->join('users','users.id','=','bankaccount.user_id')
                ->where('user_id','=', $result->id )
                ->where('account_type','=','parent' )
                ->get('bankaccount.*');

               
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
                    'account_type'=> $id_bank[0]->account_type,
                    'id' =>  $result->id,
                    'balance' => $balanceAmount,
                    'id_accountbank'=> $id_bank[0]->id,
                    'account_number' => $accountNumber,
                    'date' => $date,
                ]);
               
                $data = Transaction::paginate(3);
                // dd($result->id);
               
                // dd($db);   

                return redirect('dashboard');
            } else {
                return redirect()->to('/')->with('error', 'Email Atau Password Salah');
            }
        } else if ($child && !$result) {

            try {
                session([
                    'otp' => $child->otp,
                    'id' => $child->id
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }

            if (password_verify($password, $child->password)) {

                // dd(session($child->otp));
                if (!empty($child->otp)) {
                    // dd(!empty($child->otp));
                    // dd($child->otp);
                    // Send the OTP to the user via email
                    
                    // Jika pengguna "Child" belum memiliki OTP, buat OTP baru dan simpan ke database
                    // dd($child->otp);
                    // $child->save();
                    // dd($request->otp)
                    // dd('sasa');
                    
                    if ($child->activated == 1) {
                        $id_bank = DB::table('bankaccount')
                            ->join('child','child.id','=','bankaccount.user_id')
                            ->where('user_id', '=', $child->id )
                            ->where('account_type','=','Child' )
                            ->get('bankaccount.*');

                        // dd($id_bank[0]->account_type);
                            
                            
                        $userBalance = AccountBank::where('id', $child->id)->first();
                        $accountNumber = $userBalance->account_number;
                        $date = date('Y-m-d', strtotime($child->created_at));
                        if ($userBalance) {
                            $balanceAmount = $userBalance->balance;
                        } else {
                            $balanceAmount = 0;
                        }

                        session([

                            'login' => true,
                            'username' => $child->child_username,
                            'fullname' => $child->child_fullname,
                            'email' => $child->email,
                            'role' => 'Child',
                            'id_user' => $child->id_user,
                            'id' =>  $child->id,
                            'otp' => $child->otp,
                            'account_type' => $id_bank[0]->account_type,
                            'account_number' => $accountNumber,
                            'id_accountbank'=> $id_bank[0]->id,
                            'date' => $date,
                        ]);
                        
                        $data = Transaction::paginate(3);
                        return redirect('dashboard');
                    }

                    return redirect()->to('/enterOTP')->with('success');
                } else {
                    // Jika pengguna "Child" sudah memiliki OTP, periksa apakah OTP yang dimasukkan benar
                    $userBalance = AccountBank::where('id', $child->id)->first();
                            //   dd('');
                            $id_bank = DB::table('bankaccount')
                            ->join('child','child.id','=','bankaccount.user_id')
                            ->where('user_id', '=', $child->id )
                            ->where('account_type','=','Child' )
                            ->get('bankaccount.*');

                    session([
                        'login' => true,
                        'username' => $child->child_username,
                        'fullname' => $child->child_fullname,
                        'email' => $child->email,
                        'role' => 'Child',
                        'id_user' => $child->id_user,
                        'id' =>  $child->id,
                        'otp' => $child->otp,
                        'account_type' =>$id_bank[0]->account_type,
                        'account_number' => $userBalance->account_number,
                        'id_accountbank'=> $id_bank[0]->id,
                    ]);
                    if ($child->otp == $request->otp) {
                        
                        // Hapus OTP dari database
                        // $child->otp = null;
                        $child->activated = 1;
                        $child->save();
                        return redirect()->to('dashboard');
                    } else {
                        return redirect()->to('enterOTP')->with('error', 'Invalid OTP. Please try again.');
                    }
                }
                // $userBalance = AccountBank::where('id', $result->id)->first();
               
                // $accountNumber = $userBalance->account_number;
                // $date = date('Y-m-d', strtotime($result->created_at));
                // if ($userBalance) {
                //     $balanceAmount = $userBalance->balance;
                // } else {
                   


                // }
                $id_bank = DB::table('bankaccount')
                ->join('child','child.id','=','bankaccount.user_id')
                ->where('user_id', '=', $child->id )
                ->where('account_type','=','Child' )
                ->get('bankaccount.*');

                $balanceAmount = 0;

                session([

                    'login' => true,
                    'username' => $child->username,
                    'fullname' => $child->fullname,
                    'email' => $child->email,
                    'role' => 'Child',
                    'id_user' => $child->id_user,
                    'id' =>  $child->id,
                    'balance' => $balanceAmount,
                    'id_accountbank'=> $id_bank[0]->id,
                    'account_number' => $id_bank[0]->accountNumber,
                    'otp' => $child->otp,
                    'account_type' =>$id_bank[0]->account_type,
                    // 'date' => $date,
                ]);

                $data = Transaction::paginate(3);
                // dd($data);

                return view('pages.index', ['data' => $data]);
                // return redirect('Auth.registerChildOTP');
            } else {
                return redirect('/')->with('error', 'Email Atau Password Salah');
            }
        } else {
            return redirect('/')->with('error', 'akun tidak ditemukan');
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

        // try {
        //     User::where('id', session()->get('id'))->update([
        //         'username'  =>  $request->username,
        //         'email' => $request->email
        //     ]);
        //     $id = session()->get('id');

        //     $result = User::where('id', session()->get('id'))->first();
        //     session()->forget('username');
        //     session()->forget('email');
        //     session([
        //         'username'  =>  $result->username,
        //         'email' =>  $result->email
        //     ]);

        //     return redirect()->back()->with('success', 'data berhasil diupdate');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('error', 'data gagal diupdate');
        // }
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
