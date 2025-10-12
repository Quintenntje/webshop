<x-layout>
    <section class="container cart__container">
        <h1 class="cart__title">Shopping Cart</h1>

        <div class="cart-container">
            <ul class="cart-items">
                @foreach ($products as $product)
                <li class="cart-item">
                    <div class="cart-item__image">
                        <img src="{{ $product->primaryImage->filename }}" alt="{{ $product->name }}">
                    </div>
                        <div class="cart-item__content">
                        <h3 class="cart-item__title">{{ $product->name }}</h3>
                        <p class="cart-item__price">€{{ $product->price }}</p>
                        <div class="cart-item__quantity-container">
                            <x-button color="transparent" size="xs" class="cart-item__quantity-button">-</x-button>
                            <p class="cart-item__quantity">{{ $cart[$product->id] }}</p>
                            <x-button color="transparent" size="xs" class="cart-item__quantity-button">+</x-button> 
                        </div>
                    </div>
                </li> 
                @endforeach
            </ul>
            <div class="cart-summary">
                <h2 class="cart-summary__title">Summary</h2>
                <div class="cart-summary__items">
                    <div class="cart-summary__item">
                        <p class="cart-summary__item-title">Subtotal</p>
                        <p class="cart-summary__item-price">€100</p>
                    </div>
                </div>
                <div class="cart-summary__total">
                    <p class="cart-summary__total-title">Total</p>
                    <p class="cart-summary__total-price">€100</p>
                </div>
                <x-button color="primary" size="md">Checkout</x-button>
            </div>
            </div>
    </section>
</x-layout>