<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        $data = Transaction::paginate(3);
        
        $result = User::where('email', session('email'))->first();
        $child = Child::where('email', session('email'))->first();

        $transa = Transaction::all();

        $db = DB::table('users')
        ->select('*')
        ->join('bankaccount','bankaccount.user_id','=','users.id')
        ->join('child', 'child.id_user', '=', 'users.id')
        ->join('transactions', 'transactions.acountNumber', '=', 'bankaccount.account_number')
        ->where('users.id', '=', $result->id)
        ->get('users.*');

        
        return view('pages.index', compact('data', 'db', 'transa'));
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
