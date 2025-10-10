<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/shoes/{gender}', [ProductController::class, 'list']);
Route::get("/shoes/{gender}/{product}", [ProductController::class, 'detail']);