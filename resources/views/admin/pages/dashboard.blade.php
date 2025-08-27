<x-admin-layout>
    <x-slot name="slot">
        <main>
            <section class="grid grid-cols-2 gap-6">
                <div class="col-span-full md:col-span-1">
                    <x-panel>
                        <x-slot name="heading">
                            <div class="flex items-center justify-between">
                                <h2 class="flex items-center text-sm font-semibold text-primary-600 gap-x-1">
                                    <x-heroicon-o-face-smile class="w-5 h-5" />
                                    <span>مرحباً بك مجدداً</span>
                                </h2>
                                <div class="text-xs font-medium text-gray-700">
                                    <span>{{ now()->translatedFormat('l،') }}</span>
                                    <span class="font-mono">{{ now()->translatedFormat('d') }}</span>
                                    <span>{{ now()->translatedFormat('F') }}</span>
                                    <span class="font-mono">{{ now()->translatedFormat('Y') }}</span>
                                </div>
                            </div>
                        </x-slot>
                        <x-slot name="slot">
                            <ul class="text-sm text-gray-700 divide-y divide-gray-200">
                                <li class="flex items-center justify-between py-2.5">
                                    <div class="flex items-center text-gray-500 gap-x-3">
                                        <x-heroicon-o-user class="w-5 h-5 text-gray-500" />
                                        <span>الاسم</span>
                                    </div>
                                    <div class="font-medium text-gray-700">
                                        {{ auth()->user()->name }}
                                    </div>
                                </li>
                                <li class="flex items-center justify-between py-2.5">
                                    <div class="flex items-center text-gray-500 gap-x-3">
                                        <x-heroicon-o-envelope class="w-5 h-5 -mb-0.5 text-gray-500" />
                                        <span>البريد الإلكتروني</span>
                                    </div>
                                    <div class="font-medium text-gray-700">
                                        {{ auth()->user()->email }}
                                    </div>
                                </li>
                            </ul>
                        </x-slot>
                    </x-panel>
                </div>
                <div class="col-span-full md:col-span-1">
                    <x-panel>
                        <x-slot name="heading">
                            <h2 class="flex items-center text-sm font-semibold text-primary-600 gap-x-1">
                                <x-heroicon-o-bolt class="w-5 h-5" />
                                <span>الوصول السريع</span>
                            </h2>
                        </x-slot>
                        <x-slot name="slot">
                            <ul class="space-y-3">
                                <li>
                                    <x-buttons.secondary-link :href="route('admin.institutions.create')" class="justify-center w-full">
                                        <x-heroicon-o-plus class="w-4 h-4" stroke-width="2" />
                                        <span>إضافة مصلحة جديدة</span>
                                    </x-buttons.secondary-link>
                                </li>
                                <li>
                                    <x-buttons.secondary-link :href="route('license_requests.index')" class="justify-center w-full">
                                        <x-heroicon-o-plus class="w-4 h-4" stroke-width="2" />
                                        <span> طلبات الترخيص </span>
                                    </x-buttons.secondary-link>
                                </li>
                            </ul>
                        </x-slot>
                    </x-panel>
                </div>
            </section>

            <section class="grid order-last grid-cols-1 gap-4 mt-8 lg:grid-cols-2">
                <div class="flex flex-col bg-white border border-gray-200">
                    <div class="flex-1 px-4 py-4">
                        <dt>
                            <div class="absolute p-3 rounded-full bg-primary-50">
                                <x-heroicon-o-squares-2x2 class="w-6 h-6" />
                            </div>
                            <p class="mr-16 text-sm font-medium text-gray-500 truncate">
                                إجمالي  المصالح
                            </p>
                        </dt>
                        <dd class="flex items-baseline mr-16">
                            <p class="mt-1.5 font-mono text-2xl font-semibold text-gray-900">{{$institutionCount}}</p>
                        </dd>
                    </div>

                    <div class="px-4 py-1 border-t sm:px-6 rounded-b-md">
                        <a href="'#'" class="inline-flex items-center text-sm font-semibold hover:text-primary-700 hover:underline">
                            <span class="text-white">عرض الكل</span>
                            <x-heroicon-o-arrow-long-left class="w-5 h-5 mr-2 text-white" />
                        </a>
                    </div>
                </div>

                <div class="flex flex-col bg-white border border-gray-200">
                    <div class="flex-1 px-4 py-4">
                        <dt>
                            <div class="absolute p-3 rounded-full bg-primary-50">
                                <x-heroicon-o-building-storefront class="w-6 h-6" />
                            </div>
                            <p class="mr-16 text-sm font-medium text-gray-500 truncate">
                                إجمالي المستخدمين
                            </p>
                        </dt>
                        <dd class="flex items-baseline mr-16">
                            <p class="mt-1.5 font-mono text-2xl font-semibold text-gray-900">{{$userCount}}</p>
                        </dd>
                    </div>

                    <div class="px-4 py-1 border-t sm:px-6 rounded-b-md">
                        <a href="'#''" class="inline-flex items-center text-sm font-semibold text-primary-600 hover:text-primary-700 hover:underline">
                            <span class="text-white">عرض الكل</span>
                            <x-heroicon-o-arrow-long-left class="w-5 h-5 mr-2 text-white" />
                        </a>
                    </div>
                </div>



            </section>
        </main>
    </x-slot>
</x-admin-layout>
