<x-admin-layout>
    <x-slot name="slot">
        <div class="grid grid-cols-12 gap-4">
            <section class="order-last col-span-full md:col-span-9 md:order-first">
                <x-panel>
                    <x-slot name="heading">
                        <div class="flex items-center justify-between gap-x-3">
                            <div class="flex items-center gap-x-3">
                                <h2 class="text-sm font-semibold">{{ __('عرض بيانات الرخصة') }}</h2>
                            </div>

                            @if ($license->is_active)
                                <div class="pill pill-green">
                                    {{ __('صالحة') }}
                                </div>
                            @else
                                <div class="pill pill-pink">
                                    <span>{{ __('منتهية') }}</span>
                                </div>
                            @endif
                        </div>
                    </x-slot>
                    <x-slot name="slot">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="name" :value="__('اسم المصلحة')" />
                                <x-view-value id="name" class="block w-full" :value="$license->licenseRequest->institution->name"/>
                            </div>
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="institution" :value="__('نوع المصلحة')" />
                                <x-view-value id="institution" class="block w-full" :value="$license->licenseRequest->institution->type ?? 'غير محددة'" />                                    </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mt-8">
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="issued_at" :value="__('تاريخ الإصدار')" />
                                <x-view-value id="issued_at" class="block w-full" :value="$license->issued_at->toDateString()"/>
                            </div>

                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="expires_at" :value="__('تاريخ الانتهاء')" />
                                <x-view-value id="expires_at" class="block w-full" :value="$license->expires_at->toDateString()"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 mt-8">
                            <div>
                                <x-inputs.label for="notes" :value="__('ملاحظات')" />
                                <x-view-value id="notes" class="block w-full" :value="$license->notes ?? '-' "/>
                            </div>
                        </div>
                        <div class="p-4 mt-8 border rounded bg-gray-50">
                            <h3 class="mb-2 font-semibold">{{ __('ملف الرخصة') }}</h3>
                            @if($license->licenseRequest->hasMedia('license'))
                                <a href="{{ $license->licenseRequest->getFirstMediaUrl('license') }}" target="_blank">
                                    عرض الملف
                                </a>
                            @endif
                        </div>

                    </x-slot>
                </x-panel>
            </section>

            <aside class="space-y-4 col-span-full md:col-span-3">
                <x-buttons.secondary-link :href="route('licenses.index')" class="justify-center w-full">
                    <x-heroicon-o-list-bullet class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('قائمة الرخص') }}</span>
                </x-buttons.secondary-link>
{{--
                <x-buttons.secondary-link :href="route('licenses.edit', $license)" class="justify-center w-full">
                    <x-heroicon-o-pencil-square class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('تعديل الرخصة') }}</span>
                </x-buttons.secondary-link> --}}


                <x-buttons.confirm-delete :route="route('licenses.destroy', $license)" class="justify-center w-full btn-confirm-delete">
                    <x-heroicon-o-trash class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('حذف الرخصة') }}</span>
                </x-buttons.confirm-delete>
            </aside>
        </div>
    </x-slot>
</x-admin-layout>
