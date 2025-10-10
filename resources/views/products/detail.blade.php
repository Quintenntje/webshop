<x-layout>
   <div class="container">
     <section class="product-detail">
       <div class="product-detail__content">
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
     </section>
   </div>
 </x-layout>
 