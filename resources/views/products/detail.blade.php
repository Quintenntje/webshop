<x-layout>
   <div class="container">
     <section class="product-detail">
       <div class="product-detail__content mobile-only">
         <h1 class="product-detail__title">
           {{ $product->name }}
         </h1>
 
         <p class="product-detail__gender">
           {{ $product->gender->name }} shoes
         </p>
 
         <p class="product-detail__price">
           €{{ $product->price }}
         </p>
       </div>

       <div class="product-detail__container">
 
       <div class="product-detail__images">
         <div class="product-detail__primary-image">
           <img 
             src="{{ $product->primaryImage->filename }}" 
             alt="{{ $product->name }}"
           >
         </div>
         <div class="product-detail__secondary-images">
           @foreach ($productImages as $image)
             <img 
               src="{{ $image->filename }}" 
               alt="{{ $product->name }}"
             >
           @endforeach
         </div>
       </div>

       <div class="product-detail__content">
        <div class="product-detail__content-pc pc-only">
        <h1 class="product-detail__title">
          {{ $product->name }}
        </h1>

        <p class="product-detail__gender">
          {{ $product->gender->name }} shoes
        </p>

        <p class="product-detail__price">
          €{{ $product->price }}
        </p>
        </div>

       <div class="product-colors">
        <h2 class="product-colors__title">Colors</h2>
        <div class="product-colors__list">
          @foreach ($allAvailableColors as $color)
            <a href="/shoes/{{ $product->gender->slug }}/{{ $product->id }}?color_id={{ $color->id }}" class=" product-colors__item product-colors__item--{{ $color->name }} {{ $color->id == $color_id ? 'product-colors__item--active' : '' }}   ">{{ $color->name }}</a>
          @endforeach
        </div>
       </div>

       <div class="product-sizes">
        <h2 class="product-sizes__title">Sizes</h2>
        <div class="product-sizes__list">
          @foreach ($allAvailableSizes as $size)
            <a href="/shoes/{{ $product->gender->slug }}/{{ $product->id }}?color_id={{ $color_id	 }}&size_id={{ $size->id }}" class="product-sizes__item {{ $size->id == $size_id ? 'product-sizes__item--active' : '' }}">{{ $size->name }}</a>
          @endforeach
       </div>
       </div>
       
       <div class="product-add-to-cart">
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_variant_id" value="{{ $productVariant->id ?? 0 }}">
            <input type="hidden" name="quantity" value="1">
            <x-button type="submit" color="primary" size="md">Add to cart</x-button>
        </form>
        <form action="{{ route('wishlist.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_variant_id" value="{{ $productVariant->id ?? 0 }}">
            <x-button type="submit" name="add-to-wishlist" value="add-to-wishlist" color="secondary" size="md">Add to wishlist</x-button>
        </form>
       </div>
       <div class="product-details">
        <h2 class="product-details__title">Details</h2>
        <div class="product-details__list">
          <p>{{ $product->description }}</p>
        </div>
      </div>
    </div>
       </div>
     </section>
   </div>
 </x-layout>
 