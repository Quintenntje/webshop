<x-layout>
    <div class="container">
    <h1> {{ $gender->name }} Shoes</h1>
    <p>{{ $products->count() }} results</p>

    <section class="products">
    @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </section>
</x-layout>