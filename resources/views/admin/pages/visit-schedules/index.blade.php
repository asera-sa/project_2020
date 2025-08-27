<x-admin-layout>
    <x-slot name="slot">
        <div class="grid grid-cols-12 gap-4">
            <section class="order-last col-span-full md:col-span-9 md:order-first">
                <x-panel>
                    <x-slot name="heading">
                        <h2 class="text-base font-medium">{{ __('مواعيد الزيارة') }}</h2>
                    </x-slot>
                    <x-slot name="slot">
                        <div class="overflow-auto">
                            <table>
                                <thead>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('اسم المفتش') }}</th>
                                    <th scope="col">{{ __('تاريخ الزيارة') }}</th>
                                    <th scope="col">{{ __('وقت الزيارة') }}</th>
                                    <th scope="col">{{ __('حالة الطلب') }}</th>
                                    <th scope="col"></th>
                                </thead>
                                <tbody>
                                    @forelse ($visitSchedules as $visitSchedule)
                                        <tr>
                                            <td class="font-mono">{{ $loop->iteration }}</td>
                                            <td>{{ $visitSchedule->user?->user_name ?? '-' }}</td>
                                            <td>{{ $visitSchedule->visit_date }}</td>
                                            <td>{{ $visitSchedule->visit_time }}</td>
                                            <td>
                                                <div @class([$visitSchedule->licenseRequest->state->getUiClasses()])>
                                                    <span>{{ $visitSchedule->licenseRequest->state->getName() }}</span>
                                                </div>
                                            </td>
                                            <td class="actions">
                                                <a href="{{route('visit_schedules.show',$visitSchedule)}}" class="view">
                                                    <span>{{ __('عرض التفاصيل') }}</span>
                                                    <x-heroicon-o-arrow-long-left class="w-4 h-4" stroke-width="2" />
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-3 py-4 text-center">
                                                @if (request()->has('filter'))
                                                    <span>{{ __('عذرًا, لم نجد ماتبحث عنه.') }}</span>
                                                @else
                                                    <span>{{ __('لا توجد مواعيد زيارة حالياً.') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if ($visitSchedules->hasPages())
                                <tfoot class="bg-transparent">
                                    <tr>
                                        <th colspan="5">{{ $visitSchedules->onEachSide(0)->withQueryString()->links() }}</th>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                    </x-slot>
                </x-panel>
            </section>

            <aside class="space-y-4 col-span-full md:col-span-3">
                <form action="{{ route('visit_schedules.index') }}" method="get">
                    <x-panel>
                        <x-slot name="heading">
                            <h3 class="inline-flex items-center text-sm font-medium gap-x-2">
                                <x-heroicon-o-funnel class="w-4 h-4" stroke-width="2" />
                                <span>
                                    <span>{{ __('فرز النتائج') }}</span>
                                    <span>({{ $visitSchedules->total() }})</span>
                                </span>
                            </h3>
                        </x-slot>
                        <x-slot name="slot">
                            <ul class="space-y-4">
                                <li>
                                    <x-inputs.input type="text" id="name" name="filter[name]" class="block w-full mt-0 placeholder:text-xs" :placeholder="__('اسم المفتش')" :value="request()->input('filter.name')" />
                                </li>
                            </ul>
                        </x-slot>
                        <x-slot name="footer" class="space-y-3">
                            <x-buttons.primary-button class="justify-center w-full">
                                <x-heroicon-o-magnifying-glass class="w-4 h-4 text-white stroke-white" stroke-width="2" />
                                <span>{{ __('بـحـث') }}</span>
                            </x-buttons.primary-button>

                            <x-buttons.secondary-link :href="route('visit_schedules.index')" class="justify-center w-full">
                                <span>{{ __('مسح حقول الفلتر') }}</span>
                            </x-buttons.secondary-link>
                        </x-slot>
                    </x-panel>
                </form>
            </aside>
        </div>
    </x-slot>
</x-admin-layout>
