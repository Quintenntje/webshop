<x-layout>
    <h1>Shoes List</h1>

    @foreach ($products as $product)
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->price }}</p>


    @endforeach
</x-layout>