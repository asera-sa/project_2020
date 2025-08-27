<x-admin-layout>
    <x-slot name="slot">
        <div class="grid grid-cols-12 gap-4">
            <section class="order-last col-span-full md:col-span-9 md:order-first">
                <x-panel>
                    <x-slot name="heading">
                        <h2 class="text-base font-medium">{{ __('طلبات الترخيص') }}</h2>
                    </x-slot>
                    <x-slot name="slot">
                        <div class="overflow-auto">
                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('اسم الجهة') }}</th>
                                        <th scope="col">{{ __('نوع الجهة') }}</th>
                                        <th scope="col">{{ __('تاريخ الطلب') }}</th>
                                        <th scope="col">{{ __('حالة الطلب') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($licenseRequests as $request)
                                        <tr>
                                            <td class="font-mono">{{ $loop->iteration }}</td>
                                            <td>{{ $request->institution->name ?? '-' }}</td>
                                            <td>{{ $request->institution->type ?? '-' }}</td>
                                            <td>{{ $request->created_at->toDateString() ?? '' }}</td>
                                            <td>
                                                <div @class([$request->state->getUiClasses()])>
                                                    <span>{{ $request->state->getName() }}</span>
                                                </div>
                                            </td>
                                            <td class="actions">
                                                <a href="{{ route('license_requests.show', $request) }}" class="view">
                                                    <span>{{ __('عرض التفاصيل') }}</span>
                                                    <x-heroicon-o-arrow-long-left class="w-4 h-4" stroke-width="2" />
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-3 py-4 text-center">
                                                @if (request()->has('filter'))
                                                    <span>{{ __('عذرًا, لم نجد ماتبحث عنه.') }}</span>
                                                @else
                                                    <span>{{ __('لم يتم إدراج أي طلبات بعد.') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if ($licenseRequests->hasPages())
                                <tfoot class="bg-transparent">
                                    <tr>
                                        <th colspan="6">{{ $licenseRequests->onEachSide(0)->withQueryString()->links() }}</th>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                    </x-slot>
                </x-panel>
            </section>

            <aside class="space-y-4 col-span-full md:col-span-3">
                @if(auth()->user()->isAdministrator() || auth()->user()->isInstitutionOwner())
                    <x-buttons.primary-link :href="route('license_requests.create')" class="justify-center w-full">
                        <x-heroicon-o-plus class="w-4 h-4" stroke-width="2" />
                        <span>{{ __('إضافة طلب ترخيص جديد') }}</span>
                    </x-buttons.primary-link>
                @endif
                <form action="{{ route('license_requests.index') }}" method="get">
                    <x-panel>
                        <x-slot name="heading">
                            <h3 class="inline-flex text-sm font-medium licenses-center gap-x-2">
                                <x-heroicon-o-funnel class="w-4 h-4" stroke-width="2" />
                                <span>
                                    <span>{{ __('فرز النتائج') }}</span>
                                    <span>({{ $licenseRequests->total() }})</span>
                                </span>
                            </h3>
                        </x-slot>
                        <x-slot name="slot">
                            <ul class="space-y-4">
                                <li>
                                    <x-inputs.input
                                        type="text"
                                        id="name"
                                        name="filter[name]"
                                        class="block w-full mt-0 placeholder:text-xs"
                                        :placeholder="__('اسم الجهة')"
                                        :value="request()->input('filter.name')"
                                    />
                                </li>
                            </ul>
                        </x-slot>
                        <x-slot name="footer" class="space-y-3">
                            <x-buttons.primary-button class="justify-center w-full">
                                <x-heroicon-o-magnifying-glass class="w-4 h-4 text-white stroke-white" stroke-width="2" />
                                <span>{{ __('بـحـث') }}</span>
                            </x-buttons.primary-button>

                            <x-buttons.secondary-link :href="route('license_requests.index')" class="justify-center w-full">
                                <span>{{ __('مسح حقول الفلتر') }}</span>
                            </x-buttons.secondary-link>
                        </x-slot>
                    </x-panel>
                </form>
            </aside>
        </div>
    </x-slot>
</x-admin-layout>
