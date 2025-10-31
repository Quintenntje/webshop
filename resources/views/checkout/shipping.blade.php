<x-layout>
<section class="container">
  
    <h1 class="center-content page-title">Checkout</h1>

    <div class="checkout-container">
        <div class="checkout-container__left">

    <div class="checkout-steps">
        <div class="checkout-steps__step checkout-steps__step--active">
            <h2 class="checkout-steps__step-title checkout-steps__step-title--active ">Shipping Information</h2>
            <form action="{{ route('checkout.shipping.store') }}" method="POST">
                @csrf
                <div class="form__group">
                <x-input color="transparent" type="text" name="first_name" placeholder="First name" required value="{{ $customer->first_name ?? '' }}" />
                <x-input color="transparent" type="text" name="last_name" placeholder="Last name" required value="{{ $customer->last_name ?? '' }}" />
                </div>
                <div class="form__group">
                <x-input color="transparent" type="email" name="email" placeholder="Email" required value="{{ $customer->email ?? '' }}" />
            </div>
             <div class="form__group">
                <x-input color="transparent" type="tel" name="phone" placeholder="Phone" required value="{{ $customer->phone_number ?? '' }}" />
            </div>
            <div class="form__group">
                <x-input color="transparent" type="text" name="address" placeholder="Address" required />
            </div>
            <div class="form__group">
                <x-input color="transparent" type="text" name="city" placeholder="City" required />
                <x-input color="transparent" type="number" name="postal_code" placeholder="Postal code" required />
                <x-input color="transparent" type="text" name="country" placeholder="Country" required />
            </div>
            <x-button type="submit" color="primary" size="md">Continue to payment</x-button>
            </form>
        </div>
    </div>
    <div class="checkout-steps__step">
        <h2 class="checkout-steps__step-title">Payment Method</h2>
    </div>
    </div>
    <div class="checkout-container__right">
        <x-small-cart :products="$products" :cart="$cart" :total="$total" />
    </div>
    </div>
</section>
</x-layout>