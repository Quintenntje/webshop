<x-layout>
    <section class="container search__container">
        <h1 class="search__title center-content">{{ __('search.search_title') }}</h1>
        <form class="search__form" action="{{ route('search') }}" method="GET">
            <x-input type="text" name="search" placeholder="{{ __('search.search_placeholder') }}" />
            <x-button type="submit" color="primary" size="md">{{ __('search.search') }}</x-button>
        </form>

        @if ($products->count() > 0)
        <section class="products">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </section>
                @else
                <section class="search__no-results">    
                    <p class="search__no-results center-content">{{ __('search.no_results_found') }}</p>
                </section>
                @endif
    </section>
</x-layout>