<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use App\Models\DiscountCode;

class CheckoutController extends Controller
{
    public function Shipping(Request $request)
    {
        $cart = json_decode($request->cookie('cart', '[]'), true);
        $discountCode = $request->cookie('discount_code');
        $discount = DiscountCode::where('code', $discountCode)->first();
        $productIds = array_keys($cart);
        $products = ProductVariant::whereIn('id', $productIds)->get();
        $totalProductsPrices = $this->getTotal($request);

        if ($discount) {
            if ($discount->type === 'percentage') {
                $total = $totalProductsPrices * (1 - $discount->value / 100);
            } else {
                $total = $totalProductsPrices - $discount->value;
            }
        } else {
            $total = $totalProductsPrices;
        }


        return view('checkout.shipping', compact('products', 'cart', 'discount', 'total'));
    }
    public function shippingStore(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        if (Auth::check()) {
            $customer = Auth::user();

            $address = Address::where('customer_id', $customer->id)->first();
            if ($address) {
                $address->update([
                    'address' => $request->address,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'country' => $request->country,
                ]);
            } else {
                $address = Address::create([
                    'customer_id' => $customer->id,
                    'address' => $request->address,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'country' => $request->country,
                ]);

            }
            session(['checkout.shipping' => $validated]);
        } else {
            session(['checkout.shipping' => $validated]);
        }
        return redirect()->route('checkout.payment.show');
    }

    public function paymentShow(Request $request)
    {

        $cart = json_decode($request->cookie('cart', '[]'), true);
        $productIds = array_keys($cart);
        $products = ProductVariant::whereIn('id', $productIds)->get();
        $discountCode = $request->cookie('discount_code');
        $discount = DiscountCode::where('code', $discountCode)->first();

        if (!session('checkout.shipping')) {
            return redirect()->route('checkout.shipping');
        }
        $shippingInfo = session('checkout.shipping');

        $totalProductsPrices = $this->getTotal($request);
        
        if ($discount) {
            if ($discount->type === 'percentage') {
                $total = $totalProductsPrices * (1 - $discount->value / 100);
            } else {
                $total = $totalProductsPrices - $discount->value;
            }
        } else {
            $total = $totalProductsPrices;
        }

        return view('checkout.payment', compact('shippingInfo', 'products', 'cart', 'total'));
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