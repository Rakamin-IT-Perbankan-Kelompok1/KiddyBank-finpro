<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendOTP;
use App\Models\AccountBank;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function registerKids()
    {
        return view("pages.registerKids");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function registerChild(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255|unique:child,username',
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
            $today = date("Y-m-d H:i:s"); // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
            $expired = date("Y-m-d H:i:s", strtotime($today . " +1 day"));
            $password = Hash::make($request->password);

            $user = new Child();
            $user->id_user = session()->get('id');
            $user->username = $request->username;
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->telephone = $request->telephone;
            $user->address = $request->address;
            $user->password = $password;
            $user->expired_otp = $expired;
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

            $account->account_type = "Child";
            $account->account_number = $accountNumber;
            $account->balance = 500000; // You can initialize the balance as needed
            $account->save();

            $data = [
                'email' => $request->email,
                'fullname' => $request->fullname,
            ]; // Data yang ingin Anda sertakan dalam email
            Mail::to($request->email)->send(new SendOTP($data));

            return redirect()->to('/dashboard')->with('success', 'data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'data gagal ditambahkan');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function otp(Request $request)
    {
        return view("Auth.registerChildOTP");
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
