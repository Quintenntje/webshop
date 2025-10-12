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
                        <form action="{{ route('cart.update') }}" method="POST" class="cart-item__quantity-container">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
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
                <h2 class="cart-summary__title">Summary</h2>
                <div class="cart-summary__items">
                    <div class="cart-summary__item">
                        <p class="cart-summary__item-title">Subtotal</p>
                        <p class="cart-summary__item-price">€{{ $total }}</p>
                    </div>
                </div>
                <div class="cart-summary__total">
                    <p class="cart-summary__total-title">Total</p>
                    <p class="cart-summary__total-price">€{{ $total }}</p>
                </div>
                <x-button color="primary" size="md">Checkout</x-button>
            </div>
            </div>
    </section>
</x-layout>