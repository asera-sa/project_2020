<x-admin-layout>
    <x-slot name="slot">
        <div class="grid grid-cols-12 gap-4">
            <section class="order-last col-span-full md:col-span-9 md:order-first">
                <x-panel>
                    <x-slot name="heading">
                        <div class="flex items-center justify-between gap-x-3">
                            <div class="flex items-center gap-x-3">
                                <h2 class="text-sm font-semibold">{{ __('عرض بيانات طلب الترخيص') }}</h2>
                            </div>

                            <div @class([$licenseRequest->state->getUiClasses() ?? ''])>
                                <span>{{ $licenseRequest->state->getName() ?? $licenseRequest->state }}</span>
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="slot">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="uuid" :value="__('معرف الطلب')" />
                                <x-view-value id="uuid" class="block w-full font-mono" :value="$licenseRequest->uuid" />
                            </div>

                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="created_at" :value="__('تاريخ الإنشاء')" />
                                <x-view-value id="created_at" class="block w-full" :value="$licenseRequest->created_at->toDateString()" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mt-8">
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="institution_name" :value="__('الجهة التابعة')" />
                                <x-view-value id="institution_name" class="block w-full" :value="$licenseRequest->institution->name ?? 'غير محددة'" />
                            </div>

                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="institution_type" :value="__('نوع الجهة')" />
                                <x-view-value id="institution_type" class="block w-full" :value="$licenseRequest->institution->type ?? '-'" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 mt-8">
                            <div>
                                <x-inputs.label for="notes" :value="__('ملاحظات')" />
                                <x-view-value id="notes" class="block w-full" :value="$licenseRequest->notes ?? '-' " />
                            </div>
                        </div>

                        <div class="p-4 mt-8 border rounded bg-gray-50">
                            <h3 class="mb-2 font-semibold">{{ __('ملف الرخصة') }}</h3>
                                @if($licenseRequest->hasMedia('license'))
                                    <a href="{{ $licenseRequest->getFirstMediaUrl('license') }}" target="_blank">
                                        عرض الملف
                                    </a>        
                                @endif
                        </div>
                        
                        {{-- ملفات الجهة --}}
                        <div class="mt-8">
                            <h3 class="mb-2 font-semibold">{{ __('الملفات المرفوعة') }}</h3>

                            @php
                                $commonFiles = ['site_map', 'site_safety_plan'];
                                $publicFiles = ['safety_request', 'committee_decision'];
                                $privateFiles = [
                                    'specialization_request',
                                    'legal_file',
                                    'company_license',
                                    'commercial_register',
                                    'chamber_of_commerce',
                                    'company_bylaws',
                                    'payment_receipt'
                                ];

                                $fileLabels = [
                                    'site_map' => 'رسم كروكي معتمد للموقع',
                                    'site_safety_plan' => 'خطة وقائية للموقع',
                                    'safety_request' => 'طلب موجه لهيئة السلامة',
                                    'committee_decision' => 'قرار اللجنة الشرعية لمجلس الوزراء',
                                    'specialization_request' => 'طلب اختصاص من الجهة',
                                    'legal_file' => 'الملف القانوني للشركة',
                                    'company_license' => 'ترخيص الشركة',
                                    'commercial_register' => 'السجل التجاري',
                                    'chamber_of_commerce' => 'الغرفة التجارية',
                                    'company_bylaws' => 'النظام الأساسي للشركة',
                                    'payment_receipt' => 'إيصال دفع الرسوم',
                                ];
                            @endphp

                            <ul class="space-y-1 list-disc list-inside">
                                @foreach ($commonFiles as $file)
                                    <li>
                                        @if($licenseRequest->getFirstMediaUrl($file))
                                            <a href="{{ $licenseRequest->getFirstMediaUrl($file) }}" target="_blank" class="text-blue-600 hover:underline">
                                                {{ 'عرض ملف ' . $fileLabels[$file] }}
                                            </a>
                                        @else
                                            <span class="text-gray-500">{{ 'لا يوجد ملف ' . $fileLabels[$file] }}</span>
                                        @endif
                                    </li>
                                @endforeach

                                @if($licenseRequest->institution->type === 'public')
                                    @foreach ($publicFiles as $file)
                                        <li>
                                            @if($licenseRequest->getFirstMediaUrl($file))
                                                <a href="{{ $licenseRequest->getFirstMediaUrl($file) }}" target="_blank" class="text-blue-600 hover:underline">
                                                    {{ 'عرض ملف ' . $fileLabels[$file] }}
                                                </a>
                                            @else
                                                <span class="text-gray-500">{{ 'لا يوجد ملف ' . $fileLabels[$file] }}</span>
                                            @endif
                                        </li>
                                    @endforeach
                                @elseif($licenseRequest->institution->type === 'private')
                                    @foreach ($privateFiles as $file)
                                        <li>
                                            @if($licenseRequest->getFirstMediaUrl($file))
                                                <a href="{{ $licenseRequest->getFirstMediaUrl($file) }}" target="_blank" class="text-blue-600 hover:underline">
                                                    {{ 'عرض ملف ' . $fileLabels[$file] }}
                                                </a>
                                            @else
                                                <span class="text-gray-500">{{ 'لا يوجد ملف ' . $fileLabels[$file] }}</span>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                    
                        <div class="grid grid-cols-3 gap-6 mt-8">
                            <div class="col-span-full">
                                <h3 class="mb-2 text-sm font-semibold text-green-700">{{ __('بيانات الزيارة المجدولة') }}</h3>
                            </div>
                        
                            @if($licenseRequest->visitSchedule)
                                <div class="col-span-full md:col-span-1">
                                    <x-inputs.label :value="__('اسم المفتش')" />
                                    <x-view-value :value="$licenseRequest->visitSchedule->user->user_name ?? '-'" />
                                </div>
                        
                                <div class="col-span-full md:col-span-1">
                                    <x-inputs.label :value="__('تاريخ الزيارة')" />
                                    <x-view-value :value="$licenseRequest->visitSchedule->visit_date" />
                                </div>
                        
                                <div class="col-span-full md:col-span-1">
                                    <x-inputs.label :value="__('وقت الزيارة')" />
                                    <x-view-value :value="$licenseRequest->visitSchedule->visit_time" />
                                </div>
                            @else
                                <div class="col-span-full text-gray-500 italic">
                                    {{ __('لم يتم تعيين مفتش أو جدولة زيارة بعد.') }}
                                </div>
                            @endif
                        </div>

                        @if ($licenseRequest->state == 'issuing_license')
                        <div class="mt-8">
                            <x-inputs.label :value="__('التقرير المرفق')" />
                            @if ($licenseRequest->hasMedia('report_license'))
                                <x-view-value>
                                    <a href="{{ $licenseRequest->getFirstMediaUrl('report_license') }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ __('عرض التقرير') }}
                                    </a>
                                </x-view-value>
                            @else
                                <x-view-value :value="'-'" />
                            @endif
                        </div>
                        @elseif ($licenseRequest->state == 'rejected')
                            <div class="mt-8">
                                <x-inputs.label :value="__('سبب الرفض')" />
                                <x-view-value :value="$licenseRequest->reason ?? '-'" />
                            </div>
                        @endif
                    </x-slot>
                </x-panel>
            </section>

            <aside class="space-y-4 col-span-full md:col-span-3">
                <x-buttons.secondary-link :href="route('license_requests.index')" class="justify-center w-full">
                    <x-heroicon-o-list-bullet class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('قائمة طلبات الترخيص') }}</span>
                </x-buttons.secondary-link>

                {{-- <x-buttons.secondary-link :href="route('license_requests.edit', $licenseRequest)" class="justify-center w-full">
                    <x-heroicon-o-pencil-square class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('تعديل الطلب') }}</span>
                </x-buttons.secondary-link> --}}

                @if(auth()->user()->isSettlementUnitEmployee()  && $licenseRequest->state == "pending_review")
                    @include('admin.pages.license-requests.actions.state-update')
                @endif

                @if(auth()->user()->isInspectionOfficeManager()  && $licenseRequest->state == "under_inspection_office_review")
                    @include('admin.pages.license-requests.actions.assign-inspector')
                @endif

                @if(auth()->user()->isInspectionOfficeManager()  && $licenseRequest->state == "issuing_license")
                    <x-buttons.secondary-link :href="route('licenses.create',$licenseRequest)" class="justify-center w-full">
                        <x-heroicon-o-list-bullet class="w-4 h-4" stroke-width="2" />
                        <span>{{ __('إضافة رخصة') }}</span>
                    </x-buttons.secondary-link>
                @endif

                @if((auth()->user()->isInstitutionOwner() && $licenseRequest->state == "pending_review") || auth()->user()->isAdministrator())
                    <x-buttons.confirm-delete :route="route('license_requests.destroy', $licenseRequest)" class="justify-center w-full btn-confirm-delete">
                        <x-heroicon-o-trash class="w-4 h-4" stroke-width="2" />
                        <span>{{ __('حذف الطلب') }}</span>
                    </x-buttons.confirm-delete>
                @endif
            </aside>
        </div>
    </x-slot>
</x-admin-layout>
