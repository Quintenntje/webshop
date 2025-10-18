<x-layout>
    <section class="container container--md">
        <div class="account">
            <div class="account__header">
                <div class="account__user-info">
                    <h1 class="account__title">My Account</h1>
                    <p class="account__subtitle">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                    <p class="account__email">{{ Auth::user()->email }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <x-button type="submit" color="primary" size="md">Logout</x-button>
                </form>
            </div>

            <div class="account__tabs">
                <a href="{{ route('account') }}" class="account__tab">
                    Orders
                </a>
                <a href="{{ route('account.addresses') }}" class="account__tab account__tab--active">
                    Addresses
                </a>
            </div>

            <div class="account__content account__content--active">
                @if($addresses->count() > 0)
                    <div class="addresses-list">
                        @foreach($addresses as $address)
                            <div class="address-card">
                                <div class="address-card__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </div>
                                <div class="address-card__content">
                                    <p class="address-card__line">{{ $address->address }}</p>
                                    <p class="address-card__line">{{ $address->city }}, {{ $address->postal_code }}</p>
                                    <p class="address-card__line">{{ $address->country }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <h2 class="empty-state__title">No addresses saved yet.</h2>
                        <p class="empty-state__description">Add a shipping address when you place your first order.</p>
                        <x-link href="/" color="primary" size="md">Continue shopping</x-link>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layout>

