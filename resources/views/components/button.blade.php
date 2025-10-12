@props([
    'type' => 'button',
    'color' => 'primary',
    'size' => 'md',
    'icon' => false,
])

@php
$classes = match($color) {
    'primary' => 'btn btn--primary btn--'.$size,
    'secondary' => 'btn btn--secondary btn--'.$size,
    'danger' => 'btn btn--danger btn--'.$size,
    'icon' => 'btn btn--icon btn--'.$size,
    'icon-danger' => 'btn btn--icon-danger btn--'.$size,
    default => 'btn btn--primary btn--'.$size,
};
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "$classes"]) }}>
    {{ $slot }}
</button>
