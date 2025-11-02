@props(['gender'])

<a href="/shoes/{{ $gender->slug }}" class="gender-card">
    <div class="gender-card__overlay"></div>
    <div class="gender-card__content">
        <h3 class="gender-card__title">{{ $gender->name }}</h3>
        <div class="gender-card__cta"> <p>{{ __('global.shop_now') }}</p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-icon lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></div>
    </div>
</a>

