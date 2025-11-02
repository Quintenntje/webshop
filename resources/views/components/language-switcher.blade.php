@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $currentLocale = app()->getLocale();
    $supportedLocales = LaravelLocalization::getSupportedLocales();
@endphp

<div class="language-switcher">
    <button class="language-switcher__button" aria-label="Change language">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-languages-icon lucide-languages"><path d="m5 8 6 6"/><path d="m4 14 6-6 2-3"/><path d="M2 5h12"/><path d="M7 2h1"/><path d="m22 22-5-10-5 10"/><path d="M14 18h6"/></svg>
    </button>
    <div class="language-switcher__dropdown" hidden>
        @foreach($supportedLocales as $localeCode => $properties)
            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" 
               class="language-switcher__option {{ $currentLocale === $localeCode ? 'language-switcher__option--active' : '' }}"
               data-locale="{{ $localeCode }}">
                {{ $properties['native'] }}
            </a>
        @endforeach
    </div>
</div>