@if (flash()->message)
    <div
        x-data="{ display: false }"
        x-init="setTimeout(() => display = true, 800); $watch('display', (value) => { setTimeout(() => display = false, 5000) })"
        aria-live="assertive"
        class="fixed inset-0 z-50 flex items-start px-4 py-6 pointer-events-none sm:p-6">
        <div class="flex items-center justify-center w-full space-y-4">
            <div
                x-show="display"
                x-cloak
                x-on:click.outside="display = false"
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="-translate-y-12 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100 "
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="w-full max-w-sm overflow-hidden bg-white rounded shadow-md pointer-events-auto ring-1 ring-black ring-opacity-5">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex flex-shrink-0">
                            <button type="button" x-on:click="display = false" class="inline-flex text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2">
                                <span class="sr-only">Close</span>
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex-1 w-0 rtl:mr-3 ltr:ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ __("ui.alerts." . flash()->level . ".title") }}</p>
                            <p class="mt-1 text-sm text-gray-700">{!! flash()->message !!}</p>
                        </div>
                        <div class="flex-shrink-0 mr-4">
                            {!! __("ui.alerts." . flash()->level . ".icon") !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
