@props(['disabled' => false])

<a @disabled($disabled) {{ $attributes->merge(['target' => '_self', 'class' => 'inline-flex items-center gap-x-2 px-4 py-2 text-xs text-white font-semibold uppercase tracking-wide rounded-sm border border-transparent bg-primary-600 hover:bg-primary-700 active:bg-primary-700 focus:bg-primary-700 focus:outline-none focus:ring-1 focus:ring-primary-700 focus:ring-offset-1 disabled:opacity-75 disabled:hover:bg-primary-600 disabled:cursor-not-allowed disabled:pointer-events-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
