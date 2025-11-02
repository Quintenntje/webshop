@props([
    'products' => null,
    'cart' => null,
    'total' => null,
])
<div>
<ul class="cart-items">
    @if ($products->count() > 0)
    @else
    <p class="cart-items__empty">{{ __('cart.no_products_in_cart') }}</p>
    @endif
    @foreach ($products as $product)
    <li class="cart-item">
        <div class="cart-item__image">
            <img src="{{ $product->product->primaryImage->filename }}" alt="{{ $product->product->name }}">
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
                <p>{{ __('cart.quantity') }}: {{ $cart[$product->id] }}</p>
        </div>
    </li> 
    @endforeach
</ul>
{{ __('cart.total') }}: €{{ number_format($total, 2) }}

</div>