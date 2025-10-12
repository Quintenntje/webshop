<x-layout>
    <section class="container cart__container">
        <h1>Shopping Cart</h1>

        <div class="cart-container">
            <ul class="cart-items">
                <li class="cart-item">
                    <div class="cart-item__image">
                        <img src="https://picsum.photos/300/300?random={{ rand(1, 1000) }}" alt="Product Image">
                    </div>
                        <div class="cart-item__content">
                        <h3 class="cart-item__title">Product Name</h3>
                        <p class="cart-item__price">€100</p>
                        <div class="cart-item__quantity-container">
                            <x-button color="transparent" size="xs" class="cart-item__quantity-button">-</x-button>
                            <p class="cart-item__quantity">1</p>
                            <x-button color="transparent" size="xs" class="cart-item__quantity-button">+</x-button> 
                        </div>
                    </div>
                </li>
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