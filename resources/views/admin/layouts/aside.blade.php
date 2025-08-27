<div x-data="{ open: false }">
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-cloak x-show="open" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-gray-900/80"></div>

        <div class="fixed inset-0 flex" x-cloak x-show="open" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
            <div class="relative flex flex-1 w-full max-w-xs me-16" x-cloak x-show="open" x-transition:enter="ease-in-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="absolute top-0 flex justify-center w-16 pt-5 right-full">
                    <button x-on:click="open = false" type="button" class="-m-2.5 p-2.5 focus:outline-none focus:ring-1 focus:ring-white focus:ring-offset-1 rounded-md">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @include('admin.layouts.navigation')
            </div>
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
        @include('admin.layouts.navigation')
    </div>

    <header class="lg:ps-72">
        <div class="sticky top-0 z-40 lg:mx-auto lg:max-w-7xl lg:px-8">
            <div style="padding: 50px;" class="flex items-center h-16 px-4 border-b border-gray-200 shadow-sm gap-x-4 sm:px-6 lg:px-0 lg:shadow-none">
                <button x-on:click="open = true" type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden focus:outline-none focus:ring-1 focus:ring-gray-700 focus:ring-offset-1 rounded-md">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Separator -->
                <div class="w-px h-6 bg-gray-200 lg:hidden " aria-hidden="true"></div>
                        <div class="m1-20" style="display: flex; justify-content: center; align-items: center; ">
                            <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
                        </div>
                <div class="flex justify-between flex-1 gap-x-4 lg:justify-end lg:gap-x-6">
                    <div class="block lg:hidden">
                        <x-dashboard-logo side="قسم التدريب" />
                    </div>

                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <!-- Profile dropdown -->
                        <div x-data="{ show: false }" class="relative">
                            <button x-on:click="show = ! show" x-on:click.outside="show = false" type="button" @class(["-m-1.5 flex items-center p-1.5 focus:outline-none focus:ring-1 focus:ring-gray-900 focus:ring-offset-1 rounded-md", "bg-yellow-100 text-yellow-700 focus:!ring-yellow-700" => session()->has('impersonate')]) id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <x-heroicon-o-user-circle class="w-6 h-6" />
                                <span class="hidden lg:flex lg:items-center">
                                    <span class="text-xs font-semibold leading-6 text-gray-900 ms-2" aria-hidden="true">{{ auth()->user()->user_name }}</span>
                                    <svg class="w-4 h-4 -mt-[1px] ms-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>

                            <div class="absolute z-10 py-2 mt-3 origin-top-right bg-white rounded-md shadow-lg -left-2 w-36 ring-1 ring-gray-900/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" x-cloak x-show="show" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                                <a href="{{ route('admin.profile.edit') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50" role="menuitem" tabindex="-1" id="user-menu-item-0">{{ __('الملف الشخصي') }}</a>
                                <a onclick="event.preventDefault(); document.getElementById('admin-form-logout').submit();" href="{{ route('logout') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50" role="menuitem" tabindex="-1" id="user-menu-item-1">{{ __('تسجيل خروج') }}</a>
                                <form id="admin-form-logout" method="POST" action="{{ route('logout') }}"> @csrf </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
