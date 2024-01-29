<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Auth;
use App\Mail\SendOTP;
use App\Models\AccountBank;
use App\Models\Child;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Users_Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function registerKids(Request $request)
    {

        
        session([
            'id' => session()->get('id'),
        ]);

        // dd(session('id'));

        return view("pages.registerKids");
    }

    //function untuk membuat akun seorang anak
    public function registerChild(Request $request)
    {
        
        
        $request->validate([
            'child_username' => 'required|max:255|unique:child,child_username',
            'child_fullname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|numeric',
            'address' => 'required|max:255',
            'password' => 'required',
        ], [
            'child_username.required' => 'username harus diisi',
            'child_username.max' => 'karakter username terlalu panjang',
            'child_username.unique' => 'nama sudah ada',

            'child_fullname.required' => 'fullname harus diisi',
            'child_fullname.max' => 'karakter fullname terlalu panjang',

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
        //membuat expired untuk otp
        $today = date("Y-m-d H:i:s"); // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
        $expired = date("Y-m-d H:i:s", strtotime($today . " +1 day"));

        //melakukan hashing password
        $password = Hash::make($request->password);

        $user = new Child();

        $user->id_user = session('id');
        $user->child_username = $request->child_username;
        $user->child_fullname = $request->child_fullname;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->address = $request->address;
        $user->password = $password;
        $user->expired_otp = $expired;
        $user->activated = '0';
        
        //membuat generate code otp
        $otp = mt_rand(100000, 999999); // Generate a 6-digit OTP
        $user->otp = $otp;


        //mengirimkan otp ke email
        // $data = [
        //     'email' => $request->email,
        //     'otp' => $otp,
        //     'fullname' => $request->fullname,
        // ];
        // Mail::to($request->email)->send(new SendOTP($data));

        $user->save();

       
        $account = new AccountBank();
        $account->user_id = $user->id;

        //untuk menggenate unique account number pada bankaccount
        $bankCode = '0001'; 
        $randomNumbers = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $id = str_pad($user->id, 5, '0', STR_PAD_LEFT); 
        $accountNumber = $bankCode . $randomNumbers . $id;

        $account->account_type = "Child";
        $account->account_number = $accountNumber;
        $account->balance = 500000; 
        $account->save();

            return redirect()->to('/dashboard')->with('success', 'data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'data gagal ditambahkan');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    //function untuk menampilkan tampilan vcheck otp 
    public function showOTP(Request $request)
    {

        if(request()->path() == '/enterOTP' && $request->email == null)
        {
            return redirect()->to('/');

        }

      
        return view('Auth.registerChildOTP');
    }

    //function untuk mengecek apakah otp sudah sesuai apa belum
    public function verifyOTP(Request $request)
    {
        // dd('sasa');
        $id = session('id');
        // dd('sasa');
        $user = Child::where('id', '=', $id)->first();

        $otpString = implode('', $request->otp);
        if ($user->otp === $otpString) {
            session([

                'login' => true,
                'username' => $user->child_username,
                'fullname' => $user->child_fullname,
                'email' => $user->email,
                'role' => 'Child',
                'id' =>  $user->id,
                'otp' => $user->otp,
            ]);
            // OTP is valid, proceed with verification
            // $db = DB::table('users')
            // ->select('*')
            // ->join('bankaccount','bankaccount.user_id','=','users.id')
            // ->join('child', 'child.id_user', '=', 'users.id')
            // ->join('transactions', 'transactions.acountNumber', '=', 'bankaccount.account_number')
            // ->where('users.id', '=', $user->id)
            // ->get('users.*');
            $user->activated = '1';  
            $user->save();
            $data = Transaction::paginate(3);
            return redirect()->to('dashboard')->with('success', 'OTP verification successful');
        } else {
            // dd('sasas')
            return back()->with('error', 'Invalid OTP. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
