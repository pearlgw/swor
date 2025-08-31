<!-- Hero Section -->
<section class="relative w-full h-screen flex items-center justify-center bg-cover bg-center md:bg-top mt-10 md:mt-0"
    style="background-image: url('{{ asset('image/image5.jpeg') }}');">
    <div class="absolute inset-0 bg-blue-900/40"></div>
    <div class="relative z-10 text-center max-w-3xl px-6">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-lg">SWOR</h1>
        <p class="text-lg md:text-2xl text-blue-100 mt-4">Shoulder Wheel for Optimal Rehabilitation</p>
        <p class="text-md md:text-lg text-white/90 mt-6 leading-relaxed">
            Inovasi alat rehabilitasi bahu pasca stroke berbasis sensor untuk mendukung pelayanan kesehatan yang
            lebih terukur.
        </p>
        <div class="flex justify-center space-x-4 mt-6">
            <a href="#tentang"
                class="mt-8 inline-block bg-blue-600 hover:bg-blue-900 text-white px-6 py-3 rounded-lg shadow-lg transition">
                Tentang SWOR
            </a>

            <a href="{{ route('monitoring.page') }}"
                class="mt-8 inline-block bg-blue-600 hover:bg-blue-900 text-white px-6 py-3 rounded-lg shadow-lg transition">
                Download Hasil
            </a>
        </div>
    </div>
</section>
