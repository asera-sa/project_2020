<x-guest-layout>
    <div class="bg-white dark:bg-gray-800 flex justify-center items-center w-screen h-screen p-6">
        <div class="min-h-screen flex w-full max-w-7xl">
            <!-- الجهة اليسرى - شعار -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-tr from-primary-700 to-primary-400 justify-center items-center relative overflow-hidden">
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div class="relative z-10 px-12 text-center">
                    <div class="w-28 h-28 mx-auto bg-white rounded-full flex items-center justify-center mb-10 shadow-2xl text-primary-600" style="font-size: 2rem;">
                        <x-application-logo  class="w-28 h-28" />
                    </div>
                    <h1 class="text-4xl font-bold text-white mb-4">تسجيل دخول آمن</h1>
                    <p class="text-white/80 text-lg mb-10">بياناتك محمية بأحدث تقنيات الأمان والتشفير</p>
                    <div class="flex justify-center space-x-4">
                        <div class="w-3 h-3 rounded-full bg-white/30"></div>
                        <div class="w-3 h-3 rounded-full bg-white"></div>
                        <div class="w-3 h-3 rounded-full bg-white/30"></div>
                    </div>
                </div>
                <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 border-white/30 rounded-full"></div>
                <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 border-white/30 rounded-full"></div>
                <div class="absolute top-0 -right-20 w-80 h-80 border-4 border-white/30 rounded-full"></div>
            </div>

            <!-- الجهة اليمنى - نموذج تسجيل الدخول -->
            <div class="w-full lg:w-1/2 flex items-center justify-center bg-white px-12 py-16">
                <div class="w-full max-w-xl">
                    <!-- رسائل التنبيه -->
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="text-center lg:text-right mb-10">
                        <h2 class="text-4xl font-extrabold text-gray-900 mb-3">أهلاً بعودتك</h2>
                        <p class="text-lg text-gray-600">قم بتسجيل الدخول للوصول إلى حسابك والبدء في استخدام النظام</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-7">
                        @csrf
                        <div>
                            <label for="email" class="block text-base font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                            <input type="email" id="email" name="email" required
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 text-base"
                                   placeholder="example@email.com">
                            @error('email')
                                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-base font-medium text-gray-700 mb-1">كلمة المرور</label>
                            <input type="password" id="password" name="password" required
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 text-base"
                                   placeholder="••••••••">
                        </div>

                        <div>
                            <button type="submit"
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                دخول
                            </button>
                        </div>
                    </form>

                    <p class="mt-10 text-center text-sm text-gray-600">
                        ليس لديك حساب؟
                        <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">سجل الآن</a>
                    </p>

                    <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                        <p class="text-xs text-blue-700 text-center">
                            <strong>ملاحظة مهمة:</strong> الحسابات غير المفعلة لا يمكنها تسجيل الدخول للنظام حتى يتم تفعيلها من قبل الإدارة.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
