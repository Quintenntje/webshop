<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductImage;

class CartController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', []);

        $productIds = array_keys($cart);
        $products = ProductVariant::whereIn('id', $productIds)->get();


        $total = 0;
        foreach ($products as $productVariant) {
            $total += $productVariant->product->price * $cart[$productVariant->id];
            $primaryImage = ProductImage::where('product_id', $productVariant->product_id)->first();

            $productVariant->primaryImage = $primaryImage;
        }

        return view('cart', compact('cart', 'products', 'total'));
    }

    public function add(Request $request)
    {

        $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
        ]);


        $product_variant_id = $request->input('product_variant_id');
        $quantity = $request->input('quantity', 1);


        $cart = session()->get('cart', []);
        if (isset($cart[$product_variant_id])) {
            $cart[$product_variant_id] += $quantity;
        } else {
            $cart[$product_variant_id] = $quantity;
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request)
    {
        $product_variant_id = $request->input('product_variant_id');
        $quantity = $request->input('quantity');
        $cart = session()->get('cart', []);
        $updateQuantity = $request->input('updateQuantity');

        switch ($updateQuantity) {
            case 'increment':
                $cart[$product_variant_id] = $quantity + 1;
                session()->put('cart', $cart);
                break;
            case 'decrement':
                if ($quantity <= 1) {
                    unset($cart[$product_variant_id]);
                } else {
                    $cart[$product_variant_id] = $quantity - 1;
                }
                session()->put('cart', $cart);
                break;
            default:
                if ($quantity <= 0) {
                    unset($cart[$product_variant_id]);
                } else {
                    $cart[$product_variant_id] = $quantity;
                }
                session()->put('cart', $cart);
                break;
        }

        return redirect()->back();
    }
}
