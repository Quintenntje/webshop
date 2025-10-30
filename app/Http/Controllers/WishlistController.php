<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductVariant;

class WishlistController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('customer_id', $user->id)->get();
        $productIds = $wishlist->pluck('product_variant_id');
        $products = ProductVariant::with(['product.activeDiscount', 'product.primaryImage'])->whereIn('id', $productIds)->get();
        return view('wishlist', compact('wishlist', 'products'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
        ], [
            'product_variant_id.required' => 'Please select a color and size',
            'product_variant_id.exists' => 'Please select a color and size',
        ]);

        $product_variant_id = $request->input('product_variant_id');

        $user = Auth::user();
        $wishlist = Wishlist::where('customer_id', $user->id)->where('product_variant_id', $product_variant_id)->first();
        if ($wishlist) {
            return redirect()->back();
        } else {
            Wishlist::create(['customer_id' => $user->id, 'product_variant_id' => $product_variant_id]);
        }
        return redirect()->back();
    }
    public function remove(Request $request)
    {
        $product_variant_id = $request->input('product_variant_id');
        $user = Auth::user();
        $wishlist = Wishlist::where('customer_id', $user->id)->where('product_variant_id', $product_variant_id)->first();
        $wishlist->delete();
        return redirect()->back();
    }
}
