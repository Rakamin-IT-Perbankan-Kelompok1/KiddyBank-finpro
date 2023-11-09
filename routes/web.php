<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\InlinesOnly\ChildRenderer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['NoAuth']], function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::get('/', [LoginController::class, 'indexLogin']);
    Route::get('/signup', [LoginController::class, 'indexDaftar']);
    Route::post('/daftar', [LoginController::class, 'daftar']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/enterOTP', [ChildController::class, 'showOTP']);
    Route::post('/verifyOTP', [ChildController::class, 'verifyOTP']);
    // Route::post('verifyOTP', [ChildController::class,'verifyOTP']);

});


// masuk ke dashboard
Route::group(['middleware' => ['Auth']], function () {
    Route::get('dashboard', [AdminController::class, 'index']);
    Route::get('transfers', [TransferController::class, 'index']);
    Route::post('/transfer', [TransferController::class,'transfer']);
    Route::get('logout', [LoginController::class, 'logout']);
    Route::get('profile', [LoginController::class, 'profile']);
    Route::put('update_profile', [LoginController::class, 'update_profile']);
    Route::get('transaction', [TransactionController::class,'index']);
    Route::get('registerKids', [ChildController::class,'registerKids']);
    Route::post('registerChild', [ChildController::class,'registerChild']);
    
    // Route::post('/verifyOTP', [ChildController::class, 'verifyOTP'])->name('verifyOTP');
   
    // login sebagai admin
    Route::group(['middleware' => ['HanyaAdmin']], function (){
        Route::get('user', [UserController::class, 'index']);
        Route::get('user', [AdminController::class, 'tampil_user']);  
    });


    // login sebagai user
});