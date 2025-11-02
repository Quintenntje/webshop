@php
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
@endphp

<x-layout>
    <section class="container container--md">
        <div class="error-page">
            <h1 class="error-page__title">
                {{ __('errors.not_found_title') }}
            </h1>
            <p class="error-page__subtitle">
                {{ __('errors.not_found_subtitle') }}
            </p>
            <p class="error-page__description">
                {{ __('errors.not_found_description') }}
            </p>
            <div class="error-page__actions">
                <x-link href="{{ LaravelLocalization::getLocalizedURL(null, '/') }}" color="primary" size="md">
                    {{ __('errors.back_to_home') }}
                </x-link>
                <x-link href="{{ LaravelLocalization::getLocalizedURL(null, '/shop') }}" color="secondary" size="md">
                    {{ __('errors.go_to_shop') }}
                </x-link>
            </div>
        </div>
    </section>
</x-layout>

