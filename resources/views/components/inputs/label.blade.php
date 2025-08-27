@props(['value'])

@php
    $classes = ($hasError ?? false)
                ? 'relative block font-medium text-sm text-red-600'
                : 'relative block font-medium text-sm text-gray-700';
@endphp

<label {{ $attributes->merge(['class' => $classes]) }}>
    {{ $value ?? $slot }}

    @if ($attributes->has('required'))
        <span class="absolute mr-1 text-sm text-red-500 -top-1">*</span>
    @endif
</label>
