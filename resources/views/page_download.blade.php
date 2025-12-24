<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Monitoring SWOR</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 40px;
            position: relative;
        }

        header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        header p {
            margin: 3px 0;
            font-size: 11px;
        }

        footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }

        h2 {
            margin-bottom: 5px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            font-size: 11px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        .chart {
            text-align: center;
            margin: 15px 0;
        }

        .info-table td {
            border: none;
            text-align: left;
            padding: 3px 6px;
        }

        /* Watermark */
        .watermark {
            position: fixed;
            top: 50%;
            left: 43%;
            width: 300px;
            /* atur ukuran sesuai logo */
            opacity: 0.2;
            /* semakin kecil semakin transparan */
            transform: translate(-50%, -50%);
            z-index: -1;
            /* biar ada di belakang konten */
        }
    </style>
</head>

<body class="font-poppins">

    <!-- Watermark Logo -->
    <img src="{{ public_path('image/logo_remove.png') }}" class="watermark" alt="Watermark">

    <header>
        <h1>Monitoring SWOR</h1>
        <p>Universitas Dian Nuswantoro</p>
        <p>Bulan: {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}</p>
    </header>

    @foreach ($data as $item)
        <h2>Data Pasien</h2>
        <table class="info-table">
            <tr>
                <td><strong>Nama</strong></td>
                <td>: {{ $item['pasien']->nama }}</td>
                <td><strong>Kode Pasien</strong></td>
                <td>: {{ $item['pasien']->kode_pasien }}</td>
            </tr>
            <tr>
                <td><strong>Umur</strong></td>
                <td>: {{ $item['pasien']->umur }}</td>
                <td><strong>Metode</strong></td>
                <td>: {{ $item['pasien']->metode ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Diagnosa Utama</strong></td>
                <td colspan="3">: {{ $item['pasien']->diagnosa_utama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Tingkat Hemiparese</strong></td>
                <td>: {{ $item['pasien']->tingkat_hemiparese ?? '-' }}</td>
                <td><strong>Riwayat Penyakit</strong></td>
                <td>: {{ $item['pasien']->riwayat_penyakit ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Sakit</strong></td>
                <td>:
                    {{ $item['pasien']->tanggal_sakit ? \Carbon\Carbon::parse($item['pasien']->tanggal_sakit)->format('d-m-Y') : '-' }}
                </td>
                <td><strong>Tanggal Mulai Terapi</strong></td>
                <td>:
                    {{ $item['pasien']->tanggal_mulai_terapi ? \Carbon\Carbon::parse($item['pasien']->tanggal_mulai_terapi)->format('d-m-Y') : '-' }}
                </td>
            </tr>
            <tr>
                <td><strong>Dokter Penanggung Jawab</strong></td>
                <td colspan="3">: {{ $item['pasien']->user->name ?? '-' }}</td>
            </tr>
        </table>

        <!-- Grafik -->
        <div class="chart">
            @if (!empty($item['chart']))
                <img src="{{ $item['chart'] }}" alt="Grafik Perkembangan" style="max-width:100%; height:auto;">
            @else
                <p><i>Grafik tidak tersedia</i></p>
            @endif
        </div>

        <!-- Tabel Monitoring -->
        <table>
            <thead>
                <tr>
                    <th>Terapi Ke</th>
                    <th>Tanggal</th>
                    <th>Jam Mulai - Jam Selesai</th>
                    <th>Sudut Tangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($item['monitorings'] as $monitoring)
                    <tr>
                        {{-- <td>{{ $monitoring->minggu }}</td> --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($monitoring->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                        <td>
                            {{ $monitoring->jam_mulai ? \Carbon\Carbon::parse($monitoring->jam_mulai)->format('H:i') : '-' }}
                            -
                            {{ $monitoring->jam_selesai ? \Carbon\Carbon::parse($monitoring->jam_selesai)->format('H:i') : '-' }}
                        </td>
                        <td>{{ $monitoring->sudut_tangan ?? '-' }}°</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Tidak ada data monitoring bulan ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach

    <footer>
        &copy; {{ date('Y') }} Universitas Dian Nuswantoro - Monitoring SWOR
    </footer>

</body>

</html>
