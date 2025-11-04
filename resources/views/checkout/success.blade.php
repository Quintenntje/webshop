@php
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
@endphp

<x-layout>
    <section class="container container--md">
        <div class="checkout-success">
            <div class="checkout-success__header">
                <div class="checkout-success__icon">
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="32" cy="32" r="32" fill="#10B981"/>
                        <path d="M20 32L28 40L44 24" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h1 class="checkout-success__title">{{ __('checkout.order_success') }}</h1>
                <p class="checkout-success__subtitle">{{ __('checkout.order_success_message') }}</p>
                <p class="checkout-success__order-number">{{ __('checkout.order_number') }}: #{{ $order->id }}</p>
            </div>

            <div class="checkout-success__content">
                <div class="checkout-success__section">
                    <h2 class="checkout-success__section-title">{{ __('checkout.order_details') }}</h2>
                    
                    <div class="checkout-success__items">
                        @foreach($order->items as $item)
                            <div class="checkout-success__item">
                                <div class="checkout-success__item-image">
                                    @if($item->productVariant->product->primaryImage)
                                        <img src="{{ $item->productVariant->product->primaryImage->filename }}" alt="{{ $item->productVariant->product->name }}">
                                    @endif
                                </div>
                                <div class="checkout-success__item-content">
                                    <h3 class="checkout-success__item-title">{{ $item->productVariant->product->name }}</h3>
                                    <p class="checkout-success__item-meta">
                                        {{ __('cart.color') }}: {{ $item->productVariant->color->name }}, 
                                        {{ __('cart.size') }}: {{ $item->productVariant->size->name }}, 
                                        {{ __('cart.quantity') }}: {{ $item->quantity }}
                                    </p>
                                    <p class="checkout-success__item-price">€{{ number_format($item->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="checkout-success__total">
                        <p class="checkout-success__total-label">{{ __('checkout.total') }}:</p>
                        <p class="checkout-success__total-amount">€{{ number_format($order->total_price, 2) }}</p>
                    </div>
                </div>

                <div class="checkout-success__section">
                    <h2 class="checkout-success__section-title">{{ __('checkout.shipping_address') }}</h2>
                    <div class="checkout-success__address">
                        <p>{{ $order->customer->first_name ?? '' }} {{ $order->customer->last_name ?? '' }}</p>
                        <p>{{ $order->street }}</p>
                        <p>{{ $order->postal_code }} {{ $order->city }}</p>
                        <p>{{ $order->country }}</p>
                    </div>
                </div>
            </div>

            <div class="checkout-success__actions">
                <x-link href="{{ LaravelLocalization::getLocalizedURL(null, '/shop') }}" color="primary" size="md">
                    {{ __('checkout.continue_shopping') }}
                </x-link>
                @auth
                    <x-link href="{{ LaravelLocalization::getLocalizedURL(null, '/account') }}" color="secondary" size="md">
                        {{ __('checkout.view_account') }}
                    </x-link>
                @endauth
            </div>
        </div>
    </section>
</x-layout>

