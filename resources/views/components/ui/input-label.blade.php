@props(['value'])

<label {{ $attributes->merge(['class' => 'form-label small-text']) }}>
    {{ $value ?? $slot }}
</label>