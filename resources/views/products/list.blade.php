<x-layout>
    <section class="container">
        <h1 class="page-title">{{ $gender->name ?? 'All' }} Shoes</h1>

        <p>{{ $products->count() }} results</p>

    <section class="products">
    @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </section>

        {{ $products->links() }}
    </section>
</x-layout>