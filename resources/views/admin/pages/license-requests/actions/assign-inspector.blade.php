<div>
    {{-- زر فتح المودال --}}
    <x-buttons.secondary-link class="justify-center w-full"
        x-data
        x-on:click="$dispatch('open-modal', 'update-state')">
        <span>{{ __('تحويل طلب لمفتش') }}</span>
    </x-buttons.secondary-link>

    {{-- المودال --}}
    <x-modal name="update-state">
        <form
            method="POST"
            action="{{ route('assign_inspector.state_update', $licenseRequest) }}"
            class="p-6 space-y-6" >
            @csrf
            @method('PATCH')

            {{-- عنوان --}}
            <div class="pb-2">
                <h2 class="text-sm font-semibold text-gray-700">{{ __('تحويل طلب لمفتش') }}</h2>
            </div>      

            {{-- بيانات المفتش وموعد الزيارة () --}}
            <div>
                <x-inputs.label for="inspector_id" name="inspector_id" :value="__('اختيار المفتش')" :has-error="$errors->has('inspector_id')" required />
                <select id="inspector_id" name="inspector_id" class="block w-full border-gray-300 rounded-md" >
                    <option value="">{{ __('اختر مفتش') }}</option>
                    @foreach ($inspectors as $inspector)
                        <option value="{{ $inspector->id }}" {{ old('inspector_id') == $inspector->id ? 'selected' : '' }}>
                            {{ $inspector->user_name }}
                        </option>
                    @endforeach
                </select>
                <x-inputs.error :messages="$errors->get('inspector_id')" />

                <x-inputs.label for="visit_date" :value="__('تاريخ الزيارة')" required class="mt-4" />
                <input
                    type="date"
                    id="visit_date"
                    name="visit_date"
                    class="block w-full border-gray-300 rounded-md"
                    value="{{ old('visit_date') }}"
                    x-bind:required="state === 'accepted'"
                />
                <x-inputs.error :messages="$errors->get('visit_date')" />

                <x-inputs.label for="visit_time" :value="__('وقت الزيارة')" required class="mt-4" />
                <input
                    type="time"
                    id="visit_time"
                    name="visit_time"
                    class="block w-full border-gray-300 rounded-md"
                    value="{{ old('visit_time') }}"
                    x-bind:required="state === 'accepted'"
                />
                <x-inputs.error :messages="$errors->get('visit_time')" />
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
