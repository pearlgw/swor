<!-- Navbar -->
<nav x-data="{ open: false }" class="fixed top-0 left-0 w-full bg-white shadow-md z-50">
    <div class="max-w-7xl mx-auto py-4 px-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="/image/logo_remove.png" alt="Logo" class="h-8 object-cover" />
        </div>

        <!-- Menu (Desktop) -->
        <ul class="hidden md:flex space-x-8 text-gray-800 font-medium">
            <li><a href="#" class="hover:text-blue-900 transition">Beranda</a></li>
            <li><a href="#tentang" class="hover:text-blue-900 transition">Tentang</a></li>
            <li><a href="#manfaat" class="hover:text-blue-900 transition">Manfaat</a></li>
            <li><a href="#kontak" class="hover:text-blue-900 transition">Kontak</a></li>
        </ul>

        <!-- Login / User (Desktop) -->
        <div class="hidden md:flex items-center space-x-4">
            @auth
                <span class="text-gray-800 font-semibold">{{ Auth::user()->name }}</span>
                <a href="{{ route('dashboard') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-900 transition">
                    Dashboard
                </a>
            @else
                <a href="/login" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-900 transition">
                    Login
                </a>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <button @click="open = !open" class="md:hidden text-gray-600 focus:outline-none text-2xl">
            ☰
        </button>
    </div>

    <!-- Mobile Menu (Dropdown) -->
    <div x-show="open" x-transition class="md:hidden bg-white shadow-md">
        <ul class="flex flex-col space-y-4 py-4 px-6 text-gray-800 font-medium">
            <li><a href="#" class="hover:text-blue-900 transition">Beranda</a></li>
            <li><a href="#tentang" class="hover:text-blue-900 transition">Tentang</a></li>
            <li><a href="#manfaat" class="hover:text-blue-900 transition">Manfaat</a></li>
            <li><a href="#kontak" class="hover:text-blue-900 transition">Kontak</a></li>

            @auth
                <li>
                    <span class="block w-full text-center font-semibold text-blue-600">
                        {{ Auth::user()->name }}
                    </span>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-900 transition">
                        Dashboard
                    </a>
                </li>
            @else
                <li>
                    <a href="/login"
                        class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-900 transition">
                        Login
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

{{-- <!-- Navbar -->
<nav x-data="{ open: false }" class="fixed top-0 left-0 w-full bg-white shadow-md z-50">
    <div class="max-w-7xl mx-auto py-4 px-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="/image/logo_remove.png" alt="Logo" class="h-8 object-cover" />
        </div>

        <!-- Menu (Desktop) -->
        <ul class="hidden md:flex space-x-8 text-gray-800 font-medium">
            <li><a href="#" class="hover:text-blue-900 transition">Beranda</a></li>
            <li><a href="#tentang" class="hover:text-blue-900 transition">Tentang</a></li>
            <li><a href="#manfaat" class="hover:text-blue-900 transition">Manfaat</a></li>
            <li><a href="#kontak" class="hover:text-blue-900 transition">Kontak</a></li>
        </ul>

        <!-- Login Button (Desktop) -->
        <div class="hidden md:block">
            <a href="/login" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-900 transition">
                Login
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button @click="open = !open" class="md:hidden text-gray-600 focus:outline-none text-2xl">
            ☰
        </button>
    </div>

    <!-- Mobile Menu (Dropdown) -->
    <div x-show="open" x-transition class="md:hidden bg-white shadow-md">
        <ul class="flex flex-col space-y-4 py-4 px-6 text-gray-800 font-medium">
            <li><a href="#" class="hover:text-blue-900 transition">Beranda</a></li>
            <li><a href="#tentang" class="hover:text-blue-900 transition">Tentang</a></li>
            <li><a href="#manfaat" class="hover:text-blue-900 transition">Manfaat</a></li>
            <li><a href="#kontak" class="hover:text-blue-900 transition">Kontak</a></li>
            <li>
                <a href="/login"
                    class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-900 transition">
                    Login
                </a>
            </li>
        </ul>
    </div>
</nav> --}}
