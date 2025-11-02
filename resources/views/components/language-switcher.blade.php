@php
    $currentLocale = app()->getLocale();
    $locales = [
        'en' => 'English',
        'nl' => 'Nederlands',
        'fr' => 'Français',
    ];
    
    $currentPath = request()->path();
    $segments = explode('/', trim($currentPath, '/'));
    
    if (!empty($segments) && in_array($segments[0], ['fr', 'nl', 'en'])) {
        array_shift($segments);
        $pathWithoutLocale = '/' . implode('/', $segments);
        if ($pathWithoutLocale === '/') {
            $pathWithoutLocale = '/';
        }
    } else {
        $pathWithoutLocale = $currentPath;
    }
    
    $queryString = request()->getQueryString() ? '?' . request()->getQueryString() : '';
@endphp

<div class="language-switcher">
    <button class="language-switcher__button" aria-label="Change language">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-languages-icon lucide-languages"><path d="m5 8 6 6"/><path d="m4 14 6-6 2-3"/><path d="M2 5h12"/><path d="M7 2h1"/><path d="m22 22-5-10-5 10"/><path d="M14 18h6"/></svg>
    </button>
    <div class="language-switcher__dropdown" hidden data-base-path="{{ $pathWithoutLocale }}" data-query-string="{{ $queryString }}">
        @foreach($locales as $locale => $label)
            <a href="#" 
               class="language-switcher__option {{ $currentLocale === $locale ? 'language-switcher__option--active' : '' }}"
               data-locale="{{ $locale }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>