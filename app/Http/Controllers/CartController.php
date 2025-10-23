<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\DiscountCode;
use App\Support\NumberHelper;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $cart = json_decode($request->cookie('cart', '[]'), true);
        $discountCode = $request->cookie('discount_code');

        if ($discountCode) {
            $discountCode = DiscountCode::where('code', $discountCode)->first();
            if (!$discountCode || !$discountCode->active || $discountCode->expires_at < now()) {
                return redirect()
                    ->back()
                    ->cookie('discount_code', null, 60 * 60 * 24 * 30)
                    ->with('error', 'Discount code expired or invalid!');
            }

            if ($discountCode) {
                if ($discountCode->type === 'percentage') {
                    $total = NumberHelper::toFixed($this->getTotal($request) * (1 - $discountCode->value / 100), 2);

                } else {
                    $total = NumberHelper::toFixed($this->getTotal($request) - $discountCode->value, 2);
                }
            }
        } else {
            $total = $this->getTotal($request);
        }

        $productIds = array_keys($cart);
        $products = ProductVariant::whereIn('id', $productIds)->get();


        foreach ($products as $productVariant) {
            $primaryImage = ProductImage::where('product_id', $productVariant->product_id)->first();

            $productVariant->primaryImage = $primaryImage;
        }

        return view('cart', compact('cart', 'products', 'total', 'discountCode'));
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


    public function applyDiscount(Request $request)
    {
        $request->validate([
            'discount_code' => 'required|exists:discount_codes,code',
        ]);

        $discountCode = DiscountCode::where('code', $request->input('discount_code'))->first();
        if (!$discountCode || !$discountCode->active || $discountCode->expires_at < now()) {
            return redirect()
                ->back()
                ->with('error', 'Invalid discount code!');
        }
        if ($discountCode->type === 'percentage') {
            $total = $this->getTotal($request);
            $newPrice = $total * (1 - $discountCode->value / 100);
        } else {
            $total = $this->getTotal($request);
            $newPrice = $total - $discountCode->value;
        }
        return redirect()
            ->back()
            ->cookie('total', $newPrice, 60 * 60 * 24 * 30)
            ->cookie('discount_code', $discountCode->code, 60 * 60 * 24 * 30)
            ->with('success', 'Discount code applied!');

    }

    private function getTotal(Request $request)
    {
        $cart = json_decode($request->cookie('cart', '[]'), true);
        $total = 0;
        foreach ($cart as $productVariantId => $quantity) {
            $productVariant = ProductVariant::find($productVariantId);
            $total += $productVariant->product->price * $quantity;
        }
        return $total;
    }
}
