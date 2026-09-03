<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="{{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
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
            <div class="absolute top-4 right-4 ltr:right-4 rtl:left-4 flex items-center gap-1">
                <a href="{{ route('locale.set', 'en') }}"
                   class="px-2 py-1 text-xs font-medium rounded-md {{ app()->getLocale() === 'en' ? 'bg-indigo-600 text-white' : 'text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-200' }}">
                    EN
                </a>
                <a href="{{ route('locale.set', 'ar') }}"
                   class="px-2 py-1 text-xs font-medium rounded-md {{ app()->getLocale() === 'ar' ? 'bg-indigo-600 text-white' : 'text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-200' }}">
                    عربي
                </a>
                <a href="{{ route('theme.set', (session('theme', 'light')) === 'dark' ? 'light' : 'dark') }}"
                   class="p-1.5 text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 rounded-md hover:text-gray-700 dark:hover:text-gray-200 transition"
                   title="{{ (session('theme', 'light')) === 'dark' ? __('Switch to light mode') : __('Switch to dark mode') }}">
                    @if((session('theme', 'light')) === 'dark')
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    @else
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    @endif
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
