<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('image/logo_remove.png') }}" />

    <title>{{ config('app.name', 'SWOR') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body x-data="{ open: false }" class="font-poppins antialiased bg-gradient-to-br from-blue-50 via-gray-50 to-blue-100">

    <div class="min-h-screen flex">

        <!-- SIDEBAR (Desktop) -->
        <aside class="w-64 bg-white border-r border-blue-100 shadow-md hidden sm:flex flex-col">
            <!-- Logo -->
            <div class="h-16 flex items-center justify-center border-b border-blue-100">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('image/logo_remove.png') }}" class="h-10 rounded-full shadow" alt="Logo">
                </a>
            </div>

            <!-- Menu -->
            <nav class="flex-1 p-4 space-y-2 text-blue-700">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="w-full block px-4 py-2 rounded-lg hover:bg-blue-50">
                    Dashboard
                </x-nav-link>
                <x-nav-link :href="route('dokter.index')" :active="request()->routeIs('dokter.index')"
                    class="w-full block px-4 py-2 rounded-lg hover:bg-blue-50">
                    Dokter
                </x-nav-link>
                <x-nav-link :href="route('pasien.index')" :active="request()->routeIs('pasien.index')"
                    class="w-full block px-4 py-2 rounded-lg hover:bg-blue-50">
                    Pasien
                </x-nav-link>
                <x-nav-link :href="route('monitoring.index')" :active="request()->routeIs('monitoring.index')"
                    class="w-full block px-4 py-2 rounded-lg hover:bg-blue-50">
                    Monitoring
                </x-nav-link>
                <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')"
                    class="w-full block px-4 py-2 rounded-lg hover:bg-blue-50">
                    Profile
                </x-nav-link>
            </nav>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col">

            <!-- NAVBAR TOP -->
            <header
                class="h-16 bg-white border-b border-blue-100 shadow flex items-center justify-between px-4 sm:px-6">
                <!-- Hamburger for mobile -->
                <div class="sm:hidden">
                    <button @click="open = !open" class="p-2 rounded-md text-gray-500 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Right side user dropdown -->
                <div>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-600 bg-white hover:text-blue-700 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="ms-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            <!-- MOBILE SIDEBAR -->
            <div x-show="open" class="sm:hidden fixed inset-y-0 left-0 w-64 bg-white shadow-lg z-50 p-6"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="-translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="-translate-x-full opacity-0">

                <!-- Close button -->
                <button @click="open = false" class="mb-4 text-gray-500 hover:text-red-500">
                    ✕
                </button>

                <nav class="flex flex-col space-y-2 text-blue-700">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="block w-full px-4 py-2 rounded-lg hover:bg-blue-50">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('dokter.index')" :active="request()->routeIs('dokter.index')"
                        class="w-full block px-4 py-2 rounded-lg hover:bg-blue-50">
                        Dokter
                    </x-nav-link>
                    <x-nav-link :href="route('pasien.index')" :active="request()->routeIs('pasien.index')"
                        class="block w-full px-4 py-2 rounded-lg hover:bg-blue-50">
                        Pasien
                    </x-nav-link>
                    <x-nav-link :href="route('monitoring.index')" :active="request()->routeIs('monitoring.index')"
                        class="w-full block px-4 py-2 rounded-lg hover:bg-blue-50">
                        Monitoring
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')"
                        class="block w-full px-4 py-2 rounded-lg hover:bg-blue-50">
                        Profile
                    </x-nav-link>
                </nav>
            </div>

            <!-- MAIN PAGE CONTENT -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
