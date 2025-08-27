@props(['side' => ''])

<div class="inline-flex items-center gap-1 text-lg font-semibold">
    {{-- <span>لوحة التحكم</span> --}}

    @if (filled($side))
        {{-- <x-icon-dot /> --}}
        <span>{{ $side }}</span>
    @endif
</div>
