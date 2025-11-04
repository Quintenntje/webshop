<x-layout>
    <section class="container">
      <h1 class="center-content page-title">{{ __('checkout.checkout') }}</h1>
  
      <div class="checkout-container">
        <div class="checkout-container__left">
          <div class="checkout-steps">
            <div class="checkout-steps__step">
              <h2 class="checkout-steps__step-title">{{ __('checkout.shipping_information') }}</h2>
  
              <div class="checkout-steps__step-row">
                <p>
                  <strong>{{ __('checkout.name') }}:</strong>
                  {{ $shippingInfo['first_name'] }} {{ $shippingInfo['last_name'] }}
                </p>
              </div>
  
              <div class="checkout-steps__step-row">
                <p><strong>{{ __('checkout.email') }}:</strong> {{ $shippingInfo['email'] }}</p>
              </div>
  
              <div class="checkout-steps__step-row">
                <p><strong>{{ __('checkout.address') }}:</strong> {{ $shippingInfo['address'] }}</p>
              </div>
  
              <div class="checkout-steps__step-row">
                <p><strong>{{ __('checkout.city') }}:</strong> {{ $shippingInfo['city'] }}</p>
                <p><strong>{{ __('checkout.postal_code') }}:</strong> {{ $shippingInfo['postal_code'] }}</p>
                <p><strong>{{ __('checkout.country') }}:</strong> {{ $shippingInfo['country'] }}</p>
              </div>
  
              <x-link href="{{ route('checkout.shipping') }}" color="primary" size="sm">
                {{ __('checkout.edit_shipping_information') }}
              </x-link>
            </div>
  
            <div class="checkout-steps__step checkout-steps__step--active">
              <h2 class="checkout-steps__step-title checkout-steps__step-title--active">
                {{ __('checkout.payment_method') }}
              </h2>
  
              <div>
                <h3 class="checkout-payment__title">{{ __('checkout.select_payment_method') }}</h3>
                <form action="{{ route('checkout.payment.post') }}" method="post" id="payment-form">
                  @csrf
                  <input type="hidden" name="cart" value="{{ json_encode($cart) }}">
                  <input type="hidden" name="total" value="{{ $total }}">
                  <input type="hidden" name="address" value="{{ $shippingInfo['address'] }}">
                  <input type="hidden" name="city" value="{{ $shippingInfo['city'] }}">
                  <input type="hidden" name="postal_code" value="{{ $shippingInfo['postal_code'] }}">
                  <input type="hidden" name="country" value="{{ $shippingInfo['country'] }}"> 
                  <input type="hidden" name="first_name" value="{{ $shippingInfo['first_name'] }}">
                  <input type="hidden" name="last_name" value="{{ $shippingInfo['last_name'] }}">
                  <input type="hidden" name="email" value="{{ $shippingInfo['email'] }}">
                  
                  <div class="checkout-payment__methods">
                    <div class="form__group radio-input-group">
                      <x-radio-input name="payment_method" id="credit_card" value="credit_card" checked="true" required>{{ __('checkout.credit_card') }}</x-radio-input>
                    </div>
                    <div class="form__group radio-input-group">
                      <x-radio-input name="payment_method" id="debit_card" value="debit_card" required>{{ __('checkout.debit_card') }}</x-radio-input>
                    </div>
                    <div class="form__group radio-input-group">
                      <x-radio-input name="payment_method" id="paypal" value="paypal" required>{{ __('checkout.paypal') }}</x-radio-input>
                    </div>
                    <div class="form__group radio-input-group">
                      <x-radio-input name="payment_method" id="bank_transfer" value="bank_transfer" required>{{ __('checkout.bank_transfer') }}</x-radio-input>
                    </div>
                  </div>

                  @error('payment_method')
                    <p class="checkout-payment__error">{{ $message }}</p>
                  @enderror

                  <div class="checkout-payment__actions">
                    <x-button type="submit" color="primary" size="md">{{ __('checkout.continue_to_payment') }}</x-button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
  
        <div class="checkout-container__right">
          <x-small-cart :products="$products" :cart="$cart" :total="$total" />
        </div>
      </div>
    </section>
  </x-layout>
  