@props(['disabled' => false, 'placeholder' => __('اختر')])

@php
    $classes = ($hasError ?? false)
                ? 'mt-2 text-sm rounded-sm shadow-sm border-red-500 focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:ring-opacity-50 focus:placeholder:opacity-0 disabled:bg-gray-100 disabled:border-gray-200 transition ease-in-out duration-150'
                : 'mt-2 text-sm rounded-sm shadow-sm border-gray-300 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 focus:ring-opacity-50 focus:placeholder:opacity-0 disabled:bg-gray-100 disabled:border-gray-200 transition ease-in-out duration-150';
@endphp

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classes]) !!}>
    @if ($placeholder == true)
        <option value="" selected disabled>{{ $placeholder }}</option>
    @endif
    {{ $slot }}
</select>
