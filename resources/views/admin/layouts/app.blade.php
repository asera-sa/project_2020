
<!DOCTYPE html>
<html class="h-full" dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{URL::asset('entities/assets/img/logo.png')}}" type="image/x-icon">

        <title>{{ config('app.name') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('css')
    </head>
    <body class="h-full font-sans antialiased">
        <div>
            @include('admin.layouts.aside')

            <div class="lg:ps-72">
                <main class="py-5">
                    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        <x-alert />
        @stack('js')
    </body>
</html>
