<div>
    {{-- زر فتح المودال --}}
    <x-buttons.secondary-link class="justify-center w-full"
        x-data
        x-on:click="$dispatch('open-modal', 'update-state')">
        <span>{{ __('تغيير الحالة') }}</span>
    </x-buttons.secondary-link>

    {{-- المودال --}}
    <x-modal name="update-state" class="">
        <form method="POST" action="{{ route('admin.users.state_update', $user) }}" class="p-6 space-y-6">
            @csrf
            @method('PATCH')

            {{-- عنوان --}}
            <div class="pb-2">
                <h2 class="text-sm font-semibold text-gray-700">{{ __('تحديث الحالة') }}</h2>
            </div>

            {{-- الحالة الحالية --}}
            <div class="flex items-center pb-4 border-b gap-x-4">
                <span class="text-sm font-medium text-gray-600">{{ __('الحالة الحالية') }}:</span>
                @if ($user->email_verified_at)
                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                        {{ __('مفعل') }}
                    </span>
                @else
                    <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                        {{ __('غير مفعل') }}
                    </span>
                @endif
            </div>

            {{-- اختيار الحالة الجديدة --}}
            <div>
                <x-inputs.label for="state" :value="__('تغيير إلى ؟')" required />
                <x-inputs.select id="state" name="state" class="block w-full">
                    <option value="active" {{ $user->email_verified_at ? 'selected' : '' }}>
                        {{ __('مفعل') }}
                    </option>
                    <option value="inactive" {{ !$user->email_verified_at ? 'selected' : '' }}>
                        {{ __('غير مفعل') }}
                    </option>
                </x-inputs.select>
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
