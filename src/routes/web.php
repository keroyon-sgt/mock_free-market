<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\MailSendController;

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

Route::get('/register', [UserController::class, 'registerForm']);
Route::post('/register', [UserController::class, 'register']);


Route::get('/verify', [UserController::class, 'verify']);

//---------------------------------------------------------------------
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', '確認メールを再送信しました。');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Route::get('/mail', [MailSendController::class, 'index']);
//---------------------------------------------------------------------

Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//----------------------------------------------------------

// Route::group(['middleware' => 'guest'], function () {
//     // ログイン画面
//     Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
// });

//メール認証
// Route::get('/register', [UserController::class, 'registerForm'])
//     ->middleware(['auth', 'verified']);


// Route::middleware('auth')->group(function () { Route::get('/', [AuthController::class, 'index']); });

//-------------------------------------------


Route::get('/purchase/address', [ItemController::class, 'addressForm']);
Route::post('/purchase/address', [ItemController::class, 'addressSet']);

Route::get('/item/{item_id}', [ItemController::class, 'item'])->name('item');
Route::post('/item/{item_id}', [ItemController::class, 'comment']);

Route::get('/like/{item_id}', [ItemController::class, 'like']);

Route::get('/search', [ItemController::class, 'search']);


Route::get('/purchase/{item_id}', [ItemController::class, 'purchaseForm']);
Route::post('/purchase', [ItemController::class, 'purchase']);

Route::get('/sell', [ItemController::class, 'sellForm']);
Route::post('/sell', [ItemController::class, 'sellStore']);

Route::get('/mypage', [UserController::class, 'mypage']);
Route::get('/mypage/profile', [UserController::class, 'profileForm']);
Route::post('/mypage/profile', [UserController::class, 'profileSave']);

