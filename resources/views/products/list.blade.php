<x-layout>
    <div class="container">
    <h1> {{ $gender->name }} Shoes</h1>
    <p>{{ $products->count() }} results</p>

    @foreach ($products as $product)
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->price }}</p>
        @endforeach
    </div>

    
   
</x-layout>