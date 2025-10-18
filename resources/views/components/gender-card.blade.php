@props(['gender'])

<a href="/shoes/{{ $gender->slug }}" class="gender-card">
    <div class="gender-card__overlay"></div>
    <div class="gender-card__content">
        <h3 class="gender-card__title">{{ $gender->name }}</h3>
        <p class="gender-card__cta">Shop Now →</p>
    </div>
</a>

