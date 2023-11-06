<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.transfer');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    return view('pages.transfer'); // Assuming you have a view file for creating posts


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'sender_account' => 'required',
            'recipient_account' => 'required',
            'amount' => 'required|numeric',
        ]);

        // Lakukan proses transfer
        $senderAccount = $request->input('sender_account');
        $recipientAccount = $request->input('recipient_account');
        $amount = $request->input('amount');

        // Contoh: Validasi saldo cukup untuk transfer
        $senderBalance = Account::where('account_number', $senderAccount)->value('balance');

        if ($senderBalance < $amount) {
            return back()->with('error', 'Saldo tidak mencukupi untuk transfer');
        }

        // Lakukan transfer dan update saldo
        // Anda perlu menyesuaikan kode berikut dengan struktur database Anda
        // Misalnya, Anda bisa menggunakan Eloquent atau query builder
        Transfer::create([
            'sender_account' => $senderAccount,
            'recipient_account' => $recipientAccount,
            'amount' => $amount,
        ]);

        // Update saldo akun sumber dan akun tujuan
        Account::where('account_number', $senderAccount)->decrement('balance', $amount);
        Account::where('account_number', $recipientAccount)->increment('balance', $amount);

        // Redirect dengan pesan sukses
        return redirect()->route('transfer')->with('success', 'Transfer berhasil dilakukan');
    }

    /**
     * Display the specified resource.
     */
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
