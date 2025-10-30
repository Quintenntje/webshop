@props([
    'product' => null,
])

<div class="wishlist-card">
    <div class="wish-list-heart">
        <form class="wish-list-heart__form" action="{{ route('wishlist.remove') }}" method="POST">
            @csrf
            <input type="hidden" name="product_variant_id" value="{{ $product->id }}">
            <x-button type="submit" name="remove-from-wishlist" value="remove-from-wishlist" color="transparent" size="sm"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg></x-button>
        </form>
    </div>
    <div class="wishlist-card__image">
        <img src="{{ $product->product->primaryImage->filename }}" alt="{{ $product->name }}">
    </div>
    <div class="wishlist-card__content">
        <h3 class="wishlist-card__title">{{ $product->product->name }}</h3>
        <div class="wishlist-card__price">
            @if($product->product->hasActiveDiscount())
                <span class="wishlist-card__price--original">€{{ number_format($product->product->price, 2) }}</span>
                <span class="wishlist-card__price--discounted">€{{ number_format($product->product->final_price, 2) }}</span>
            @else
                <span class="wishlist-card__price--regular">€{{ number_format($product->product->price, 2) }}</span>
            @endif
        </div>
    </div>
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_variant_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" value="1">
        <x-button type="submit" name="add-to-cart" value="add-to-cart" color="primary" size="sm">Add to Cart</x-button>
    </form>
</div>