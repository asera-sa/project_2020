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
                        <h2 class="text-4xl font-extrabold text-gray-900 mb-3">تأكيد البريد الإلكتروني</h2>
                        <p class="text-lg text-gray-600">
                            شكراً لتسجيلك! قبل المتابعة, هل يمكنك تأكيد بريدك الإلكتروني بالضغط على الرابط الذي أرسلناه لك للتو؟ إذا لم تستلم الرسالة, سنقوم بكل سرور بإرسال واحدة أخرى.
                        </p>
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            تم إرسال رابط تحقق جديد إلى عنوان البريد الإلكتروني الذي قدمته أثناء التسجيل.
                        </div>
                    @endif

                    <div class="mt-4 flex items-center justify-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div>
                                <x-buttons.primary-button>
                                    {{ __('إعادة إرسال رسالة التأكيد') }}
                                </x-buttons.primary-button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('تسجيل الخروج') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
