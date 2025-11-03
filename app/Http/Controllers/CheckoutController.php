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
            $total = $discount->calculateDiscountedPrice($totalProductsPrices);
        } else {
            $total = $totalProductsPrices;
        }

        $customer = Auth::User();
        $addresses = collect();

        if ($customer) {
            $addresses = Address::where('customer_id', $customer->id)->get();
        }

        if (!$customer) {
            $shippingInfo = session('checkout.shipping');
        }

        if($customer) {
            $shippingInfo = null;
        }

        return view('checkout.shipping', compact('products', 'cart', 'discount', 'total', 'customer', 'shippingInfo', 'addresses'));
    }
    public function shippingStore(Request $request)
    {
        $addressSelected = $request->input('address_selection') === 'existing' && $request->input('address_id');

        if ($addressSelected) {
            // Using existing address
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string|max:255',
                'address_id' => 'required|exists:addresses,id',
            ]);

            $address = Address::findOrFail($request->address_id);
            $validated['address'] = $address->address;
            $validated['city'] = $address->city;
            $validated['postal_code'] = $address->postal_code;
            $validated['country'] = $address->country;
        } else {
            // New address
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

                // Save new address if user is logged in
                $address = Address::create([
                    'customer_id' => $customer->id,
                    'address' => $request->address,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'country' => $request->country,
                ]);
            }
        }

        session(['checkout.shipping' => $validated]);
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
            $total = $discount->calculateDiscountedPrice($totalProductsPrices);
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

            if ($productVariant->product->hasActiveDiscount()) {
                $total += $productVariant->product->final_price * $quantity;
            } else {
                $total += $productVariant->product->price * $quantity;
            }
        }
        return $total;
    }
}