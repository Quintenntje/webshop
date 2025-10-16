<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;

class CheckoutController extends Controller
{
    public function Shipping(Request $request)
    {
        $cart = json_decode($request->cookie('cart', '[]'), true);
        $productIds = array_keys($cart);
        $products = ProductVariant::whereIn('id', $productIds)->get();
        return view('checkout.shipping', compact('products', 'cart'));
    }
}
