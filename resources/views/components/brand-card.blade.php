@props(['brand'])
@php
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
@endphp

<a href="{{ LaravelLocalization::getLocalizedURL(null, '/brand/' . $brand->slug) }}" class="brand-card" title="{{ $brand->name }}">
    <div class="brand-card__overlay"></div>
    <img src="{{ $brand->image }}" alt="{{ $brand->name }}" class="brand-card__logo">
</a>
