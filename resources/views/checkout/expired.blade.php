@php
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
@endphp

<x-layout>
    <section class="container container--md">
        <div class="checkout-expired">
            <div class="checkout-expired__header">
                <div class="checkout-expired__icon">
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="32" cy="32" r="32" fill="#EF4444"/>
                        <path d="M32 20V32M32 40H32.03" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="32" cy="32" r="24" stroke="white" stroke-width="2"/>
                    </svg>
                </div>
                <h1 class="checkout-expired__title">{{ __('checkout.order_expired') }}</h1>
                <p class="checkout-expired__subtitle">{{ __('checkout.order_expired_message') }}</p>
                <p class="checkout-expired__order-number">{{ __('checkout.order_number') }}: #{{ $order->id }}</p>
            </div>

            <div class="checkout-expired__content">
                <div class="checkout-expired__section">
                    <h2 class="checkout-expired__section-title">{{ __('checkout.order_details') }}</h2>
                    
                    <div class="checkout-expired__items">
                        @foreach($order->items as $item)
                            <div class="checkout-expired__item">
                                <div class="checkout-expired__item-image">
                                    @if($item->productVariant->product->primaryImage)
                                        <img src="{{ $item->productVariant->product->primaryImage->filename }}" alt="{{ $item->productVariant->product->name }}">
                                    @endif
                                </div>
                                <div class="checkout-expired__item-content">
                                    <h3 class="checkout-expired__item-title">{{ $item->productVariant->product->name }}</h3>
                                    <p class="checkout-expired__item-meta">
                                        {{ __('cart.color') }}: {{ $item->productVariant->color->name }}, 
                                        {{ __('cart.size') }}: {{ $item->productVariant->size->name }}, 
                                        {{ __('cart.quantity') }}: {{ $item->quantity }}
                                    </p>
                                    <p class="checkout-expired__item-price">€{{ number_format($item->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="checkout-expired__total">
                        <p class="checkout-expired__total-label">{{ __('checkout.total') }}:</p>
                        <p class="checkout-expired__total-amount">€{{ number_format($order->total_price, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="checkout-expired__actions">
                <x-link href="{{ LaravelLocalization::getLocalizedURL(null, '/cart') }}" color="primary" size="md">
                    {{ __('checkout.return_to_cart') }}
                </x-link>
                <x-link href="{{ LaravelLocalization::getLocalizedURL(null, '/shop') }}" color="secondary" size="md">
                    {{ __('checkout.continue_shopping') }}
                </x-link>
            </div>
        </div>
    </section>
</x-layout>

