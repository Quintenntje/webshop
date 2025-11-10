<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use App\Models\DiscountCode;
use Mollie\Api\MollieApiClient;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmed;
use App\Mail\OrderConfirmedAdmin;

class CheckoutController extends Controller
{
    public function Shipping(Request $request)
    {
        $cart = json_decode($request->cookie('cart', '[]'), true);
        $discountCode = $request->cookie('discount_code');
        $discount = DiscountCode::where('code', $discountCode)->first();
        $productIds = array_keys($cart);
        $products = ProductVariant::whereIn('id', $productIds)->get();

        foreach ($products as $productVariant) {
            $primaryImage = ProductImage::where('product_id', $productVariant->product_id)
                ->where('color_id', $productVariant->color_id)
                ->first();
            $productVariant->primaryImage = $primaryImage;
        }

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

        if ($customer) {
            $shippingInfo = null;
        }

        return view('checkout.shipping', compact('products', 'cart', 'discount', 'total', 'customer', 'shippingInfo', 'addresses'));
    }
    public function shippingStore(Request $request)
    {
        $addressSelected = $request->input('address_selection') === 'existing' && $request->input('address_id');

        if ($addressSelected) {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email',
                'address_id' => 'required|exists:addresses,id',
            ]);

            $address = Address::findOrFail($request->address_id);
            $validated['address'] = $address->address;
            $validated['city'] = $address->city;
            $validated['postal_code'] = $address->postal_code;
            $validated['country'] = $address->country;
        } else {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email',
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

        foreach ($products as $productVariant) {
            $primaryImage = ProductImage::where('product_id', $productVariant->product_id)
                ->where('color_id', $productVariant->color_id)
                ->first();
            $productVariant->primaryImage = $primaryImage;
        }

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

    public function paymentPost(Request $request)
    {
        $mollie = new MollieApiClient();
        $mollie->setApiKey(config('services.mollie.key'));

        $cart = json_decode($request->cookie('cart', '[]'), true);
        $request->validate([
            'payment_method' => 'required|in:credit_card,debit_card,paypal,bank_transfer',
        ]);

        $customer = Auth::User();

        $order = Order::create([
            'customer_id' => $customer ? $customer->id : null,
            'total_price' => $request->total,
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->address,
            'postal_code' => $request->postal_code,
            'status' => 'pending',
        ]);
        $order->save();

        foreach ($cart as $productVariantId => $quantity) {
            $productVariant = ProductVariant::find($productVariantId);
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $productVariant->id,
                'quantity' => $quantity,
                'price' => $productVariant->product->price,
            ]);
        }
        $orderItem->save();

        $amount = number_format((float) $request->total, 2, '.', '');

        $payment = $mollie->payments->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => $amount,
            ],
            'description' => 'Order #' . $order->id,
            'redirectUrl' => route('checkout.payment.status', $order->id),
        ]);

        $order->payment_id = $payment->id;
        $order->save();

        return redirect($payment->getCheckoutUrl());
    }

    public function status(Request $request, $orderId)
    {
        $cart = json_decode($request->cookie('cart', '[]'), true);
        $shippingInfo = session('checkout.shipping');
        $email = $shippingInfo['email'];
        $mollie = new MollieApiClient();
        $mollie->setApiKey(config('services.mollie.key'));


        $order = Order::findOrFail($orderId);
        $payment = $mollie->payments->get($order->payment_id);

        if ($payment->isPaid()) {
            $order->status = 'paid';
            $order->payment_method = $payment->method;
            $order->save();
            Mail::to($email)->send(new OrderConfirmed($order));
            Mail::to('admin@admin.com')->send(new OrderConfirmedAdmin($order));
            $products = ProductVariant::whereIn('id', array_keys($cart))->get();
            foreach ($products as $productVariant) {
                $productVariant->stock -= $cart[$productVariant->id];
                $productVariant->save();
            }
            return redirect()->route('checkout.payment.success', $order->id)->cookie('cart', null, -1)->cookie('discount_code', null, -1);
        }

        if ($payment->isExpired()) {
            $order->status = 'expired';
            $order->payment_method = $payment->method;
            $order->save();
            return redirect()->route('checkout.payment.expired', $order->id);
        }

        if ($payment->isFailed() || $payment->isCanceled()) {
            $order->status = 'canceled';
            $order->payment_method = $payment->method;
            $order->save();
            return redirect()->route('checkout.payment.failed', $order->id);
        }

        return redirect()->route('checkout.payment.show');
    }


    public function paymentSuccess(Request $request, $id)
    {
        $order = Order::with(['items.productVariant.product.primaryImage', 'items.productVariant.color', 'items.productVariant.size', 'customer'])->findOrFail($id);

        return view('checkout.success', compact('order'));
    }
    public function paymentFailed(Request $request, $id)
    {
        $order = Order::with(['items.productVariant.product.primaryImage', 'items.productVariant.color', 'items.productVariant.size', 'customer'])->findOrFail($id);

        return view('checkout.cancelled', compact('order'));
    }

    public function paymentExpired(Request $request, $id)
    {
        $order = Order::with(['items.productVariant.product.primaryImage', 'items.productVariant.color', 'items.productVariant.size', 'customer'])->findOrFail($id);

        return view('checkout.expired', compact('order'));
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