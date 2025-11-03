@props([
    'name' => null,
    'id' => null,
    'value' => null,
    'checked' => false,
    'required' => false,
])

@php
    $isChecked = filter_var($checked, FILTER_VALIDATE_BOOLEAN);
@endphp

<label class="radio-input">
    <input 
        type="radio" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        value="{{ $value }}"
        {{ $isChecked ? 'checked' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'radio-input__input']) }}
    >
    <div class="radio-input__content">
        {{ $slot }}
    </div>
</label>