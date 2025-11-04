@php
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
@endphp

<footer class="footer">
    <div class="container footer__container">
        <div class="footer__content">
            <div class="footer__column">
                <h3 class="footer__column__title footer__column__title--company">CoolKicks</h3>
                <p class="footer__column__description">{{ __('footer.company_description') }}</p>
            </div>
            <div class="footer__column">
                <h3 class="footer__column__title">{{ __('global.shoes') }}</h3>
                <ul class="footer__column__list">
                    <li class="footer__column__item">
                        <a href="{{ LaravelLocalization::getLocalizedURL(null, '/shop') }}" class="footer__column__link">{{ __('global.all') }}</a>
                    </li>
                    <li class="footer__column__item">
                        <a href="{{ LaravelLocalization::getLocalizedURL(null, '/shoes/men') }}" class="footer__column__link">{{ __('global.men') }}</a>
                    </li>
                    <li class="footer__column__item">
                        <a href="{{ LaravelLocalization::getLocalizedURL(null, '/shoes/women') }}" class="footer__column__link">{{ __('global.women') }}</a>
                    </li>
                    <li class="footer__column__item">
                        <a href="{{ LaravelLocalization::getLocalizedURL(null, '/shoes/unisex') }}" class="footer__column__link">{{ __('global.unisex') }}</a>
                    </li>
                    <li class="footer__column__item">
                        <a href="{{ LaravelLocalization::getLocalizedURL(null, '/shoes/kids') }}" class="footer__column__link">{{ __('global.kids') }}</a>
                    </li>
                </ul>
            </div>
            <div class="footer__column">
                <h3 class="footer__column__title">{{ __('footer.customer_support') }}</h3>
                <ul class="footer__column__list">
                    <li class="footer__column__item">
                        <a href="/" class="footer__column__link">{{ __('footer.privacy_policy') }}</a>
                    </li>
                    <li class="footer__column__item">
                        <a href="/" class="footer__column__link">{{ __('footer.contact') }}</a>
                    </li>
                    <li class="footer__column__item">
                        <a href="/" class="footer__column__link">{{ __('footer.terms_of_service') }}</a>
                    </li>
                </ul>
            </div>
            <div class="footer__column">
                <h3 class="footer__column__title footer__column__title--join-the-club">{{ __('footer.join_the_club') }}</h3>
                <p class="footer__column__description">{{ __('footer.newsletter_description') }}</p>
                <form action="{{ route('newsletter.store') }}" method="POST" class="footer__column__form">
                    @csrf
                    <input type="email" name="email" required placeholder="{{ __('footer.email_placeholder') }}" class="footer__column__input">
                    <x-button type="submit" color="secondary" size="sm" class="footer__column__button margin-top-sm">{{ __('footer.subscribe') }}</x-button>
                </form>
            </div>
        </div>
    </div>
</footer>