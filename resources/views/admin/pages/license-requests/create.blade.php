<x-admin-layout>
    <x-slot name="slot">
        <form action="{{ route('license_requests.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <x-panel>
                <x-slot name="heading">
                    <h2 class="text-base font-medium">{{ __('إضافةطلب ترخيص جديد') }}</h2>
                </x-slot>

                <x-slot name="slot">
                    <div class="grid grid-cols-2 gap-6">

                        {{-- المصلحة --}}


                <div class="col-span-full"  x-data="{ type: '', init() {
                                        const selected = document.querySelector('#institution_id option:checked');
                                        this.type = selected?.dataset.type || '';
                                    } }"
                                    x-init="init()">
                    <x-inputs.label for="institution_id" :value="__('المصلحة')" />
                    <select id="institution_id" name="institution_id"
                        class="block w-full" x-on:change="type = $event.target.selectedOptions[0].dataset.type">
                        <option value="">اختر مصلحة</option>
                        @foreach ($institutions as $institution)
                            <option value="{{ $institution->id }}"
                                    data-type="{{ $institution->type }}"
                                    @selected(old('institution_id', $selected->id ?? '') == $institution->id)>
                                {{ $institution->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-inputs.error :messages="$errors->get('institution_id')" class="mt-2" />

                    {{-- الحقول المشتركة --}}
                    <div class="grid grid-cols-2 gap-6 mt-6">
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="site_map" :value="__('رسم كروكي معتمد للموقع (PDF)')" />
                            <x-inputs.input type="file" name="site_map" id="site_map" accept="application/pdf" class="block w-full" />
                            <x-inputs.error :messages="$errors->get('site_map')" class="mt-2" />
                        </div>

                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="site_safety_plan" :value="__('خطة وقائية للموقع (PDF)')" />
                            <x-inputs.input type="file" name="site_safety_plan" id="site_safety_plan" accept="application/pdf" class="block w-full" />
                            <x-inputs.error :messages="$errors->get('site_safety_plan')" class="mt-2" />
                        </div>
                    </div>

                    {{-- الحقول الخاصة بالجهات العامة --}}
                    <div class="grid grid-cols-2 gap-6 mt-6" x-show="type === 'public'" x-cloak>
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="safety_request" :value="__('طلب موجه لهيئة السلامة (PDF)')" />
                            <x-inputs.input type="file" name="safety_request" id="safety_request" accept="application/pdf" class="block w-full" />
                            <x-inputs.error :messages="$errors->get('safety_request')" class="mt-2" />
                        </div>

                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="committee_decision" :value="__('قرار اللجنة الشرعية لمجلس الوزراء (PDF)')" />
                            <x-inputs.input type="file" name="committee_decision" id="committee_decision" accept="application/pdf" class="block w-full" />
                            <x-inputs.error :messages="$errors->get('committee_decision')" class="mt-2" />
                        </div>
                    </div>

                    {{-- الحقول الخاصة بالجهات الخاصة --}}
                    <div class="grid grid-cols-2 gap-6 mt-6" x-show="type === 'private'" x-cloak>
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="specialization_request" :value="__('طلب اختصاص من الجهة (PDF)')" />
                            <x-inputs.input type="file" name="specialization_request" id="specialization_request" accept="application/pdf" class="block w-full" />
                            <x-inputs.error :messages="$errors->get('specialization_request')" class="mt-2" />
                        </div>

                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="legal_file" :value="__('الملف القانوني للشركة (PDF)')" />
                            <x-inputs.input type="file" name="legal_file" id="legal_file" accept="application/pdf" class="block w-full" />
                            <x-inputs.error :messages="$errors->get('legal_file')" class="mt-2" />
                        </div>

                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="company_license" :value="__('ترخيص الشركة (PDF)')" />
                            <x-inputs.input type="file" name="company_license" id="company_license" accept="application/pdf" class="block w-full" />
                            <x-inputs.error :messages="$errors->get('company_license')" class="mt-2" />
                        </div>

                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="commercial_register" :value="__('السجل التجاري (PDF)')" />
                            <x-inputs.input type="file" name="commercial_register" id="commercial_register" accept="application/pdf" class="block w-full" />
                            <x-inputs.error :messages="$errors->get('commercial_register')" class="mt-2" />
                        </div>

                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="chamber_of_commerce" :value="__('الغرفة التجارية (PDF)')" />
                            <x-inputs.input type="file" name="chamber_of_commerce" id="chamber_of_commerce" accept="application/pdf" class="block w-full" />
                            <x-inputs.error :messages="$errors->get('chamber_of_commerce')" class="mt-2" />
                        </div>

                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="company_bylaws" :value="__('النظام الأساسي للشركة (PDF)')" />
                            <x-inputs.input type="file" name="company_bylaws" id="company_bylaws" accept="application/pdf" class="block w-full" />
                            <x-inputs.error :messages="$errors->get('company_bylaws')" class="mt-2" />
                        </div>

                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="payment_receipt" :value="__('إيصال دفع الرسوم (PDF)')" />
                            <x-inputs.input type="file" name="payment_receipt" id="payment_receipt" accept="application/pdf" class="block w-full" />
                            <x-inputs.error :messages="$errors->get('payment_receipt')" class="mt-2" />
                        </div>
                    </div>
                </div>


                    {{-- </div> --}}
                </x-slot>
            </x-panel>

            {{-- أزرار الإجراء --}}
            <div class="flex items-center justify-end mt-4 gap-x-4">
                <x-buttons.secondary-link :href="route('licenses.index')">
                    {{ __('إلغاء') }}
                </x-buttons.secondary-link>

                <x-buttons.primary-button type="submit">
                    <x-heroicon-o-check-circle class="w-4 h-4" stroke-width="2" />
                    {{ __('حفظ') }}
                </x-buttons.primary-button>
            </div>
        </form>
    </x-slot>
</x-admin-layout>
