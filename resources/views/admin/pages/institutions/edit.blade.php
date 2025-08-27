<x-admin-layout>
    <x-slot name="slot">
        <form action="{{ route('admin.institutions.update', $institution) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div x-data="{ type: '{{ old('type', $institution->type) }}' }">
                <x-panel>
                    <x-slot name="heading">
                        <h2 class="text-base font-medium">{{ __('تعديل بيانات الجهة') }}</h2>
                    </x-slot>

                    <x-slot name="slot">
                        <div class="grid grid-cols-2 gap-6">
                            {{-- اسم الجهة --}}
                            <div class="col-span-full sm:col-span-1">
                                <x-inputs.label for="name" :value="__('اسم الجهة')" :has-error="$errors->has('name')" required />
                                <x-inputs.input type="text" id="name" name="name" class="block w-full" :value="old('name', $institution->name)" :has-error="$errors->has('name')" required />
                                <x-inputs.error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            {{-- نوع الجهة --}}
                            <div class="col-span-full sm:col-span-1">
                                <x-inputs.label for="type" :value="__('نوع الجهة')" :has-error="$errors->has('type')" required />
                                <x-inputs.select x-model="type" id="type" name="type" class="block w-full" :has-error="$errors->has('type')" required>
                                    <option value="">-- اختر --</option>
                                    <option value="public" {{ old('type', $institution->type) === 'public' ? 'selected' : '' }}>عامة</option>
                                    <option value="private" {{ old('type', $institution->type) === 'private' ? 'selected' : '' }}>خاصة</option>
                                </x-inputs.select>
                                <x-inputs.error :messages="$errors->get('type')" class="mt-2" />
                            </div>
                        </div>

                        {{-- ملاحظة: لا نعرض ملفات PDF القديمة هنا، فقط نسمح باستبدالها --}}

                        {{-- الحقول المشتركة --}}
                        <div class="grid grid-cols-2 gap-6 mt-6">
                            @foreach (['site_map' => 'رسم كروكي معتمد للموقع', 'site_safety_plan' => 'خطة وقائية للموقع'] as $field => $label)
                                <div class="col-span-full sm:col-span-1">
                                    <x-inputs.label for="{{ $field }}" :value="__($label . ' (PDF)')" />
                                    <x-inputs.input type="file" name="{{ $field }}" id="{{ $field }}" accept="application/pdf" class="block w-full" />
                                    <small class="inline-flex items-center mt-2 text-xs text-orange-400 gap-x-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path>
                                        </svg>

                                        <span>{{ __('أدخل الملف في حالة تريد تحديثه فقط.') }}</span>
                                    </small>
                                    <x-inputs.error :messages="$errors->get($field)" class="mt-2" />
                                </div>
                            @endforeach
                        </div>

                        {{-- الحقول الخاصة بالجهات العامة --}}
                        <div class="grid grid-cols-2 gap-6 mt-6" x-show="type === 'public'" x-cloak>
                            @foreach (['safety_request' => 'طلب موجه لهيئة السلامة', 'committee_decision' => 'قرار اللجنة الشرعية لمجلس الوزراء'] as $field => $label)
                                <div class="col-span-full sm:col-span-1">
                                    <x-inputs.label for="{{ $field }}" :value="__($label . ' (PDF)')" />
                                    <x-inputs.input type="file" name="{{ $field }}" id="{{ $field }}" accept="application/pdf" class="block w-full" />
                                    <small class="inline-flex items-center mt-2 text-xs text-orange-400 gap-x-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path>
                                        </svg>

                                        <span>{{ __('أدخل الملف في حالة تريد تحديثه فقط.') }}</span>
                                    </small>
                                    <x-inputs.error :messages="$errors->get($field)" class="mt-2" />
                                </div>
                            @endforeach
                        </div>

                        {{-- الحقول الخاصة بالجهات الخاصة --}}
                        <div class="grid grid-cols-2 gap-6 mt-6" x-show="type === 'private'" x-cloak>
                            @foreach ([
                                'specialization_request' => 'طلب اختصاص من الجهة',
                                'legal_file' => 'الملف القانوني للشركة',
                                'company_license' => 'ترخيص الشركة',
                                'commercial_register' => 'السجل التجاري',
                                'chamber_of_commerce' => 'الغرفة التجارية',
                                'company_bylaws' => 'النظام الأساسي للشركة',
                                'payment_receipt' => 'إيصال دفع الرسوم',
                            ] as $field => $label)
                                <div class="col-span-full sm:col-span-1">
                                    <x-inputs.label for="{{ $field }}" :value="__($label . ' (PDF)')" />
                                    <x-inputs.input type="file" name="{{ $field }}" id="{{ $field }}" accept="application/pdf" class="block w-full" />
                                    <small class="inline-flex items-center mt-2 text-xs text-orange-400 gap-x-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path>
                                        </svg>

                                        <span>{{ __('أدخل الملف في حالة تريد تحديثه فقط.') }}</span>
                                    </small>
                                    <x-inputs.error :messages="$errors->get($field)" class="mt-2" />
                                </div>
                            @endforeach
                        </div>
                    </x-slot>
                </x-panel>

                <div class="flex items-center justify-end mt-4 gap-x-4">
                    <x-buttons.secondary-link :href="route('admin.institutions.index')">
                        {{ __('إلغاء') }}
                    </x-buttons.secondary-link>

                    <x-buttons.primary-button>
                        <x-heroicon-o-check-circle class="w-4 h-4" stroke-width="2" />
                        {{ __('تحديث') }}
                    </x-buttons.primary-button>
                </div>
            </div>
        </form>
    </x-slot>
</x-admin-layout>
