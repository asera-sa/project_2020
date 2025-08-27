<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{URL::asset('entities/assets/img/logo.png')}}" type="image/x-icon">

        <title>{{ config('app.name') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">

        <style>
            .logo-container {
                display: flex; /* استخدام الفليكس لجعل العناصر بجانب بعضها */
                justify-content: center; /* توسيط العناصر */
                align-items: center; /* محاذاة العناصر عموديًا */
                flex-wrap: wrap; /* السماح للعناصر باللف في حالة ضيق المساحة */
            }
            .logo-img {
                margin: 10px; /* إضافة هوامش بين الصور */
                transition: transform 0.2s; /* تأثير التحرك عند التحويم */
            }
            .logo-img:hover {
                transform: scale(1.1); /* تكبير الصورة عند التحويم */
            }
        </style>

    </head>
    <body class="font-sans antialiased text-gray-900">

        <div class="flex flex-col items-center justify-center min-h-screen px-4 pt-6 sm:px-0 sm:pt-0">
            {{-- <div>
                <x-dashboard-logo side="قسم التدريب" />
            </div> --}}

            {{-- <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white rounded-sm shadow-lg sm:max-w-md"> --}}
                {{ $slot }}
            {{-- </div> --}}
        </div>
    </body>
</html>
