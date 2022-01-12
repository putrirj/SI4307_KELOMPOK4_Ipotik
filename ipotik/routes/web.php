<?php

use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('post', [PostController::class, 'index'])->name('post.index');

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'auth'])->name('auth');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'store'])->name('user.store');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('post/create', [PostController::class, 'create'])->name('post.create');
        Route::post('post', [PostController::class, 'store'])->name('post.store');
        Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::patch('post/{post}', [PostController::class, 'update'])->name('post.update');
        Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

        Route::get('medicine/create', [MedicineController::class, 'create'])->name('medicine.create');
        Route::post('medicine', [MedicineController::class, 'store'])->name('medicine.store');
        Route::get('medicine/{medicine}/edit', [MedicineController::class, 'edit'])->name('medicine.edit');
        Route::patch('medicine/{medicine}', [MedicineController::class, 'update'])->name('medicine.update');
        Route::delete('medicine/{medicine}', [MedicineController::class, 'destroy'])->name('medicine.destroy');
    });

    Route::middleware(['user'])->group(function () {
        Route::get('cart', [CartController::class, 'index'])->name('cart.index');
        Route::get('cart/checkout', [CartController::class, 'create'])->name('cart.create');
        Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('cart/{medicine}', [CartController::class, 'store'])->name('cart.store');
        Route::delete('cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

        Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('transaction/receipt', [TransactionController::class, 'receipt'])->name('transaction.receipt');
        Route::post('transaction/receipt', [TransactionController::class, 'receiptStore'])->name('transaction.receipt_store');
        Route::get('transaction/{transaction}/bayar', [TransactionController::class, 'bayar'])->name('transaction.bayar');
        Route::post('transaction/{transaction}/bayar', [TransactionController::class, 'proses']);
    });

    Route::post('transaction/{transaction}/selesai', [TransactionController::class, 'selesai'])->name('transaction.selesai');
    Route::get('transaction/{transaction}', [TransactionController::class, 'show'])->name('transaction.show');

    Route::middleware(['apoteker'])->group(function () {
        Route::get('verifikasi', [ApotekerController::class, 'index'])->name('verifikasi.index');
        Route::post('verifikasi/{transaction}/tolak', [ApotekerController::class, 'tolak'])->name('verifikasi.tolak');
        Route::post('verifikasi/{transaction}/proses', [ApotekerController::class, 'proses'])->name('verifikasi.proses');
        Route::post('verifikasi/{transaction}/dikirim', [ApotekerController::class, 'dikirim'])->name('verifikasi.dikirim');
        Route::get('verifikasi/{transaction}/keranjang', [ApotekerController::class, 'keranjang'])->name('verifikasi.keranjang');
        Route::post('verifikasi/{transaction}/keranjang', [ApotekerController::class, 'pesanan'])->name('verifikasi.keranjang.pesanan');
        Route::get('verifikasi/{transaction}/keranjang/category', [ApotekerController::class, 'category'])->name('verifikasi.keranjang.category');
        Route::get('verifikasi/{transaction}/keranjang/category/{category}', [ApotekerController::class, 'medicine'])->name('verifikasi.keranjang.medicine');
        Route::get('verifikasi/{transaction}/keranjang/medicine/{medicine}', [ApotekerController::class, 'medicineDetail'])->name('verifikasi.keranjang.medicine_detail');
        Route::post('verifikasi/{transaction}/keranjang/medicine/{medicine}', [ApotekerController::class, 'store'])->name('verifikasi.keranjang.store');
    });

    Route::get('profile', [UserController::class, 'edit'])->name('user.edit');
    Route::post('profile', [UserController::class, 'update'])->name('user.update');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('medicine', [MedicineController::class, 'index'])->name('medicine.index');
Route::get('medicine/category/{category}', [MedicineController::class, 'category'])->name('medicine.category');
Route::get('medicine/{medicine}', [MedicineController::class, 'show'])->name('medicine.show');
