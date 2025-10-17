@props([
    'name' => null,
    'id' => null,
    'value' => null,
    'label' => null,
    'checked' => false,
    'required' => false,
])

<div class="radio-input">
    <input 
        type="radio" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'radio-input__input']) }}
    >
    @if($label)
        <label for="{{ $id }}" class="radio-input__label">
            {{ $label }}
        </label>
    @endif
</div>