<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsLetterController;

Route::get('/', function () {
    return view('index');
});

Route::get('/shoes/{gender}', [ProductController::class, 'list']);
Route::get("/shoes/{gender}/{product}", [ProductController::class, 'detail']);

// cart
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');


// newsletter
Route::post('/newsletter', [NewsLetterController::class, 'store'])->name('newsletter.store');