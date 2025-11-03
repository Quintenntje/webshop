@props([
    'name' => null,
    'id' => null,
    'value' => null,
    'checked' => false,
    'required' => false,
])

<label class="radio-input">
    <input 
        type="radio" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'radio-input__input']) }}
    >
    <div class="radio-input__content">
        {{ $slot }}
    </div>
</label>