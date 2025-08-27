<x-admin-layout>
    <x-slot name="slot">
        <div class="grid grid-cols-12 gap-4">

            <section class="order-last col-span-full md:col-span-9 md:order-first">
                <x-panel>
                    <x-slot name="heading">
                        <div class="flex items-center justify-between gap-x-3">
                            <div class="flex items-center gap-x-3">
                                <h2 class="text-sm font-semibold">{{ __('تفاصيل موعد الزيارة') }}</h2>
                            </div>

                            <div @class([$visitSchedule->licenseRequest->state->getUiClasses() ?? ''])>
                                <span>{{ $visitSchedule->licenseRequest->state->getName()  }}</span>
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="slot">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label :value="__('اسم المفتش')" />
                                <x-view-value :value="$visitSchedule->user->user_name ?? '-'" />
                            </div>

                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label :value="__('تاريخ الزيارة')" />
                                <x-view-value :value="$visitSchedule->visit_date" />
                            </div>

                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label :value="__('وقت الزيارة')" />
                                <x-view-value :value="$visitSchedule->visit_time" />
                            </div>
                        </div>

                        @if ($visitSchedule->licenseRequest->state == 'issuing_license')
                        <div class="mt-8">
                            <x-inputs.label :value="__('التقرير المرفق')" />
                            @if ($visitSchedule->licenseRequest->hasMedia('report_license'))
                                <x-view-value>
                                    <a href="{{ $visitSchedule->licenseRequest->getFirstMediaUrl('report_license') }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ __('عرض التقرير') }}
                                    </a>
                                </x-view-value>
                            @else
                                <x-view-value :value="'-'" />
                            @endif
                        </div>
                        @elseif ($visitSchedule->licenseRequest->state == 'rejected')
                            <div class="mt-8">
                                <x-inputs.label :value="__('سبب الرفض')" />
                                <x-view-value :value="$visitSchedule->licenseRequest->reason ?? '-'" />
                            </div>
                        @endif
                    

                    </x-slot>
                </x-panel>
            </section>

            <aside class="space-y-4 col-span-full md:col-span-3">
                <x-buttons.secondary-link :href="'#'" class="justify-center w-full">
                    <x-heroicon-o-list-bullet class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('قائمة مواعيد الزيارة') }}</span>
                </x-buttons.secondary-link>

                {{-- <x-buttons.secondary-link :href="'#'" class="justify-center w-full">
                    <x-heroicon-o-pencil-square class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('تعديل الموعد') }}</span>
                </x-buttons.secondary-link> --}}

                @include('admin.pages.visit-schedules.actions.state-update')

                <x-buttons.confirm-delete :route="'#'" class="justify-center w-full btn-confirm-delete">
                    <x-heroicon-o-trash class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('حذف الموعد') }}</span>
                </x-buttons.confirm-delete>
            </aside>

        </div>
    </x-slot>
</x-admin-layout>
