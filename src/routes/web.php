<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


use App\Providers\FortifyServiceProvider;

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

Route::get('/', function () { return view('welcome'); });


Route::get('/', [ItemController::class, 'index']);

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/verify', [AuthController::class, 'verify']);

Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/purchase/address', [ItemController::class, 'addressForm']);
Route::post('/purchase/address', [ItemController::class, 'addressSet']);
Route::get('/item/{item_id}', [ItemController::class, 'item'])->name('item');
Route::get('/purchase/{item_id}', [ItemController::class, 'purchaseForm']);
Route::post('/purchase', [ItemController::class, 'purchase']);

Route::get('/sell', [ItemController::class, 'sellForm']);
Route::post('/sell', [ItemController::class, 'store']);

Route::get('/mypage', [UserController::class, 'mypage']);
Route::get('/mypage/profile', [UserController::class, 'profile']);