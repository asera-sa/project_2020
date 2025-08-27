
  <div>
    {{-- زر فتح المودال --}}
    <x-buttons.secondary-link class="justify-center w-full"
        x-data
        x-on:click="$dispatch('open-modal', 'update-state')">
        <span>{{ __('تغيير الحالة') }}</span>
    </x-buttons.secondary-link>

    {{-- المودال --}}
    <x-modal name="update-state">
        <form
            method="POST"
            action="{{ route('license_requests.state_update', $licenseRequest) }}"
            enctype="multipart/form-data"
            class="p-6 space-y-6"
            x-data="{ state: '', reason: '' }"
            x-on:open-modal.window="if ($event.detail === 'update-state') {
                state = ''; reason = '';
            }"
        >
            @csrf
            @method('PATCH')

            {{-- عنوان --}}
            <div class="pb-2">
                <h2 class="text-sm font-semibold text-gray-700">{{ __('تحديث الحالة') }}</h2>
            </div>

            {{-- الحالة الحالية --}}
            <div class="flex items-center pb-4 border-b gap-x-4">
                <span class="text-sm font-medium text-gray-600">{{ __('الحالة الحالية') }}:</span>
                <div @class([$licenseRequest->state->getUiClasses()])>
                    <span>{{ $licenseRequest->state->getName() }}</span>
                </div>
            </div>

            {{-- اختيار الحالة الجديدة --}}
            <div>
                <x-inputs.label for="state" :value="__('تغيير إلى ؟')" :has-error="$errors->has('state')" required />
                <x-inputs.select x-model="state" id="state" name="state" placeholder="اختر" class="block w-full" :has-error="$errors->has('state')">
                    @foreach ($licenseRequest->state->transitionableStates() as $availableState)
                        <option value="{{ $availableState }}">{{ __('app.states.request_state.actions.'.$availableState) }}</option>
                    @endforeach
                </x-inputs.select>
                <x-inputs.error :messages="$errors->get('state')" />
            </div>

            {{-- حقل سبب الرفض عند اختيار "مرفوض" --}}
            <div x-show="state === 'rejected'" x-cloak>
                <x-inputs.label for="reason" :value="__('سبب الرفض')" :has-error="$errors->has('reason')" required />
                <textarea
                    id="reason"
                    name="reason"
                    rows="3"
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm"
                    x-bind:required="state === 'rejected'"
                >{{ old('reason') }}</textarea>
                <x-inputs.error :messages="$errors->get('reason')" />
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
            