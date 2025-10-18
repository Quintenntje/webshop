@props([
    'products' => null,
    'cart' => null,
])

<ul class="cart-items">
    @if ($products->count() > 0)
    @else
    <p class="cart-items__empty">No products in cart</p>
    @endif
    @foreach ($products as $product)
    <li class="cart-item">
        <div class="cart-item__image">
            <img src="{{ $product->product->primaryImage->filename }}" alt="{{ $product->product->name }}">
        </div>
            <div class="cart-item__content">
            <h3 class="cart-item__title">{{ $product->product->name }}</h3>
            <p class="cart-item__price">€{{ $product->product->price * $cart[$product->id] }}</p>
            <p class="cart-item__color">Color: {{ $product->color->name }}</p>
            <p class="cart-item__size">Size: {{ $product->size->name }}</p>
          
                <p>quantity: {{ $cart[$product->id] }}</p>
               
        
        </div>
    </li> 
    @endforeach
</ul>