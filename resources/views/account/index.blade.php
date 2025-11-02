<x-layout>
    <section class="container container--md">
        <div class="account">
            <div class="account__header">
                <div class="account__user-info">
                    <h1 class="account__title">{{ __('account.my_account') }}</h1>
                    <p class="account__subtitle">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                    <p class="account__email">{{ Auth::user()->email }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <x-button type="submit" color="primary" size="md">{{ __('account.logout') }}</x-button>
                </form>
            </div>

            <div class="account__tabs">
                <a href="{{ route('account') }}" class="account__tab account__tab--active">
                    {{ __('account.orders') }}
                </a>
                <a href="{{ route('account.addresses') }}" class="account__tab">
                    {{ __('account.addresses') }}
                </a>
            </div>

            <div class="account__content account__content--active">
                @if($orders->count() > 0)
                    <div class="orders-list">
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-icon lucide-package"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/><path d="M12 22V12"/><polyline points="3.29 7 12 12 20.71 7"/><path d="m7.5 4.27 9 5.15"/></svg>
                        </div>
                        <h2 class="empty-state__title">{{ __('account.no_orders_title') }}</h2>
                        <p class="empty-state__description">{{ __('account.no_orders_description') }}</p>
                        <x-link href="/shop" color="primary" size="md">{{ __('account.continue_shopping') }}</x-link>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layout>
