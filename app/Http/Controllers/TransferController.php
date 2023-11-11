<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountBank;
use App\Models\Child;
use App\Models\Transaction;
use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $child = Child::select('*')
        ->where('id_user', '=', session('id'))
        ->get('child.*');

        // dd(session('account_type'));

        
        $parent = DB::table('users')
        ->select('*')
        ->join('bankaccount','bankaccount.user_id','=','users.id')
        ->join('child','child.id','=','users.id')
        ->where('users.id', '=', session('id'))
        ->where('bankaccount.account_type','=', session('account_type'))
        ->get('users.*');

        // dd($parent);
        return view('pages.transfer', compact('child', 'parent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function transfer(Request $request)
    {
        // dd($request->all());
     
        // $request->validate([
        //     'acountNumber' => 'required|max:255',
        //     'recipientAccount' => 'required|max:255',
        //     'amount' => 'required|numeric',
        //     'senderName' => 'required|max:255',
        //     'recipientName' => 'required|max:255',
        //     'customerReferences'=> 'required|max:255',
        // ], [
        //     'acountNumber' => 'account harus diisi',
        //     'acountNumber' => 'karakter account terlalu panjang',

        //     'recipientAccount' => 'recipientAccount harus diisi',
        //     'recipientAccount' => 'karakter recipientAccount terlalu panjang',

        //     'amount' => 'amount harus diisi',
        //     'amount' => 'amount harus diisi angka',

        //     'senderName' => 'senderName harus diisi',
        //     'senderName' => 'karakter senderName terlalu panjang',

        //     'recipientName' => 'recipientName harus diisi',
        //     'recipientName' => 'karakter recipientName terlalu panjang',

        //     'customerReferences' => 'customerReferences harus diisi',
        //     'customerReferences' => 'karakter customerReferences terlalu panjang',
        // ]);
        // dd(session('account_number'));
             
        // try {
            // Lakukan proses transfer
            $bank = Child::where('id', '=', $request->recepientName);
            
           
        
            $transaction = new Transaction();
            $today = Carbon::now();
            $formattedDateTime = $today->format('Y-m-d');
            $bank = AccountBank::where('id','=', session('id'));

            $transaction->acountNumber = $request->input('acountNumber');
            $transaction->recipientAccount = $request->input('recipientAccount');
            $transaction->amount = $request->input('amount');
            $transaction->id_bankaccount = session()->get('id_accountbank');
            $transaction->senderName = $request->input('senderName');
            $transaction->recepientName = $request->recepientName;
            // dd(session('account_type'));
            $transaction->transaction_status = 'success';
            $transaction->senderType = session('account_type');
            $transaction->created_at = $formattedDateTime;
            $transaction->save();

        //    dd($transaction->id_bankaccount);
            

            // Contoh: Validasi saldo cukup untuk transfer
            $senderBalance = AccountBank::where('account_number', $transaction->acountNumber)->value('balance');
          
        
            if ($senderBalance < $transaction->amount) {
                return back()->with('error', 'Saldo tidak mencukupi untuk transfer');
            }
          

            // Update saldo akun sumber dan akun tujuan
            AccountBank::where('account_number', $transaction->acountNumber)->decrement('balance', $transaction->amount);
            AccountBank::where('account_number', $transaction->recipientAccount)->increment('balance', $transaction->amount);

           

        //     // Redirect dengan pesan sukses
            return redirect()->to('dashboard')->with('success', 'Transfer berhasil dilakukan');
        // } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'gagal brow'); // Assuming you have a view file for creating posts
        // }
    }

   
    public function show(string $id)
    {
        // Mengambil data transfer dari database berdasarkan ID
        $transfer = Transfer::find($id);

        // Periksa apakah data ditemukan
        if ($transfer) {
            return view('pages.transfer', ['transfer' => $transfer]);
        } else {
            return redirect()->route('transfers.index')->with('error', 'Transfer tidak ditemukan');
        }
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
        // Validate the input
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        // Find the Transfer record by its ID
        $transfer = Transfer::find($id);

        if (!$transfer) {
            return redirect()->route('transfers.index')->with('error', 'Transfer not found');
        }

        // Update the amount field in the Transfer record
        $transfer->amount = $request->input('amount');
        $transfer->save();

        return redirect()->route('transfers.index')->with('success', 'Transfer updated successfully');
    }
    //


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
