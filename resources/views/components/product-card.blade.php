@props([
    'product' => null,
])

<article class="product-card">
    <div class="product-card__image">
        <img src="{{ $product->primaryImage->filename }}" alt="{{ $product->name }}">
    </div>
    <div class="product-card__content">
        <h3 class="product-card__title">{{ $product->name }}</h3>
        <div class="product-card__description">
       <p>{{ $product->gender->name }} {{ __('global.shoes') }}</p>
        <p>{{ $product->brand->name }}</p>
        </div>
        <div class="product-card__price">
            @if($product->hasActiveDiscount())
                <span class="product-card__price--original">€{{ number_format($product->price, 2) }}</span>
                <span class="product-card__price--discounted">€{{ number_format($product->final_price, 2) }}</span>
            @else
                <span class="product-card__price--regular">€{{ number_format($product->price, 2) }}</span>
            @endif
        </div>
    </div>
    <x-link href="/{{ app()->getLocale() }}/shoes/{{ $product->gender->slug }}/{{ $product->id }}" color="full" size=""><span class="sr-only">{{ __('global.view_product') }}</span></x-link>
</article>