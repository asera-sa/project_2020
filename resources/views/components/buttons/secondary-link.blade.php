@props(['disabled' => false])

<a @disabled($disabled) {{ $attributes->merge(['target' => '_self', 'class' => 'inline-flex items-center gap-x-2 px-4 py-2 text-xs text-gray-700 font-semibold uppercase tracking-wide rounded-sm border border-gray-400 bg-white hover:bg-gray-100 active:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-primary-600 focus:ring-offset-1 disabled:opacity-50 disabled:hover:bg-white disabled:cursor-not-allowed transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
