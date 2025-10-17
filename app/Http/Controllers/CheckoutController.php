<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function Shipping(Request $request)
    {
        $cart = json_decode($request->cookie('cart', '[]'), true);
        $productIds = array_keys($cart);
        $products = ProductVariant::whereIn('id', $productIds)->get();


        return view('checkout.shipping', compact('products', 'cart'));
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

        if (!session('checkout.shipping')) {
            return redirect()->route('checkout.shipping');
        }
        $shippingInfo = session('checkout.shipping');


        return view('checkout.payment', compact('shippingInfo', 'products', 'cart'));
    }
}