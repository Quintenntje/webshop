<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductImage;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $cart = json_decode($request->cookie('cart', '[]'), true);

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
        $quantity = (int) $request->input('quantity', 1);

        $cart = json_decode($request->cookie('cart', '[]'), true);

        $cart[$product_variant_id] = ($cart[$product_variant_id] ?? 0) + $quantity;

        return redirect()
            ->back()
            ->with('success', 'Product added to cart!')
            ->cookie('cart', json_encode($cart), 60 * 60 * 24 * 30);
    }

    public function update(Request $request)
    {
        $product_variant_id = $request->input('product_variant_id');
        $quantity = (int) $request->input('quantity', 0);
        $updateQuantity = $request->input('updateQuantity');

        $cart = json_decode($request->cookie('cart', '[]'), true);

        switch ($updateQuantity) {
            case 'increment':
                $cart[$product_variant_id] = ($cart[$product_variant_id] ?? 0) + 1;
                break;

            case 'decrement':
                if (($cart[$product_variant_id] ?? 0) <= 1) {
                    unset($cart[$product_variant_id]);
                } else {
                    $cart[$product_variant_id] = $quantity - 1;
                }
                break;

            default:
                if ($quantity <= 0) {
                    unset($cart[$product_variant_id]);
                } else {
                    $cart[$product_variant_id] = $quantity;
                }
                break;
        }

        return redirect()
            ->back()
            ->cookie('cart', json_encode($cart), 60 * 60 * 24 * 30);
    }
}
