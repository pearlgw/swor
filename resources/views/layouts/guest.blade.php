<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SWOR - Shoulder Wheel for Optimal Rehabilitation') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/png" href="{{ asset('image/logo_remove.png') }}" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins text-gray-900 antialiased bg-gradient-to-br from-blue-50 via-white to-blue-100">
    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-6">
        <!-- Card -->
        <div
            class="w-full max-w-md bg-white/95 backdrop-blur-md shadow-lg rounded-xl border border-blue-100 p-6 md:p-8">
            {{ $slot }}
        </div>
    </div>
</body>

</html>

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-poppins text-gray-900 antialiased bg-gradient-to-br from-blue-50 via-white to-blue-100">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="w-full sm:max-w-md mt-6 px-6 py-6 sm:py-8 bg-white/95 backdrop-blur-md shadow-lg sm:rounded-2xl border border-blue-100">
                {{ $slot }}
            </div>
        </div>
    </body>
</html> --}}
