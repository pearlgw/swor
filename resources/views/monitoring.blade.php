<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('image/logo_remove.png') }}" type="image/png">
    <title>Homepage Monitoring</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="font-poppins bg-gray-100 flex flex-col min-h-screen">

    @include('components_homepage.navbar')

    <!-- konten utama -->
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto py-10 mt-16">
            <div class="bg-white shadow rounded-xl p-6">
                <h2 class="text-xl font-semibold mb-4">Download Monitoring Pasien</h2>

                <!-- Form Download -->
                <form id="downloadForm" method="POST" action="{{ route('monitoring.download') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label class="block text-gray-700 font-medium">Kode Pasien</label>
                            <input type="text" name="kode_pasien" class="w-full border rounded px-2 py-2" placeholder="Masukkan Kode Pasien">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Umur</label>
                            <input type="number" name="umur" class="w-full border rounded px-2 py-2" placeholder="Masukkan Umur">
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
                        <h3 class="text-lg font-semibold mb-2">Grafik Perkembangan</h3>
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
    </main>

    <!-- footer otomatis nempel bawah -->
    @include('components_homepage.footer')

    <script>
        let chart;
        const ctx = document.getElementById("monitoringChart").getContext("2d");

        function fetchMonitoringData() {
            const kode = document.querySelector("input[name='kode_pasien']").value;
            const umur = document.querySelector("input[name='umur']").value;
            const month = document.querySelector("input[name='month']").value;

            if (!kode || !umur || !month) return;

            fetch(`{{ route('monitoring.data') }}?kode_pasien=${kode}&umur=${umur}&month=${month}`)
                .then(res => res.json())
                .then(res => {
                    if (chart) chart.destroy();

                    // Ubah labels dari backend menjadi "Terapi ke-1", "Terapi ke-2", dst
                    const terapiLabels = res.labels.map((label, index) => `Terapi ke-${index + 1}`);

                    chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: terapiLabels,
                            datasets: [{
                                label: 'Sudut Tangan',
                                data: res.data,
                                borderColor: "rgba(54, 162, 235, 1)",
                                backgroundColor: "rgba(54, 162, 235, 0.2)",
                                fill: true,
                                tension: 0.3
                            }]
                        },
                        options: {
                            animation: {
                                duration: 1000
                            },
                            scales: {
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Sudut °',
                                        font: {
                                            size: 14,
                                            weight: 'bold'
                                        },
                                        padding: {
                                            bottom: 10
                                        }
                                    },
                                    beginAtZero: true
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Keterangan Waktu',
                                        font: {
                                            size: 14,
                                            weight: 'bold'
                                        },
                                        padding: {
                                            top: 10
                                        }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                }
                            }
                        }
                    });

                    const wrapper = document.getElementById("chartWrapper");
                    wrapper.classList.remove("hidden");
                    setTimeout(() => {
                        wrapper.classList.remove("opacity-0", "max-h-0");
                        wrapper.classList.add("opacity-100", "max-h-[500px]");
                    }, 50);
                });
        }

        document.querySelector("input[name='kode_pasien']").addEventListener("change", fetchMonitoringData);
        document.querySelector("input[name='umur']").addEventListener("change", fetchMonitoringData);
        document.querySelector("input[name='month']").addEventListener("change", fetchMonitoringData);

        document.getElementById("downloadForm").addEventListener("submit", function() {
            const base64 = document.getElementById("monitoringChart").toDataURL("image/png");
            document.getElementById("chart_base64").value = base64;
        });
    </script>

</body>

</html>
