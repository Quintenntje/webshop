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
       <p>{{ $product->gender->name }} Shoes</p>
        <p>{{ $product->brand->name }}</p>
        </div>
        <p class="product-card__price">€{{ $product->price }}</p>
    </div>
    <x-link href="/products/{{ $product->id }}" color="full" size=""><span class="sr-only">View product</span></x-link>
</article>