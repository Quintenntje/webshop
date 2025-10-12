@props([
    'type' => 'button',
    'color' => 'primary',
    'size' => 'md',
    'name' => null,
])

@php
$classes = match($color) {
    'primary' => 'btn btn--primary btn--'.$size,
    'secondary' => 'btn btn--secondary btn--'.$size,
    'danger' => 'btn btn--danger btn--'.$size,
    'icon' => 'btn btn--icon btn--'.$size,
    'icon-danger' => 'btn btn--icon-danger btn--'.$size,
    'transparent' => 'btn btn--transparent btn--'.$size,
    default => 'btn btn--primary btn--'.$size,
};
@endphp

<button name="{{ $name }}" type="{{ $type }}" {{ $attributes->merge(['class' => "$classes"]) }}>
    {{ $slot }}
</button>
