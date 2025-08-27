<x-guest-layout>
    <div class="bg-white dark:bg-gray-800 flex justify-center items-center w-screen h-screen p-6">
        <div class="min-h-screen flex w-full max-w-7xl rounded-xl shadow-xl overflow-hidden">
            <!-- الجهة اليسرى -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-tr from-primary-700 to-primary-400 justify-center items-center relative overflow-hidden">
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div class="relative z-10 px-12 text-center">
                    <div class="w-24 h-24 mx-auto bg-white rounded-full flex items-center justify-center mb-10 shadow-2xl text-primary-600" style="font-size: 1.8rem;">
                        <x-application-logo class="w-24 h-24" />
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-3">تسجيل جهة جديدة</h1>
                    <p class="text-white/80 text-base mb-8">يرجى تعبئة البيانات وتحميل المستندات المطلوبة</p>
                </div>
                <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 border-white/30 rounded-full"></div>
                <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 border-white/30 rounded-full"></div>
                <div class="absolute top-0 -right-20 w-80 h-80 border-4 border-white/30 rounded-full"></div>
            </div>

            <!-- الجهة اليمنى -->
            <div class="w-full lg:w-1/2 flex items-center justify-center bg-white px-4 py-8">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="w-full max-w-xl space-y-6 text-sm">
                    @csrf

                    <div x-data="{ type: '{{ old('type') }}' }">
                        <h2 class="text-xl font-bold text-center text-gray-800 mb-4">تسجيل جهة جديدة</h2>

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
                        <!-- الاسم والنوع -->
                        <div class="grid grid-cols-2 gap-6 mt-6">
                            <div class="col-span-full sm:col-span-1">
                                <label for="name" class="block text-base font-medium text-gray-700 mb-2">اسم الجهة</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                    class="w-full p-3 text-base border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:outline-none" />
                                @error('name')
                                    <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-span-full sm:col-span-1">
                                <label for="type" class="block text-base font-medium text-gray-700 mb-2">نوع الجهة</label>
                                <select id="type" name="type" required
                                    class="w-full p-3 text-base border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:outline-none">
                                  <option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;اختر نوع الجهة</option>
                                    <option value="public">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;عامة</option>
                                    <option value="private">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;خاصة</option>
                                </select>
                                @error('type')
                                    <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                      <!-- زر التسجيل -->
                        <div class="pt-6 mb-2">
                            <button type="submit"
                                class="w-full py-3 px-6 text-base font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 flex items-center justify-center">
                                <x-heroicon-o-check-circle class="w-5 h-5 ml-2" />
                                تسجيل
                            </button>
                        </div>
                        <!-- جملة لديك حساب -->
                        <p class="text-center text-sm text-gray-600">
                            لديك حساب؟
                            <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-500 font-semibold">اضغط هنا للدخول</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
