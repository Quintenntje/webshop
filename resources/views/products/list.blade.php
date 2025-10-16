<x-layout>
    <section class="container">
        <h1>{{ $gender->name ?? 'All' }} Shoes</h1>

        <p>{{ $products->count() }} results</p>

    <section class="products">
    @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </section>
</x-layout>