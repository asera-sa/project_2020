<x-admin-layout>
    <x-slot name="slot">
        <div class="grid grid-cols-12 gap-4">
            <section class="order-last col-span-full md:col-span-9 md:order-first">
                <x-panel>
                    <x-slot name="heading">
                        <div class="flex items-center justify-between gap-x-3">
                            <div class="flex items-center gap-x-3">
                                <h2 class="text-sm font-semibold">{{ __('عرض بيانات الجهة') }}</h2>
                            </div>

                            <div @class([$institution->state->getUiClasses()])>
                                <span>{{ $institution->state->getName() }}</span>
                            </div>
                        </div>
                    </x-slot>
                    <x-slot name="slot">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="name" :value="__('اسم الجهة')" />
                                <x-view-value id="name" class="block w-full" :value="$institution->name"/>
                            </div>
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="type" :value="__('نوع الجهة')" />
                                <x-view-value id="type" class="block w-full" :value="($institution->type === 'public') ? 'عامة' : 'خاصة'"/>
                            </div>
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
                                        @if($institution->getFirstMediaUrl($file))
                                            <a href="{{ $institution->getFirstMediaUrl($file) }}" target="_blank" class="text-blue-600 hover:underline">
                                                {{ 'عرض ملف ' . $fileLabels[$file] }}
                                            </a>
                                        @else
                                            <span class="text-gray-500">{{ 'لا يوجد ملف ' . $fileLabels[$file] }}</span>
                                        @endif
                                    </li>
                                @endforeach

                                @if($institution->type === 'public')
                                    @foreach ($publicFiles as $file)
                                        <li>
                                            @if($institution->getFirstMediaUrl($file))
                                                <a href="{{ $institution->getFirstMediaUrl($file) }}" target="_blank" class="text-blue-600 hover:underline">
                                                    {{ 'عرض ملف ' . $fileLabels[$file] }}
                                                </a>
                                            @else
                                                <span class="text-gray-500">{{ 'لا يوجد ملف ' . $fileLabels[$file] }}</span>
                                            @endif
                                        </li>
                                    @endforeach
                                @elseif($institution->type === 'private')
                                    @foreach ($privateFiles as $file)
                                        <li>
                                            @if($institution->getFirstMediaUrl($file))
                                                <a href="{{ $institution->getFirstMediaUrl($file) }}" target="_blank" class="text-blue-600 hover:underline">
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

                    </x-slot>
                </x-panel>
            </section>

            <aside class="space-y-4 col-span-full md:col-span-3">
                <x-buttons.secondary-link :href="route('institution_requests.index')" class="justify-center w-full">
                    <x-heroicon-o-list-bullet class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('قائمة الجهات') }}</span>
                </x-buttons.secondary-link>

                @include('admin.pages.institutions.actions.state-update')

            </aside>
        </div>
    </x-slot>
</x-admin-layout>
