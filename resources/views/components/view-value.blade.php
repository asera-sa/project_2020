@props(['value' => ''])

<div {{ $attributes->merge(['class' => 'p-2.5 mt-2 text-sm border-gray-500 rounded-sm shadow bg-gray-100/70']) }}>
    @if ($slot->isEmpty())
        {{ filled($value) ? $value : '-' }}
    @else
        {!! $slot !!}
    @endif
</div>
