<x-layout>
<section class="container">
  
    <h1 class="center-content page-title">{{ __('checkout.checkout') }}</h1>

    <div class="checkout-container">
        <div class="checkout-container__left">

    <div class="checkout-steps">
        <div class="checkout-steps__step checkout-steps__step--active">
            <h2 class="checkout-steps__step-title checkout-steps__step-title--active ">{{ __('checkout.shipping_information') }}</h2>
            <form action="{{ route('checkout.shipping.store') }}" method="POST">
                @csrf
                <div class="form__group">
                <x-input color="transparent" type="text" name="first_name" placeholder="{{ __('checkout.first_name') }}" required value="{{ $customer->first_name ?? $shippingInfo['first_name'] ?? '' }}" />
                <x-input color="transparent" type="text" name="last_name" placeholder="{{ __('checkout.last_name') }}" required value="{{ $customer->last_name ?? $shippingInfo['last_name'] ?? '' }}" />
                </div>
                <div class="form__group">
                <x-input color="transparent" type="email" name="email" placeholder="{{ __('checkout.email') }}" required value="{{ $customer->email ?? $shippingInfo['email'] ?? '' }}" />
            </div>
             <div class="form__group">
                <x-input color="transparent" type="tel" name="phone" placeholder="{{ __('checkout.phone') }}" required value="{{ $customer->phone_number ?? $shippingInfo['phone'] ?? '' }}" />
            </div>
            <div class="form__group">
                <x-input color="transparent" type="text" name="address" placeholder="{{ __('checkout.address') }}" required value="{{ $shippingInfo['address'] ?? '' }}" />
            </div>
            <div class="form__group">
                <x-input color="transparent" type="text" name="city" placeholder="{{ __('checkout.city') }}" required value="{{ $shippingInfo['city'] ?? '' }}" />
                <x-input color="transparent" type="number" name="postal_code" placeholder="{{ __('checkout.postal_code') }}" required value="{{ $shippingInfo['postal_code'] ?? '' }}" />
                <x-input color="transparent" type="text" name="country" placeholder="{{ __('checkout.country') }}" required value="{{ $shippingInfo['country'] ?? '' }}" />
            </div>
            <x-button type="submit" color="primary" size="md">{{ __('checkout.continue_to_payment') }}</x-button>
            </form>
        </div>
    </div>
    <div class="checkout-steps__step">
        <h2 class="checkout-steps__step-title">{{ __('checkout.payment_method') }}</h2>
    </div>
    </div>
    <div class="checkout-container__right">
        <x-small-cart :products="$products" :cart="$cart" :total="$total" />
    </div>
    </div>
</section>
</x-layout>