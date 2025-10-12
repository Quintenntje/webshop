<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        $total = 0;
        foreach ($products as $product) {
            $total += $product->price * $cart[$product->id];
        }

        return view('cart', compact('cart', 'products', 'total'));
    }

    public function add(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);
        if (isset($cart[$product_id])) {
            $cart[$product_id] += $quantity;
        } else {
            $cart[$product_id] = $quantity;
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $cart = session()->get('cart', []);
        $updateQuantity = $request->input('updateQuantity');

        switch ($updateQuantity) {
            case 'increment':
                $cart[$product_id] = $quantity + 1;
                session()->put('cart', $cart);
                break;
            case 'decrement':
                if ($quantity <= 1) {
                    unset($cart[$product_id]);
                } else {
                    $cart[$product_id] = $quantity - 1;
                }
                session()->put('cart', $cart);
                break;
            default:
                if ($quantity <= 0) {
                    unset($cart[$product_id]);
                } else {
                    $cart[$product_id] = $quantity;
                }
                session()->put('cart', $cart);
                break;
        }

        return redirect()->back();
    }
}
