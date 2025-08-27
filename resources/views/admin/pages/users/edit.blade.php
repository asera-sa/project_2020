<x-admin-layout>
    <x-slot name="slot">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-panel>
                <x-slot name="heading">
                    <h2 class="text-base font-medium">{{ __('تعديل بيانات المستخدم') }}</h2>
                </x-slot>
                <x-slot name="slot">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="user_name" :value="__('الاسم')" :has-error="$errors->has('user_name')" required />
                            <x-inputs.input type="text" id="user_name" name="user_name" class="block w-full" :value="old('user_name', $user->user_name)" :has-error="$errors->has('user_name')" required autocomplete="off" />
                            <x-inputs.error :messages="$errors->get('user_name')" class="mt-2" />
                        </div>
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="image_profile" :value="__('الصورة الشخصية')" :has-error="$errors->has('image_profile')"  />
                            <x-inputs.input type="file" id="image_profile" name="image_profile" class="block w-full" :value="old('image_profile')" :has-error="$errors->has('image_profile')"  />
                            <small class="inline-flex items-center mt-2 text-xs text-orange-400 gap-x-1">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path>
                                </svg>

                                <span>{{ __('أدخل صورة في حالة تريد تحديثها فقط.') }}</span>
                            </small>
                            <x-inputs.error :messages="$errors->get('image_profile')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mt-6">
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="full_name" :value="__('اسم الموظف')" :has-error="$errors->has('full_name')" required />
                            <x-inputs.input type="text" id="full_name" name="full_name" class="block w-full" :value="old('full_name', $user->full_name)" :has-error="$errors->has('full_name')" required autocomplete="off" />
                            <x-inputs.error :messages="$errors->get('full_name')" class="mt-2" />
                        </div>
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="scope" :value="__('النطاق')" :has-error="$errors->has('scope')" required />
                            <x-inputs.select id="scope" name="scope" class="block w-full" :has-error="$errors->has('scope')" required>
                                @foreach ($scopes as $scope)
                                    <option value="{{ $scope->value }}" @selected($scope->value == old('scope', $user->scope->value))>
                                        {{ $scope->getName() }}
                                    </option>
                                @endforeach
                            </x-inputs.select>
                            <x-inputs.error :messages="$errors->get('scope')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mt-8">
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="email" :value="__('البريد الإلكتروني')" :has-error="$errors->has('email')" required />
                            <x-inputs.input type="email" id="email" name="email" class="block w-full" :value="old('email', $user->email)" :has-error="$errors->has('email')" required autocomplete="off" required />
                            <x-inputs.error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="phone" :value="__('رقم الهاتف')" :has-error="$errors->has('phone')" required />
                            <x-inputs.input type="text" id="phone" name="phone" class="block w-full" :value="old('phone', $user->phone)" :has-error="$errors->has('phone')" required autocomplete="off" />
                            <x-inputs.error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mt-6">
                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="password" :value="__('كلمة المرور')" :has-error="$errors->has('password')" />
                            <x-inputs.input type="password" id="password" name="password" class="block w-full" autocomplete="new-password" :has-error="$errors->has('password')" />
                            <small class="inline-flex items-center mt-2 text-xs text-orange-400 gap-x-1">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path>
                                </svg>

                                <span>{{ __('أدخل كلمة المرور في حالة تريد تحديثها فقط.') }}</span>
                            </small>
                            <x-inputs.error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="col-span-full sm:col-span-1">
                            <x-inputs.label for="password_confirmation" :value="__('تأكيد كلمة المرور')" :has-error="$errors->has('password_confirmation')" />
                            <x-inputs.input type="password" id="password_confirmation" name="password_confirmation" class="block w-full" autocomplete="new-password" :has-error="$errors->has('password_confirmation')" />
                            <x-inputs.error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                </x-slot>
            </x-panel>

            <div class="flex items-center justify-end mt-4 gap-x-4">
                <x-buttons.secondary-link :href="route('admin.users.show', $user)">
                    <span>{{ __('إلغاء') }}</span>
                </x-buttons.secondary-link>

                <x-buttons.primary-button>
                    <x-heroicon-o-check-circle class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('تحديث') }}</span>
                </x-buttons.primary-button>
            </div>
        </form>
    </x-slot>
</x-admin-layout>
