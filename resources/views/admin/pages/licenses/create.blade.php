<x-admin-layout>
    <x-slot name="slot">
        <form action="{{ route('licenses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <x-panel>
                <x-slot name="heading">
                    <h2 class="text-base font-medium">{{ __('إضافة ترخيص جديد') }}</h2>
                </x-slot>

                <x-slot name="slot">
                    <div class="grid grid-cols-2 gap-6">
                        {{-- اسم الترخيص --}}
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="institution_id" :value="__('اسم المصلحة')" :has-error="$errors->has('institution_id')" required />
                            <x-inputs.input type="text" id="institution_id" name="institution_id" class="block w-full" readonly :value="$licenseRequest->institution->name" :has-error="$errors->has('institution_id')" required />
                            <x-inputs.error :messages="$errors->get('institution_id')" class="mt-2" />
                        </div>

                        {{-- المصلحة --}}
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="license_request_id" :value="__('رقم الترخيص')" />
                            <x-inputs.input type="text" id="license_request_id" name="license_request_id" class="block w-full" readonly :value="$licenseRequest->id" :has-error="$errors->has('license_request_id')" required />
                            <x-inputs.error :messages="$errors->get('license_request_id')" class="mt-2" />
                        </div>

                        {{-- تاريخ الإصدار --}}
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="issued_at" :value="__('تاريخ الإصدار')" />
                            <x-inputs.input type="date" id="issued_at" name="issued_at" class="block w-full" :value="old('issued_at')"/>
                            <small class="inline-flex items-center mt-2 text-xs text-orange-400 gap-x-1">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path>
                                </svg>

                                <span>{{ __('تنتهي صلاحية الرخصة بعد 6 أشهر من تاريخ المدخل') }}</span>
                            </small>
                            <x-inputs.error :messages="$errors->get('issued_at')" class="mt-2" />
                        </div>

                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="license" :value="__(' ملف الرخصة (PDF)')" />
                            <x-inputs.input type="file" name="license" id="license" accept="application/pdf" class="block w-full" />
                            <x-inputs.error :messages="$errors->get('license')" class="mt-2" />
                        </div>

                        {{-- ملاحظات --}}
                        <div class="col-span-full">
                            <x-inputs.label for="notes" :value="__('ملاحظات')" />
                            <textarea id="notes" name="notes" rows="4" class="block w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('notes') }}</textarea>
                            <x-inputs.error :messages="$errors->get('notes')" class="mt-2" />
                        </div>


                    </div>
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
