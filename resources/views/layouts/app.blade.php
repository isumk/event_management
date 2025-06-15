<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">

    <header class="bg-white dark:bg-gray-800 shadow">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <x-application-logo class="block h-8 w-auto text-indigo-600 dark:text-indigo-400" />
                        <span class="font-bold text-xl text-gray-900 dark:text-gray-100">Event Management</span>
                    </a>
                </div>

                <div class="flex space-x-8 items-center">
                    @include('layouts.navigation')
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow max-w-7xl mx-auto p-6 w-full">
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow rounded mb-6 px-6 py-4">
                <div class="text-gray-900 dark:text-gray-100 font-semibold text-lg">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{ $slot }}
    </main>

    <footer class="bg-white dark:bg-gray-800 shadow-inner p-4 text-center text-gray-500 dark:text-gray-400 text-sm">
        &copy; {{ date('Y') }} Event Management system by Isumjith Kariyawasam. All rights reserved.
    </footer>

</body>
</html>
