@php
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
@endphp

<x-layout>
   <div class="container">
     <section class="product-detail">
       <div class="product-detail__content mobile-only">
         <h1 class="product-detail__title">
           {{ $product->name }}
         </h1>
 
         <p class="product-detail__gender">
           {{ $product->gender->name }} {{ __('product.shoes') }}
         </p>
 
         <div class="product-detail__price">
            @if($product->hasActiveDiscount())
                <span class="product-detail__price--original">€{{ number_format($product->price, 2) }}</span>
                <span class="product-detail__price--discounted">€{{ number_format($product->final_price, 2) }}</span>
            @else
                <span class="product-detail__price--regular">€{{ number_format($product->price, 2) }}</span>
            @endif
         </div>
       </div>

       <div class="product-detail__container">
 
       <div class="product-detail__images">
         <div class="product-detail__primary-image">
           <img 
             src="{{ $primaryImage->filename ?? $product->primaryImage->filename }}" 
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
          {{ $product->gender->name }} {{ __('product.shoes') }}
          {{ $product->brand->name }}
        </p>

        <div class="product-detail__price">
            @if($product->hasActiveDiscount())
                <span class="product-detail__price--original">€{{ number_format($product->price, 2) }}</span>
                <span class="product-detail__price--discounted">€{{ number_format($product->final_price, 2) }}</span>
            @else
                <span class="product-detail__price--regular">€{{ number_format($product->price, 2) }}</span>
            @endif
        </div>
        </div>

       <div class="product-colors">
        <h2 class="product-colors__title">{{ __('product.colors') }}</h2>
        <div class="product-colors__list">
          @foreach ($allAvailableColors as $color)
            <a href="{{ LaravelLocalization::getLocalizedURL(null, '/shoes/' . $product->gender->slug . '/' . $product->slug . '?color_id=' . $color->id) }}" class=" product-colors__item product-colors__item--{{ $color->name }} {{ $color->id == $color_id ? 'product-colors__item--active' : '' }}   ">{{ $color->name }}</a>
          @endforeach
        </div>
       </div>

       <div class="product-sizes">
        <h2 class="product-sizes__title">{{ __('product.sizes') }}</h2>
        <div class="product-sizes__list">
          @foreach ($allAvailableSizes as $size)
            @if($size->isInStock)
              <a href="{{ LaravelLocalization::getLocalizedURL(null, '/shoes/' . $product->gender->slug . '/' . $product->slug . '?color_id=' . $color_id . '&size_id=' . $size->id) }}" 
                 class="product-sizes__item {{ $size->isActive ? 'product-sizes__item--active' : '' }}">
                EU {{ $size->name }}
              </a>
            @else
              <span class="product-sizes__item product-sizes__item--out-of-stock" title="{{ __('product.out_of_stock') }}">
                EU {{ $size->name }}
              </span>
            @endif
          @endforeach
       </div>

       @error('product_variant_id')
        <p class="auth__error">{{ str_starts_with($message, 'messages.') ? __($message) : $message }}</p>
       @enderror
       </div>

       @if(session('success'))
        <div class="product-add-to-cart">
            <p class="auth__success">{{ str_starts_with(session('success'), 'messages.') ? __(session('success')) : session('success') }}</p>
        </div>
       @endif
       <div class="product-add-to-cart">
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_variant_id" value="{{ $productVariant->id ?? 0 }}">
            <input type="hidden" name="quantity" value="1">
            <x-button type="submit" color="primary" size="md">{{ __('product.add_to_cart') }}</x-button>
        </form>
        <form action="{{ route('wishlist.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_variant_id" value="{{ $productVariant->id ?? 0 }}">
            <x-button type="submit" name="add-to-wishlist" value="add-to-wishlist" color="secondary" size="md">{{ __('product.add_to_wishlist') }}</x-button>
        </form>
       </div>
       <div class="product-details">
        <h2 class="product-details__title">{{ __('product.details') }}</h2>
        <div class="product-details__list">
          <p>{{ $product->description }}</p>
        </div>
      </div>
    </div>
       </div>
     </section>
   </div>
 </x-layout>
 