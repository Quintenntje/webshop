<x-layout>
    <section class="container wishlist__container">
        <h1 class="wishlist__title">Wishlist</h1>
        <div class="wishlist-container">
        @if ($products->count() > 0)
            @foreach ($products as $product)
                <x-wishlist-card :product="$product" />
            @endforeach
        @else
            <p class="wishlist-empty">Here you can see products you added to your wishlist</p>
        @endif
        </div>
    </section>
</x-layout>