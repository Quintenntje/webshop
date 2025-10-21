<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Models\Gender;
use App\Models\Brand;
use Spatie\Sitemap\SitemapGenerator;

Route::get('/sitemap.xml', function () {
    SitemapGenerator::create(config('app.url'))
        ->writeToFile(public_path('sitemap.xml'));

    return response()->file(public_path('sitemap.xml'));
});

Route::get('/', function () {
    $genders = Gender::all();
    $brands = Brand::all();
    return view('index', compact('genders', 'brands'));
});

Route::get("/shop", [ProductController::class, 'list']);
Route::get('/shoes/{gender}', [ProductController::class, 'listByGender']);
Route::get("/shoes/{gender}/{product}", [ProductController::class, 'detail']);
Route::get("/brand/{brand}", [ProductController::class, 'listByBrand']);

// search

Route::get('/search', [ProductController::class, 'search'])->name('search');

// auth
Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'viewRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// account
Route::get('/account', [AuthController::class, 'viewAccount'])->middleware('auth')->name('account');
Route::get('/account/addresses', [AuthController::class, 'viewAddresses'])->middleware('auth')->name('account.addresses');


// cart
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

//checkout
Route::prefix('checkout')->group(function () {
    Route::get('/shipping', [CheckoutController::class, 'shipping'])->name('checkout.shipping');
    Route::post('/shipping', [CheckoutController::class, 'shippingStore'])->name('checkout.shipping.store');
    Route::get('/payment', [CheckoutController::class, 'paymentShow'])->name('checkout.payment.show');
});
// wishlist
Route::get('/wishlist', [WishlistController::class, 'show'])->middleware('auth');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->middleware('auth')->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->middleware('auth')->name('wishlist.remove');


// newsletter
Route::post('/newsletter', [NewsLetterController::class, 'store'])->name('newsletter.store');
Route::get('/newsletter/unsubscribe/{email}', [NewsLetterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
