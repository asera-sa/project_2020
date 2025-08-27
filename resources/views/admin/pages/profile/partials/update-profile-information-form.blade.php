<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('معلومات الملف الشخصي') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("قم بتحديث معلومات الملف الشخصي لحسابك وعنوان البريد الإلكتروني.") }}
        </p>
    </header>

    <div class="flex flex-col md:flex-row gap-8 mt-6">
        {{-- ✅ الصورة على اليسار --}}
        <div class="md:w-1/4 flex justify-center">
            @if ($user->getImage())
                <img src="{{ $user->getImage() }}" alt="الصورة الشخصية" class="w-32 h-32 rounded-full object-cover border" />
            @else
                <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm border">
                    لا توجد صورة
                </div>
            @endif
        </div>

        {{-- ✅ النموذج على اليمين --}}
        <form method="post" action="{{ route('admin.profile.update') }}" class="space-y-6 md:w-3/4">
            @csrf
            @method('patch')

            <div>
                <x-inputs.label for="user_name" :value="__('الاسم')" :has-error="$errors->has('user_name')" required />
                <x-inputs.input id="user_name" name="user_name" type="text" class="block w-full" :value="old('user_name', $user->user_name)" :has-error="$errors->has('user_name')" required autofocus autocomplete="user_name" />
                <x-inputs.errors class="mt-2" :messages="$errors->get('user_name')" />
            </div>

            <div>
                <x-inputs.label for="full_name" :value="__('اسم كامل')" :has-error="$errors->has('full_name')" required />
                <x-inputs.input id="full_name" name="full_name" type="text" class="block w-full" :value="old('full_name', $user->full_name)" :has-error="$errors->has('full_name')" required autofocus autocomplete="full_name" />
                <x-inputs.errors class="mt-2" :messages="$errors->get('full_name')" />
            </div>

            <div>
                <x-inputs.label for="email" :value="__('البريد الإلكتروني')" :has-error="$errors->has('email')" required />
                <x-inputs.input id="email" name="email" type="email" class="block w-full" :value="old('email', $user->email)" :has-error="$errors->has('email')" required autocomplete="email" />
                <x-inputs.errors class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <x-inputs.label for="phone" :value="__('رقم الهاتف')" :has-error="$errors->has('phone')" required />
                <x-inputs.input id="phone" name="phone" type="text" class="block w-full" :value="old('phone', $user->phone)" :has-error="$errors->has('phone')" required autofocus autocomplete="phone" />
                <x-inputs.errors class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <div class="flex items-center gap-4">
                <x-buttons.primary-button>{{ __('حفظ') }}</x-buttons.primary-button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-green-600"
                    >{{ __('ui.alerts.messages.saved') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>
