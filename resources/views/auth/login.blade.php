<x-guest-layout>
    <div class="flex items-center justify-center w-screen h-screen p-6 bg-white dark:bg-gray-800">
        <div class="flex w-full min-h-screen max-w-7xl">
            <!-- الجهة اليسرى - شعار -->
            <div class="relative items-center justify-center hidden overflow-hidden lg:flex lg:w-1/2 bg-gradient-to-tr from-primary-700 to-primary-400">
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div class="relative z-10 px-12 text-center">
                    <div class="flex items-center justify-center mx-auto mb-10 bg-white rounded-full shadow-2xl w-28 h-28 text-primary-600" style="font-size: 2rem;">
                        <x-application-logo  class="w-28 h-28" />
                    </div>
                    <h1 class="mb-4 text-4xl font-bold text-white">تسجيل دخول آمن</h1>
                    <p class="mb-10 text-lg text-white/80">بياناتك محمية بأحدث تقنيات الأمان والتشفير</p>
                    <div class="flex justify-center space-x-4">
                        <div class="w-3 h-3 rounded-full bg-white/30"></div>
                        <div class="w-3 h-3 bg-white rounded-full"></div>
                        <div class="w-3 h-3 rounded-full bg-white/30"></div>
                    </div>
                </div>
                <div class="absolute border-4 rounded-full -bottom-32 -left-40 w-80 h-80 border-white/30"></div>
                <div class="absolute border-4 rounded-full -bottom-40 -left-20 w-80 h-80 border-white/30"></div>
                <div class="absolute top-0 border-4 rounded-full -right-20 w-80 h-80 border-white/30"></div>
            </div>

            <!-- الجهة اليمنى - نموذج تسجيل الدخول -->
            <div class="flex items-center justify-center w-full px-12 py-16 bg-white lg:w-1/2">
                <div class="w-full max-w-xl">
                    <!-- رسائل التنبيه -->
                    @if (session('success'))
                        <div class="p-4 mb-4 text-green-700 bg-green-100 border border-green-400 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-10 text-center lg:text-right">
                        <h2 class="mb-3 text-4xl font-extrabold text-gray-900">أهلاً بعودتك</h2>
                        <p class="text-lg text-gray-600">قم بتسجيل الدخول للوصول إلى حسابك والبدء في استخدام النظام</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-7">
                        @csrf
                        <div>
                            <label for="email" class="block mb-1 text-base font-medium text-gray-700">البريد الإلكتروني</label>
                            <input type="email" id="email" name="email"
                                   class="block w-full px-4 py-3 text-base placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                                   placeholder="example@email.com">
                            @error('email')
                                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block mb-1 text-base font-medium text-gray-700">كلمة المرور</label>
                            <input type="password" id="password" name="password"
                                   class="block w-full px-4 py-3 text-base placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                                   placeholder="••••••••">
                            @error('password')
                                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                    class="flex justify-center w-full px-4 py-3 text-base font-medium text-white border border-transparent rounded-md shadow-sm bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                دخول
                            </button>
                        </div>
                    </form>

                    <p class="mt-10 text-sm text-center text-gray-600">
                        ليس لديك حساب؟
                        <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">سجل الآن</a>
                    </p>

                    {{-- <div class="p-3 mt-4 border border-blue-200 rounded-md bg-blue-50">
                        <p class="text-xs text-center text-blue-700">
                            <strong>ملاحظة مهمة:</strong> الحسابات غير المفعلة لا يمكنها تسجيل الدخول للنظام حتى يتم تفعيلها من قبل الإدارة.
                        </p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
