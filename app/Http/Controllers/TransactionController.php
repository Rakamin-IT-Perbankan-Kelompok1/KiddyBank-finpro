<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(session('id_accountbank'));
        // $data = Transaction::where('senderType', '=', session('role'));
        $data_child = DB::table('transactions')
            ->join('bankaccount', 'bankaccount.id', '=', 'transactions.id_bankaccount')
            ->where('id_bankaccount', '=', session('id_accountbank'))
            ->where('account_type', '=', session('account_type'))
            ->get('transactions.*');

        $data_parent = DB::table('transactions')
            ->join('bankaccount', 'bankaccount.id', '=', 'transactions.id_bankaccount')
            ->join('child', 'child.id', '=', 'bankaccount.user_id')
            ->join('users', 'users.id', '=', 'child.id_user')
            ->where('users.id', '=', session('id'))
            ->where(function ($query) {
                $query->where('bankaccount.account_type', '=', 'Child')
                    ->orWhere('bankaccount.account_type', '=', 'Parent');
            })
            ->get(['transactions.*', 'bankaccount.account_number', 'bankaccount.balance']);

        // dd($data_parent);



        // Pass $transactions to the view
        return view('pages.transaction', compact('data_child', 'data_parent'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_transaction)
    {
        $transaction = Transaction::find($id_transaction);

        if (!$transaction) {
            // Handle jika transaksi tidak ditemukan
            return redirect()->route('transactions.index')->with('error', 'Transaksi tidak ditemukan');
        }
        return view('transaction.show')->with('data', $transaction);
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
