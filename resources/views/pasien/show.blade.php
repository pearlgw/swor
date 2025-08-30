<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pasien
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow rounded-xl p-6">
                    <!-- Header + Form Filter -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                        <h3 class="text-lg font-semibold text-gray-800">Grafik Perkembangan</h3>

                        <form method="GET" action="{{ route('pasien.show', $pasien->id) }}"
                            class="flex items-center gap-2">
                            <label for="month" class="text-gray-700 font-medium">Filter Bulan:</label>
                            <input type="month" id="month" name="month"
                                value="{{ $month ?? now()->format('Y-m') }}" class="border rounded px-2 py-1">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Tampilkan
                            </button>
                        </form>
                    </div>

                    <!-- Chart -->
                    <div>
                        <canvas id="monitoringChart" height="120"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-xl p-6 mt-6">
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2 md:col-span-2">
                        <p class="text-gray-500">Kode Pasien</p>
                        <p class="font-semibold">{{ $pasien->kode_pasien }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Nama Lengkap</p>
                        <p class="font-semibold">{{ $pasien->nama }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Umur</p>
                        <p class="font-semibold">{{ $pasien->umur ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Metode</p>
                        <p class="font-semibold">{{ $pasien->metode ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Tingkat Hemiparese</p>
                        <p class="font-semibold">{{ $pasien->tingkat_hemiparese ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Diagnosa Utama</p>
                        <p class="font-semibold">{{ $pasien->diagnosa_utama ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Riwayat Penyakit</p>
                        <p class="font-semibold">{{ $pasien->riwayat_penyakit ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Tanggal Sakit</p>
                        <p class="font-semibold">
                            {{ $pasien->tanggal_sakit ? $pasien->tanggal_sakit->format('d-m-Y') : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Tanggal Mulai Terapi</p>
                        <p class="font-semibold">
                            {{ $pasien->tanggal_mulai_terapi ? $pasien->tanggal_mulai_terapi->format('d-m-Y') : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Dokter Penanggung Jawab</p>
                        <p class="font-semibold">{{ $pasien->user?->name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Dibuat Pada</p>
                        <p class="font-semibold">{{ $pasien->created_at->format('d-m-Y H:i') }}</p>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('pasien.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('monitoringChart').getContext('2d');
        const data = @json($chartData);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(d => [
                    d.minggu,
                    d.created_at ? new Date(d.created_at).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    }) : ''
                ]),
                datasets: [{
                    label: 'Sudut Tangan (°)',
                    data: data.map(d => d.sudut),
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            afterLabel: function(context) {
                                const item = data[context.dataIndex];
                                if (item.jam_mulai && item.jam_selesai) {
                                    return `Jam: ${item.jam_mulai} - ${item.jam_selesai}`;
                                }
                                return '';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Sudut Tangan (°)'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
