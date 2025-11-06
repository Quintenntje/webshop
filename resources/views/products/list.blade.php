<x-layout>
    <section class="container">
        <div class="products-header">
            <div class="products-header__content">
                <h1 class="products-header__title">{{ $gender->name ?? $brand->name ?? __('list.all') }} {{ __('list.shoes') }}</h1>
                <p class="products-header__count">{{ $products->count() }} {{ __('list.results') }}</p>
            </div>
        </div>

    <form method="GET" class="filter-container">
        @foreach(request()->except('gender', 'brand') as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        @if (str_contains(request()->path(), 'shop') || str_contains(request()->path(), 'brand') || str_contains(request()->path(), 'sale'))
        <div class="filter-container__item">
            <h3 class="filter-container__title">{{ __('list.filter_by_gender') }}</h3>
                <div class="select-wrapper">
                    <select name="gender" id="gender" class="select" onchange="this.form.submit()">
                        <option value="">{{ __('list.all_genders') }}</option>
                        @foreach($genders as $genderOption)
                            <option value="{{ $genderOption->slug }}" {{ request('gender') == $genderOption->slug ? 'selected' : '' }}>
                                {{ $genderOption->name }}
                            </option>
                        @endforeach
                    </select>
                    <svg class="select-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </div>
        </div>
        @endif
       @if (!str_contains(request()->path(), 'brand'))
        <div class="filter-container__item">
            <h3 class="filter-container__title">{{ __('list.filter_by_brand') }}</h3>
                <div class="select-wrapper">
                    <select name="brand" id="brand" class="select" onchange="this.form.submit()">
                        <option value="">{{ __('list.all_brands') }}</option>
                        @foreach($brands as $brandOption)
                            <option value="{{ $brandOption->slug }}" {{ request('brand') == $brandOption->slug ? 'selected' : '' }}>
                                {{ $brandOption->name }}
                            </option>
                        @endforeach
                    </select>
                    <svg class="select-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </div>
        </div>
        @endif
        <div class="filter-container__item">
            <h3 class="filter-container__title">{{ __('list.sort_by') }}</h3>
                <div class="select-wrapper">
                    <select name="sort" id="sort" class="select" onchange="this.form.submit()">
                        <option value="" {{ request('sort') == null ? 'selected' : '' }}>{{ __('list.sort_by') }}</option>
                        <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>{{ __('list.price_low_to_high') }}</option>
                        <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>{{ __('list.price_high_to_low') }}</option>
                        <option value="name-asc" {{ request('sort') == 'name-asc' ? 'selected' : '' }}>{{ __('list.name_a_to_z') }}</option>
                        <option value="name-desc" {{ request('sort') == 'name-desc' ? 'selected' : '' }}>{{ __('list.name_z_to_a') }}</option>
                    </select>
                    <svg class="select-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </div>
        </div>
    </form>
    <section class="products">
    @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach

        @if ($products->count() == 0)
            <p class="products__empty">{{ __('list.no_products_found') }}</p>
        @endif
    </section>

        {{ $products->links() }}
    </section>
</x-layout>