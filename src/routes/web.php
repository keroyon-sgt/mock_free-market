<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/item', [ItemController::class, 'item']);
Route::get('/purchase', [ItemController::class, 'confirm']);
Route::post('/purchase', [ItemController::class, 'purchase']);
Route::get('/purchase/address', [ItemController::class, 'deliveryForm']);
Route::post('/purchase/address', [ItemController::class, 'delivery']);

Route::get('/sell', [ItemController::class, 'item']);
Route::post('/sell', [ItemController::class, 'store']);

Route::get('/mypage', [UserController::class, 'mypage']);
Route::get('/mypage/profile', [UserController::class, 'profile']);