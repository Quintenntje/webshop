@php
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
@endphp

<x-layout>
    <section class="container wishlist__container">
        <h1 class="wishlist__title">{{ __('wishlist.wishlist') }}</h1>
        <div class="wishlist-container">
        @if ($products->count() > 0)
            @foreach ($products as $product)
                <x-wishlist-card :product="$product" />
            @endforeach
        @else
            <div class="empty-state">
                <div class="empty-state__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg>
                </div>
                <h2 class="empty-state__title">{{ __('wishlist.empty_title') }}</h2>
                <p class="empty-state__description">{{ __('wishlist.empty_message') }}</p>
                <x-link href="{{ LaravelLocalization::getLocalizedURL(null, '/shop') }}" color="primary" size="md">{{ __('wishlist.continue_shopping') }}</x-link>
            </div>
        @endif
        </div>
    </section>
</x-layout>