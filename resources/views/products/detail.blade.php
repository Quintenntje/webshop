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
          @foreach ($productVariants as $variant)
            <div class="product-colors__item product-colors__item--{{ $variant->color->name }}">{{ $variant->color->name }}</div>
          @endforeach
        </div>
       </div>

       <div class="product-sizes">
        <h2 class="product-sizes__title">Sizes</h2>
        <div class="product-sizes__list">
          @foreach ($productVariants as $variant)
            <div class="product-sizes__item">{{ $variant->size->name }}</div>
          @endforeach
       </div>
       </div>
       
       <div class="product-add-to-cart">
        <x-button color="primary" size="md">Add to cart</x-button>
        <x-button color="secondary" size="md">Add to wishlist</x-button>
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
 