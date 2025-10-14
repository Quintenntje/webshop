<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
});

Route::get('/shoes/{gender}', [ProductController::class, 'list']);
Route::get("/shoes/{gender}/{product}", [ProductController::class, 'detail']);

// auth
Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'viewRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');


// cart
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');


// newsletter
Route::post('/newsletter', [NewsLetterController::class, 'store'])->name('newsletter.store');
Route::get('/newsletter/unsubscribe/{email}', [NewsLetterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
