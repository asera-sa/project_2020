@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-x-3 group p-2 text-sm font-semibold text-primary-600 rounded-sm leading-6 bg-primary-50/70 focus:outline-none focus:ring-1 focus:ring-primary-600 transition duration-150 ease-in-out'
            : 'flex items-center gap-x-3 group p-2 text-sm font-semibold text-gray-700 rounded-sm leading-6 hover:text-primary-600 hover:bg-primary-50/70 focus:outline-none focus:ring-1 focus:ring-primary-600 transition duration-150 ease-in-out';
@endphp

<a  {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
