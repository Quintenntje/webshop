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
                
                <div class="shipping-form__section">
                    <h3 class="shipping-form__section-title">{{ __('checkout.user_information') }}</h3>
                    <div class="form__group">
                        <x-input label="{{ __('checkout.first_name') }}" color="transparent" type="text" name="first_name" placeholder="{{ __('checkout.first_name') }}" required value="{{ $customer->first_name ?? $shippingInfo['first_name'] ?? '' }}" />
                        <x-input label="{{ __('checkout.last_name') }}" color="transparent" type="text" name="last_name" placeholder="{{ __('checkout.last_name') }}" required value="{{ $customer->last_name ?? $shippingInfo['last_name'] ?? '' }}" />
                    </div>
                    <div class="form__group">
                        <x-input label="{{ __('checkout.email') }}" color="transparent" type="email" name="email" placeholder="{{ __('checkout.email') }}" required value="{{ $customer->email ?? $shippingInfo['email'] ?? '' }}" />
                    </div>
                    <div class="form__group">
                        <x-input label="{{ __('checkout.phone') }}" color="transparent" type="tel" name="phone" placeholder="{{ __('checkout.phone') }}" required value="{{ $customer->phone_number ?? $shippingInfo['phone'] ?? '' }}" />
                    </div>
                </div>

                <div class="shipping-form__section">
                    <h3 class="shipping-form__section-title">{{ __('checkout.address_information') }}</h3>
                    
                    @if($customer && $addresses->count() > 0)
                        <div class="shipping-form__address-selection">
                            <div class="form__group">
                                <x-radio-input name="address_selection" id="address_new" value="new" checked="{{ !session('checkout.shipping.address_id') }}">
                                    {{ __('checkout.new_address') }}
                                </x-radio-input>
                            </div>
                            
                            @foreach($addresses as $address)
                                <div class="form__group">
                                    <x-radio-input name="address_selection" id="address_{{ $address->id }}" value="existing" checked="{{ session('checkout.shipping.address_id') == $address->id }}" data-address-id="{{ $address->id }}">
                                        <div>
                                            <p>{{ $address->address }}</p>
                                            <div>{{ $address->city }}, {{ $address->postal_code }}</div>
                                            <div>{{ $address->country }}</div>
                                        </div>
                                    </x-radio-input>
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="address_id" id="selected_address_id" value="{{ session('checkout.shipping.address_id') ?? '' }}">
                    @endif

                    <div class="shipping-form__address-fields" id="addressFields" style="{{ $customer && $addresses->count() > 0 && session('checkout.shipping.address_id') ? 'display: none;' : '' }}">
                        <div class="form__group">
                            <x-input label="{{ __('checkout.address') }}" color="transparent" type="text" name="address" id="input_address" placeholder="{{ __('checkout.address') }}" required value="{{ $shippingInfo['address'] ?? '' }}" />
                        </div>
                        <div class="form__group">
                            <x-input label="{{ __('checkout.city') }}" color="transparent" type="text" name="city" id="input_city" placeholder="{{ __('checkout.city') }}" required value="{{ $shippingInfo['city'] ?? '' }}" />
                            <x-input label="{{ __('checkout.postal_code') }}" color="transparent" type="number" name="postal_code" id="input_postal_code" placeholder="{{ __('checkout.postal_code') }}" required value="{{ $shippingInfo['postal_code'] ?? '' }}" />
                            <x-input label="{{ __('checkout.country') }}" color="transparent" type="text" name="country" id="input_country" placeholder="{{ __('checkout.country') }}" required value="{{ $shippingInfo['country'] ?? '' }}" />
                        </div>
                    </div>
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