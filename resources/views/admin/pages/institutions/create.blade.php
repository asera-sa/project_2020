<x-admin-layout>
    <x-slot name="slot">
        <form action="{{ route('admin.institutions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div x-data="{ type: '{{ old('type') }}' }">
                <x-panel>
                    <x-slot name="heading">
                        <h2 class="text-base font-medium">{{ __('إضافة جهة / مصلحة جديدة') }}</h2>
                    </x-slot>

                    <x-slot name="slot">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-full sm:col-span-1">
                                <x-inputs.label for="user_name" :value="__('اسم المستخدم')" :has-error="$errors->has('user_name')" required />
                                <x-inputs.input type="text" id="user_name" name="user_name" class="block w-full" :value="old('user_name')" :has-error="$errors->has('user_name')" required autocomplete="off" />
                                <x-inputs.error :messages="$errors->get('user_name')" class="mt-2" />
                            </div>
                            <div class="col-span-full sm:col-span-1">
                                <x-inputs.label for="full_name" :value="__('الصورة الشخصية')" :has-error="$errors->has('image_profile')"  />
                                <x-inputs.input type="file" id="image_profile" name="image_profile" class="block w-full" :value="old('image_profile')" :has-error="$errors->has('image_profile')"  />
                                <x-inputs.error :messages="$errors->get('image_profile')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mt-6">
                            <div class="col-span-full sm:col-span-1">
                                <x-inputs.label for="email" :value="__('البريد الإلكتروني')" :has-error="$errors->has('email')" required />
                                <x-inputs.input type="email" id="email" name="email" class="block w-full" :value="old('email')" :has-error="$errors->has('email')" required autocomplete="off" required lang="en" />
                                <x-inputs.error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="col-span-full sm:col-span-1">
                                <x-inputs.label for="phone" :value="__('رقم الهاتف')" :has-error="$errors->has('phone')" required />
                                <x-inputs.input type="text" id="phone" name="phone" class="block w-full" :value="old('phone')" :has-error="$errors->has('phone')" required autocomplete="off" />
                                <x-inputs.error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mt-6">
                            <div class="col-span-full sm:col-span-1">
                                <x-inputs.label for="password" :value="__('كلمة المرور')" :has-error="$errors->has('password')" required />
                                <x-inputs.input type="password" id="password" name="password" class="block w-full" autocomplete="new-password" :has-error="$errors->has('password')" required />
                                <x-inputs.error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="col-span-full sm:col-span-1">
                                <x-inputs.label for="password_confirmation" :value="__('تأكيد كلمة المرور')" :has-error="$errors->has('password_confirmation')" required />
                                <x-inputs.input type="password" id="password_confirmation" name="password_confirmation" class="block w-full" autocomplete="new-password" :has-error="$errors->has('password_confirmation')" required />
                                <x-inputs.error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mt-6">
                            {{-- اسم الجهة --}}
                            <div class="col-span-full sm:col-span-1">
                                <x-inputs.label for="name" :value="__('اسم الجهة')" :has-error="$errors->has('name')" required />
                                <x-inputs.input type="text" id="name" name="name" class="block w-full" :value="old('name')" :has-error="$errors->has('name')" required />
                                <x-inputs.error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            {{-- نوع الجهة --}}
                            <div class="col-span-full sm:col-span-1">
                                <x-inputs.label for="type" :value="__('نوع الجهة')" :has-error="$errors->has('type')" required />
                                <x-inputs.select id="type" name="type" class="block w-full" :has-error="$errors->has('type')" required>
                                    <option value="">-- اختر --</option>
                                    <option value="public">عامة</option>
                                    <option value="private">خاصة</option>
                                </x-inputs.select>
                                <x-inputs.error :messages="$errors->get('type')" class="mt-2" />
                            </div>
                        </div>
                    </x-slot>
                </x-panel>

                <div class="flex items-center justify-end mt-4 gap-x-4">
                    <x-buttons.secondary-link :href="'#'">
                        {{ __('إلغاء') }}
                    </x-buttons.secondary-link>

                    <x-buttons.primary-button>
                        <x-heroicon-o-check-circle class="w-4 h-4" stroke-width="2" />
                        {{ __('حفظ') }}
                    </x-buttons.primary-button>
                </div>
            </div>
        </form>
    </x-slot>
</x-admin-layout>
