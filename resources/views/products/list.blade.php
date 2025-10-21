<x-layout>
    <section class="container">
        <h1 class="page-title">{{ $gender->name ?? $brand->name ?? 'All' }} Shoes</h1>

        <p>{{ $products->count() }} results</p>

    <div class="filter-container">
       @if (!str_contains(request()->path(), 'brand'))
        <div class="filter-container__item">
            <h3 class="filter-container__title">Filter by Brand</h3>
            <form method="GET">
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
            </form>
        </div>
        @endif
    </div>
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