@props(['route'])

<div x-cloak x-data="{ show: false }" @style(['display: inline-block' => $attributes->has('inline')])>
    <button type="button" x-on:click.prevent="show = true" class="{{ $attributes->has('class') ? $attributes->get('class') : 'inline-flex justify-center items-center px-6 py-2.5 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-red-500 active:bg-red-800 focus:outline-none focus:border-red-100 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150' }}">
        {{ $slot }}
    </button>

    <div x-show="show" class="relative w-full h-full">
        <div class="fixed top-0 left-0 z-[1000] flex items-center justify-center w-screen h-screen bg-black/60"></div>

        <div class="fixed z-[1001] w-3/4 mx-auto right-[12.5%] md:w-1/3 md:right-1/3 top-1/3">
            <div class="flex flex-col p-5 bg-white rounded-lg shadow">
                <div class="flex">
                    <div>
                        <svg class="w-6 h-6 text-red-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 5.99L19.53 19H4.47L12 5.99M12 2L1 21h22L12 2zm1 14h-2v2h2v-2zm0-6h-2v4h2v-4z"/>
                        </svg>
                    </div>

                    <div class="mr-3">
                        <h2 class="font-semibold text-right text-gray-800">{{ __('هل أنت متأكد من الحذف ؟') }}</h2>
                        <p class="mt-2 text-sm leading-relaxed text-gray-700">
                            {{ __('لن تتمكن من التراجع عن هذا اﻹجراء .') }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center mt-5">
                    <button x-on:click.prevent="show = false" type="button" class="flex-1 px-4 py-2 ml-2 text-sm font-medium text-gray-900 bg-gray-200 rounded-md hover:bg-gray-300 focus:ring-1 focus:ring-gray-500 focus:ring-offset-1 focus:outline-none">
                        {{ __('إلغاء الأمر') }}
                    </button>
                    <form action="{{ $route }}" method="post" class="flex flex-1">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="flex-1 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:ring-1 focus:ring-red-500 focus:ring-offset-1 focus:outline-none">
                            {{ __('تأكيد') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
