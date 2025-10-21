<x-layout>
    <section class="container">
        <h1 class="page-title">{{ $gender->name ?? $brand->name ?? 'All' }} Shoes</h1>

        <p>{{ $products->count() }} results</p>

    <form method="GET" class="filter-container">
        @foreach(request()->except('gender', 'brand') as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        @if (str_contains(request()->path(), 'shop') || str_contains(request()->path(), 'brand'))
        <div class="filter-container__item">
            <h3 class="filter-container__title">Filter by Gender</h3>
                <div class="select-wrapper">
                    <select name="gender" id="gender" class="select" onchange="this.form.submit()">
                        <option value="">All Genders</option>
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
            <h3 class="filter-container__title">Filter by Brand</h3>
                <div class="select-wrapper">
                    <select name="brand" id="brand" class="select" onchange="this.form.submit()">
                        <option value="">All Brands</option>
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
            <h3 class="filter-container__title">Sort by</h3>
                <div class="select-wrapper">
                    <select name="sort" id="sort" class="select" onchange="this.form.submit()">
                        <option value="" {{ request('sort') == null ? 'selected' : '' }}>Sort by</option>
                        <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="name-asc" {{ request('sort') == 'name-asc' ? 'selected' : '' }}>Name: A to Z</option>
                        <option value="name-desc" {{ request('sort') == 'name-desc' ? 'selected' : '' }}>Name: Z to A</option>
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
            <p class="products__empty">No products found</p>
        @endif
    </section>

        {{ $products->links() }}
    </section>
</x-layout>