<x-layout>
    <section class="container wishlist__container">
        <h1 class="wishlist__title">{{ __('wishlist.wishlist') }}</h1>
        <div class="wishlist-container">
        @if ($products->count() > 0)
            @foreach ($products as $product)
                <x-wishlist-card :product="$product" />
            @endforeach
        @else
            <p class="wishlist-empty">{{ __('wishlist.empty_message') }}</p>
        @endif
        </div>
    </section>
</x-layout>