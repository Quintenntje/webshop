@props([
    'type' => 'text',
    'name' => null,
    'placeholder' => null,
    'required' => false,
    'color' => 'primary',
])

@php
$classes = match($color) {
    'primary' => 'input input--primary',
    'secondary' => 'input input--secondary',
    'transparent' => 'input input--transparent',
    'danger' => 'input input--danger',
    default => 'input input--primary',
};
@endphp
<input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $attributes->merge(['class' => "$classes"]) }}>