<div>
    {{-- زر فتح المودال --}}
    <x-buttons.secondary-link class="justify-center w-full"
        x-data="{ state: '' }"
        x-on:click="$dispatch('open-modal', 'update-state'); state = '' ">
        <span>{{ __('تغيير الحالة') }}</span>
    </x-buttons.secondary-link>

    {{-- المودال --}}
    <x-modal name="update-state" class="">
        <form method="POST" action="{{route('licenses.state_update',$visitSchedule->licenseRequest)}}" class="p-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- عنوان --}}
            <div class="pb-2">
                <h2 class="text-sm font-semibold text-gray-700">{{ __('تحديث الحالة') }}</h2>
            </div>

            {{-- الحالة الحالية --}}
            <div class="flex items-center pb-4 border-b gap-x-4">
                <span class="text-sm font-medium text-gray-600">{{ __('الحالة الحالية') }}:</span>
                <div @class([$visitSchedule->licenseRequest->state->getUiClasses() ?? ''])>
                    <span>{{ $visitSchedule->licenseRequest->state->getName()  }}</span>
                </div>
            </div>

            {{-- اختيار الحالة الجديدة --}}
            <div x-data="{ state: '' }" x-init="
                $watch('state', value => {
                    $dispatch('input', value);
                })
            ">
                <x-inputs.label for="state" :value="__('تغيير إلى ؟')" :has-error="$errors->has('state')" required />
                <select id="state" name="state" x-model="state" class="block w-full border-gray-300 rounded-md shadow-sm" :class="{ 'border-red-500': $errors->has('state') }" required>
                    <option value="">{{ __('اختر') }}</option>
                    <option value="issuing_license">{{ __('قبول') }}</option>
                    <option value="rejected">{{ __('رفض') }}</option>
                </select>
                <x-inputs.error :messages="$errors->get('state')" />
            
                {{-- حقل رفع التقرير في حالة القبول --}}
                <div x-show="state === 'issuing_license'" x-cloak class="mt-4">
                    <x-inputs.label for="report_license" :value="__('إرفاق تقرير')" :has-error="$errors->has('report_license')" />
                    <input type="file" id="report_license" name="report_license" accept=".pdf,.doc,.docx,.jpg" class="  mt-1 block w-full" :class="{ 'border-red-500': $errors->has('report_license') }" />
                    <x-inputs.error :messages="$errors->get('report_license')" />
                </div>

                {{-- حقل سبب الرفض في حالة الرفض --}}
                <div x-show="state === 'rejected'" x-cloak class="mt-4">
                    <x-inputs.label for="reason" :value="__('سبب الرفض')" :has-error="$errors->has('reason')" required />
                    <textarea id="reason" name="reason" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm" x-bind:required="state === 'rejected'"></textarea>
                    <x-inputs.error :messages="$errors->get('reason')" />
                </div>
            </div>

            {{-- أزرار الإجراء --}}
            <div class="flex items-center justify-end gap-4 pt-4">
                <x-buttons.secondary-button type="button" x-on:click="$dispatch('close')">
                    <span>{{ __('إلغاء الأمر') }}</span>
                </x-buttons.secondary-button>

                <x-buttons.primary-button type="submit">
                    <x-heroicon-o-check-circle class="w-4 h-4" />
                    <span>{{ __('تـحـديـث') }}</span>
                </x-buttons.primary-button>
            </div>
        </form>
    </x-modal>
</div>
