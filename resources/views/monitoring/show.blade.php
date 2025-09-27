<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Monitoring
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <div class="grid grid-cols-2 gap-6">

                    {{-- Pasien --}}
                    <div>
                        <p class="text-gray-500">Pasien</p>
                        <p class="font-semibold">{{ $monitoring->pasien?->nama ?? '-' }}</p>
                    </div>

                    {{-- Dokter --}}
                    <div>
                        <p class="text-gray-500">Dokter</p>
                        <p class="font-semibold">{{ $monitoring->user?->name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Tinggi Shoulder (cm)</p>
                        <p class="font-semibold">{{ $monitoring->tinggi_shoulder ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Sudut Tangan (°)</p>
                        <p class="font-semibold">{{ $monitoring->sudut_tangan ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Kecepatan</p>
                        <p class="font-semibold">{{ $monitoring->kecepatan ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Mode</p>
                        <p class="font-semibold">{{ $monitoring->mode ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Mode Tangan</p>
                        <p class="font-semibold">{{ $monitoring->mode_tangan ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Jenis Terapi</p>
                        <p class="font-semibold">{{ $monitoring->jenis_terapi ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Frekuensi Latihan</p>
                        <p class="font-semibold">
                            {{ $monitoring->frekuensi_latihan ? $monitoring->frekuensi_latihan . 'x/minggu' : '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Durasi Sesi</p>
                        <p class="font-semibold">
                            {{ $monitoring->durasi_sesi ? $monitoring->durasi_sesi . ' menit' : '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Jumlah Repetisi</p>
                        <p class="font-semibold">
                            {{ $monitoring->jumlah_repetisi ? $monitoring->jumlah_repetisi . ' kali' : '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Sudut Rotasi</p>
                        <p class="font-semibold">{{ $monitoring->sudut_rotasi ?? '-' }}</p>
                    </div>

                    <div class="col-span-2">
                        <p class="text-gray-500">Catatan</p>
                        <p class="font-semibold">{{ $monitoring->catatan ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Jam Mulai</p>
                        <p class="font-semibold">
                            {{ $monitoring->jam_mulai ? \Carbon\Carbon::parse($monitoring->jam_mulai)->format('H:i') : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Jam Selesai</p>
                        <p class="font-semibold">
                            {{ $monitoring->jam_selesai ? \Carbon\Carbon::parse($monitoring->jam_selesai)->format('H:i') : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Status</p>
                        {{-- <p class="font-semibold capitalize">{{ $monitoring->status ?? '-' }}</p> --}}
                        @if ($monitoring->status === 'berlangsung')
                            <p class="font-semibold capitalize bg-yellow-200 px-2 py-1 rounded-xl inline-block mt-1">
                                {{ ucfirst($monitoring->status) }}
                            </p>
                        @elseif ($monitoring->status === 'selesai')
                            <p class="font-semibold capitalize bg-green-200 px-2 py-1 rounded-xl inline-block mt-1">
                                {{ ucfirst($monitoring->status) }}
                            </p>
                        @elseif ($monitoring->status === 'batal')
                            <p class="font-semibold capitalize bg-red-200 px-2 py-1 rounded-xl inline-block mt-1">
                                {{ ucfirst($monitoring->status) }}
                            </p>
                        @else
                            <span class="px-2 py-1 rounded-xl bg-gray-300 text-gray-700">
                                {{ $monitoring->status ?? '-' }}
                            </span>
                        @endif
                    </div>

                    <div>
                        <p class="text-gray-500">Dibuat Pada</p>
                        <p class="font-semibold">{{ $monitoring->created_at->format('d-m-Y H:i') }}</p>
                    </div>

                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('monitoring.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
