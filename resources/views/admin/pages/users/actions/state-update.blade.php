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
                <div @class([$user->state->getUiClasses()])>
                    <span>{{ $user->state->getName() }}</span>
                </div>
            </div>

            {{-- اختيار الحالة الجديدة --}}
            <div>
                <x-inputs.label for="state" :value="__('تغيير إلى ؟')" :has-error="$errors->has('state')" required />
                <x-inputs.select  placeholder="اختر" id="state" name="state" class="block w-full" :has-error="$errors->has('state')">
                    @foreach ($user->state->transitionableStates() as $availableState)
                        <option value="{{ $availableState }}">{{ __('app.states.user.actions.'.$availableState) }}</option>
                    @endforeach
                </x-inputs.select>
                <x-inputs.error :messages="$errors->get('state')" />
            </div>

            {{-- تفعيل الحساب للمؤسسات --}}
            @if($user->scope === 'institution_owner')
                <div class="pt-4 border-t">
                    <x-inputs.label for="status" :value="__('حالة الحساب')" :has-error="$errors->has('status')" />
                    <x-inputs.select placeholder="اختر" id="status" name="status" class="block w-full" :has-error="$errors->has('status')">
                        <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>غير مفعل</option>
                        <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>مفعل</option>
                    </x-inputs.select>
                    <x-inputs.error :messages="$errors->get('status')" />
                    <p class="mt-1 text-xs text-gray-500">
                        يمكن تفعيل الحساب بعد تأكيد البريد الإلكتروني من قبل المستخدم. الحساب غير المفعل لا يمكنه تسجيل الدخول للنظام.
                    </p>
                </div>
            @endif


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
