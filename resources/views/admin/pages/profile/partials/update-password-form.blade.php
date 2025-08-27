<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('تحديث كلمة المرور') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('تأكد من أن حسابك يستخدم كلمة مرور طويلة وعشوائية ليظل آمنًا.') }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-inputs.label for="update_password_current_password" :value="__('كلمة المرور الحالية')" :has-error="$errors->updatePassword->has('current_password')" required />
            <x-inputs.input id="update_password_current_password" name="current_password" type="password" class="block w-full" autocomplete="current-password" :has-error="$errors->updatePassword->has('current_password')"  />
            <x-inputs.errors :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-inputs.label for="update_password_password" :value="__('كلمة المرور الجديدة')" :has-error="$errors->updatePassword->has('password')" required />
            <x-inputs.input id="update_password_password" name="password" type="password" class="block w-full" autocomplete="new-password" :has-error="$errors->updatePassword->has('password')"  />
            <x-inputs.errors :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-inputs.label for="update_password_password_confirmation" :value="__('تأكيد كلمة المرور')" :has-error="$errors->updatePassword->has('password_confirmation')" required />
            <x-inputs.input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full" autocomplete="new-password" :has-error="$errors->updatePassword->has('password_confirmation')"  />
            <x-inputs.errors :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-buttons.primary-button>{{ __('حفظ') }}</x-buttons.primary-button>

            @if (session('status') === 'password-updated')
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
</section>
