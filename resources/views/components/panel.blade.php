@props(['heading', 'footer'])

<div {{ $attributes->merge(['class' => 'bg-white rounded-sm border border-gray-200 shadow-sm']) }}>
    @isset($heading)
        <div {{ $heading->attributes->merge(['class' => 'px-5 py-4 pb-3 border-b border-gray-200']) }}>
            {{ $heading }}
        </div>
    @endisset

    <div {{ $slot->attributes->merge(['class' => 'px-5 py-5']) }}>
        {{ $slot }}
    </div>

    @isset($footer)
        <div {{ $footer->attributes->merge(['class' => 'px-5 py-4']) }}>
            {{ $footer }}
        </div>
    @endisset
</div>
