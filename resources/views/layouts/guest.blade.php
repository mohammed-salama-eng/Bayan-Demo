<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @if (app()->getLocale() === 'ar')
            <link href="https://fonts.bunny.net/css?family=cairo:400,600,700&display=swap" rel="stylesheet" />
        @endif

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 dark:text-gray-100 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="absolute top-4 right-4 ltr:right-4 rtl:left-4 flex gap-1">
                <a href="{{ route('locale.set', 'en') }}"
                   class="px-2 py-1 text-xs font-medium rounded-md {{ app()->getLocale() === 'en' ? 'bg-indigo-600 text-white' : 'text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-200' }}">
                    EN
                </a>
                <a href="{{ route('locale.set', 'ar') }}"
                   class="px-2 py-1 text-xs font-medium rounded-md {{ app()->getLocale() === 'ar' ? 'bg-indigo-600 text-white' : 'text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-200' }}">
                    عربي
                </a>
            </div>

            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500 dark:text-gray-400" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
