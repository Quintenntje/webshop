<x-layout>
    <section class="container cart__container">
        <h1 class="cart__title">{{ __('cart.shopping_cart') }}</h1>

        <div class="cart-container">
            <ul class="cart-items">
                @if ($products->count() > 0)
                @else
                <p class="cart-items__empty">{{ __('cart.no_products_in_cart') }}</p>
                @endif
                @foreach ($products as $product)
                <li class="cart-item">
                    <div class="cart-item__image">
                        <img src="{{ $product->primaryImage->filename }}" alt="{{ $product->product->name }}">
                    </div>
                        <div class="cart-item__content">
                        <h3 class="cart-item__title">{{ $product->product->name }}</h3>
                        <div class="cart-item__price">
                            @if($product->product->hasActiveDiscount())
                                <span class="cart-item__price--original">€{{ number_format($product->product->price, 2)  * $cart[$product->id] }}</span>
                                <span class="cart-item__price--discounted">€{{ number_format($product->product->final_price, 2) * $cart[$product->id]  }}</span>
                            @else
                                <span class="cart-item__price--regular">€{{ number_format($product->product->price, 2) * $cart[$product->id] }}</span>
                            @endif
                        </div>
                        <p class="cart-item__color">{{ __('cart.color') }}: {{ $product->color->name }}</p>
                        <p class="cart-item__size">{{ __('cart.size') }}: {{ $product->size->name }}</p>
                        <form action="{{ route('cart.update') }}" method="POST" class="cart-item__quantity-container">
                            @csrf
                            <input type="hidden" name="product_variant_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="{{ $cart[$product->id] }}">
                            <x-button type="submit" name="updateQuantity" value="decrement" color="transparent" size="xs" class="cart-item__quantity-button">-</x-button>
                            <p class="cart-item__quantity">{{ $cart[$product->id] }}</p>
                            <x-button type="submit" name="updateQuantity" value="increment" color="transparent" size="xs" class="cart-item__quantity-button">+</x-button> 
                        </form>
                    </div>
                </li> 
                @endforeach
            </ul>
            <div class="cart-summary">
                @if ($products->count() > 0)
                <h2 class="cart-summary__title">{{ __('cart.discount') }}</h2>
                <form class="discount-form" action="{{ route('cart.apply-discount') }}" method="POST">
                    @csrf
                    <x-input color="transparent" size="sm" type="text" name="discount_code" placeholder="{{ __('cart.enter_discount_code') }}" />
                    @error('discount_code')
                    <p class="auth__error">{{ $message }}</p>
                    @enderror
                    @session('error')
                    <p class="auth__error">{{ session('error') }}</p>
                    @endSession
                    <x-button type="submit" name="apply-discount" value="apply-discount" color="primary" size="sm">{{ __('cart.apply_discount') }}</x-button>

                    @if ($discountCode)
                    <p class="auth__success">{{ __('cart.applied_discount_code') }}: {{ $discountCode->code }}</p>
                    @endif
              
                </form>
                @endif
                <h2 class="cart-summary__title">{{ __('cart.summary') }}</h2>
                <div class="cart-summary__items">
                    <div class="cart-summary__item">
                        <div class="cart-summary__item-content">
                        <p class="cart-summary__item-title">{{ __('cart.subtotal') }}</p>
                        @if ($discountCode)
                            <p class="cart-summary__item-price">€{{ number_format($originalTotal, 2) }}</p>
                        @else
                            <p class="cart-summary__item-price">€{{ number_format($total, 2) }}</p>
                        @endif
                    </div>
                    <div class="cart-summary__item-content">
                        @if ($discountCode)
                            <p class="cart-summary__item-title">{{ __('cart.discount') }}</p> 
                                <p class="cart-summary__item-price">€ {{ number_format($originalTotal - $total, 2) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="cart-summary__total">
                    <p class="cart-summary__total-title">{{ __('cart.total') }}</p>
                    <p class="cart-summary__total-price">€{{ number_format($total, 2) }}</p>
                </div>
                @if ($products->count() > 0)
                <x-Link href="/checkout/shipping" color="primary" size="md">{{ __('cart.checkout') }}</x-Link>
                @else
                <x-link href="/" color="primary" size="md">{{ __('cart.add_products_to_cart') }}</x-link>
                @endif
            </div>
            </div>
    </section>
</x-layout>