@php
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
@endphp

<x-layout>
    <section class="container container--md">
        <div class="checkout-cancelled">
            <div class="checkout-cancelled__header">
                <div class="checkout-cancelled__icon">
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="32" cy="32" r="32" fill="#F59E0B"/>
                        <path d="M24 24L40 40M40 24L24 40" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h1 class="checkout-cancelled__title">{{ __('checkout.order_cancelled') }}</h1>
                <p class="checkout-cancelled__subtitle">{{ __('checkout.order_cancelled_message') }}</p>
                <p class="checkout-cancelled__order-number">{{ __('checkout.order_number') }}: #{{ $order->id }}</p>
            </div>

            <div class="checkout-cancelled__content">
                <div class="checkout-cancelled__section">
                    <h2 class="checkout-cancelled__section-title">{{ __('checkout.order_details') }}</h2>
                    
                    <div class="checkout-cancelled__items">
                        @foreach($order->items as $item)
                            <div class="checkout-cancelled__item">
                                <div class="checkout-cancelled__item-image">
                                    @if($item->productVariant->product->primaryImage)
                                        <img src="{{ $item->productVariant->product->primaryImage->filename }}" alt="{{ $item->productVariant->product->name }}">
                                    @endif
                                </div>
                                <div class="checkout-cancelled__item-content">
                                    <h3 class="checkout-cancelled__item-title">{{ $item->productVariant->product->name }}</h3>
                                    <p class="checkout-cancelled__item-meta">
                                        {{ __('cart.color') }}: {{ $item->productVariant->color->name }}, 
                                        {{ __('cart.size') }}: {{ $item->productVariant->size->name }}, 
                                        {{ __('cart.quantity') }}: {{ $item->quantity }}
                                    </p>
                                    <p class="checkout-cancelled__item-price">€{{ number_format($item->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="checkout-cancelled__total">
                        <p class="checkout-cancelled__total-label">{{ __('checkout.total') }}:</p>
                        <p class="checkout-cancelled__total-amount">€{{ number_format($order->total_price, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="checkout-cancelled__actions">
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

