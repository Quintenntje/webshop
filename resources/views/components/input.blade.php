@props([
    'type' => 'text',
    'name' => null,
    'label' => null,
    'placeholder' => null,
    'required' => false,
    'color' => 'primary',
    'size' => null,
])

@php
$classes = match($color) {
    'primary' => 'input input--primary' . " input--$size",
    'secondary' => 'input input--secondary' . " input--$size",
    'transparent' => 'input input--transparent' ." input--$size",
    'danger' => 'input input--danger' . " input--$size",
    default => 'input input--primary' . " input--$size" ,
};
@endphp

@if ($type === 'password')
    <div class="input input__password ">
        <input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} >
        <x-button type="button" color="transparent" size="sm" class="input__password__button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
        </x-button>
    </div>

    @elseif ($label)
    <label class="input__label">{{ $label }}
    <input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $attributes->merge(['class' => "$classes" ]) }}>
</label>
    @else
    <input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $attributes->merge(['class' => "$classes" ]) }}>
    @endif
