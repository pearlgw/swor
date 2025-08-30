<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold text-blue-700 mb-4">Download Monitoring Pasien</h2>

        <form id="downloadForm" method="POST" action="{{ route('monitoring.download') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-medium">Kode Pasien</label>
                    <input type="text" name="kode_pasien" class="w-full border rounded px-2 py-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Umur</label>
                    <input type="number" name="umur" class="w-full border rounded px-2 py-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Bulan</label>
                    <input type="month" name="month" value="{{ now()->format('Y-m') }}"
                        class="w-full border rounded px-2 py-2">
                </div>
            </div>

            <!-- Grafik -->
            <div id="chartWrapper"
                class="hidden bg-gray-50 border rounded-lg p-4 overflow-hidden transition-all duration-700 ease-in-out opacity-0 max-h-0">
                <h3 class="text-lg font-semibold mb-2 text-blue-700">Grafik Perkembangan</h3>
                <canvas id="monitoringChart" height="100"></canvas>
            </div>

            <input type="hidden" name="chart_base64" id="chart_base64">

            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Download PDF
                </button>
            </div>
        </form>
    </div>
</div>
