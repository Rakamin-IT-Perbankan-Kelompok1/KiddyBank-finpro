<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountBank;
use App\Models\Child;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Users_Data;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //dd(session('id_accountbank'));
        $data = Transaction::paginate(3);

        //data untuk menampilkan transaksi oleh anak saja
        $data_child = DB::table('transactions')
            ->join('bankaccount', 'bankaccount.id', '=', 'transactions.id_bankaccount')
            ->where('id_bankaccount', '=', session('id_accountbank'))
            ->where('account_type', '=', session('account_type'))
            ->get('transactions.*');

        //data untuk menampilkan transaksi yang dilakukan oleh anak dan orang tua
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

        //untuk mengambil data bankaccount dan menampilkannya pada dashboard
        $data_account_child = DB::table('bankaccount')
            ->join('child', 'child.id', '=', 'bankaccount.user_id')
            ->join('users', 'users.id', '=', 'child.id_user')
            ->where('users.id', '=', session('id'))
            ->where('bankaccount.account_type', '=', 'Child')
            ->get(['child.*', 'bankaccount.account_number', 'bankaccount.balance']);


        //untuk memberikan data pada chart.js
        $weeklyTransactions = DB::table('transactions')
            ->select(DB::raw('SUM(amount) as total_amount'), DB::raw('WEEK(created_at) as week_number'))
            ->where('id_bankaccount', '=', session('id_accountbank'))
            ->groupBy(DB::raw('WEEK(created_at)'))
            ->get();

        $data_pengeluaran = [];
        $total = 0;

        foreach ($weeklyTransactions as $transaction) {
            $total += $transaction->total_amount;
            $data_pengeluaran[] = $transaction->total_amount;
        }

        //untuk mengembalikan tampilan dashboard dan 'data', 'data_parent', 'data_child', 'total', 'data_pengeluaran', 'data_account_child'
        return view('pages.index', compact('data', 'data_parent', 'data_child', 'total', 'data_pengeluaran', 'data_account_child'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tampil_user(Request $request)
    {
        $data = Users_Data::all();
        return view('pages.user')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
