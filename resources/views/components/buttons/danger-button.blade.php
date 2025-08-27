@props(['disabled' => false])

<button @disabled($disabled) {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center gap-x-2 px-4 py-2 font-semibold text-xs text-white uppercase tracking-wide rounded-sm bg-red-600 border border-transparent hover:bg-red-500 active:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-1 focus:ring-red-500 focus:ring-offset-1 disabled:opacity-75 disabled:hover:bg-red-600 disabled:cursor-not-allowed transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
