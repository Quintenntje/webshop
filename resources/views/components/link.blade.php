@props([
    'href' => '#',
    'color' => 'primary',
    'size' => 'md',
])

@php

$classes = match($color) {
    'primary' => 'link link--primary link--'.$size,
    'secondary' => 'link link--secondary link--'.$size,
    'danger' => 'link link--danger link--'.$size,
    'success' => 'link link--success link--'.$size,
    'full' => 'link link--full link--'.$size,
    default => 'link link--primary link--'.$size,
};
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => "$classes"]) }}>
    {{ $slot }}
</a>
