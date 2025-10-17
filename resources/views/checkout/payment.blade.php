<x-layout>
    <section class="container">
      <h1 class="center-content page-title">Checkout</h1>
  
      <div class="checkout-container">
        <div class="checkout-container__left">
          <div class="checkout-steps">
            <div class="checkout-steps__step">
              <h2 class="checkout-steps__step-title">Shipping Information</h2>
  
              <div class="checkout-steps__step-row">
                <p>
                  <strong>Name:</strong>
                  {{ $shippingInfo['first_name'] }} {{ $shippingInfo['last_name'] }}
                </p>
              </div>
  
              <div class="checkout-steps__step-row">
                <p><strong>Email:</strong> {{ $shippingInfo['email'] }}</p>
                <p><strong>Phone:</strong> {{ $shippingInfo['phone'] }}</p>
              </div>
  
              <div class="checkout-steps__step-row">
                <p><strong>Address:</strong> {{ $shippingInfo['address'] }}</p>
              </div>
  
              <div class="checkout-steps__step-row">
                <p><strong>City:</strong> {{ $shippingInfo['city'] }}</p>
                <p><strong>Postal Code:</strong> {{ $shippingInfo['postal_code'] }}</p>
                <p><strong>Country:</strong> {{ $shippingInfo['country'] }}</p>
              </div>
  
              <x-link href="{{ route('checkout.shipping') }}" color="primary" size="sm">
                Edit shipping information
              </x-link>
            </div>
  
            <div class="checkout-steps__step checkout-steps__step--active">
              <h2 class="checkout-steps__step-title checkout-steps__step-title--active">
                Payment Method
              </h2>
  
              <div>
                <h3>Select your payment method</h3>
                <div class="form__group">
                   <x-radio-input name="payment_method" id="credit_card" value="credit_card" label="Credit Card" />
                </div>
                <div class="form__group">
                    <x-radio-input name="payment_method" id="debit_card" value="debit_card" label="Debit Card" />
                </div>
                <div class="form__group">
                    <x-radio-input name="payment_method" id="paypal" value="paypal" label="PayPal" />
                </div>
                <div class="form__group">
                    <x-radio-input name="payment_method" id="bank_transfer" value="bank_transfer" label="Bank Transfer" />
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <div class="checkout-container__right">
          <x-small-cart :products="$products" :cart="$cart" />
        </div>
      </div>
    </section>
  </x-layout>
  