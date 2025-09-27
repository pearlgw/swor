<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Monitoring
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <form action="{{ route('monitoring.update', $monitoring->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Pasien --}}
                    <div>
                        <label class="block font-medium">Pasien</label>
                        <select name="pasien_id" class="w-full rounded border-gray-300">
                            <option value="">-- Pilih Pasien --</option>
                            @foreach ($pasiens as $pasien)
                                <option value="{{ $pasien->id }}"
                                    {{ old('pasien_id', $monitoring->pasien_id) == $pasien->id ? 'selected' : '' }}>
                                    {{ $pasien->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('pasien_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @if (Auth::user()->is_admin === 0)
                        <input type="hidden" name="dokter_id" value="{{ $monitoring->dokter_id ?? Auth::id() }}">
                    @elseif (Auth::user()->is_admin === 1)
                        <div>
                            <label class="block font-medium">Dokter</label>
                            <select name="dokter_id" class="w-full rounded border-gray-300">
                                <option value="">-- Pilih Dokter --</option>
                                @foreach ($dokters as $dokter)
                                    <option value="{{ $dokter->id }}"
                                        {{ old('dokter_id', $monitoring->dokter_id) == $dokter->id ? 'selected' : '' }}>
                                        {{ $dokter->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dokter_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    {{-- Tinggi Shoulder --}}
                    <div>
                        <label class="block font-medium">Tinggi Shoulder (cm)</label>
                        <input type="number" step="0.01" name="tinggi_shoulder"
                            class="w-full rounded border-gray-300"
                            value="{{ old('tinggi_shoulder', $monitoring->tinggi_shoulder) }}">
                    </div>

                    {{-- Sudut Tangan --}}
                    <div>
                        <label class="block font-medium">Sudut Tangan (°)</label>
                        <input type="number" step="0.01" name="sudut_tangan" class="w-full rounded border-gray-300"
                            value="{{ old('sudut_tangan', $monitoring->sudut_tangan) }}">
                    </div>

                    {{-- Kecepatan --}}
                    <div>
                        <label class="block font-medium">Kecepatan</label>
                        <input type="number" step="0.01" name="kecepatan" class="w-full rounded border-gray-300"
                            value="{{ old('kecepatan', $monitoring->kecepatan) }}">
                    </div>

                    <div>
                        <label class="block font-medium">Mode</label>
                        <input type="text" name="mode" class="w-full rounded border-gray-300"
                            value="{{ old('mode', $monitoring->mode) }}">
                    </div>

                    <div>
                        <label class="block font-medium">Mode Tangan</label>
                        <input type="text" name="mode_tangan" class="w-full rounded border-gray-300"
                            value="{{ old('mode_tangan', $monitoring->mode_tangan) }}">
                    </div>

                    {{-- Jenis Terapi --}}
                    <div>
                        <label class="block font-medium">Jenis Terapi</label>
                        <input type="text" name="jenis_terapi" class="w-full rounded border-gray-300"
                            value="{{ old('jenis_terapi', $monitoring->jenis_terapi) }}">
                    </div>

                    {{-- Frekuensi Latihan --}}
                    <div>
                        <label class="block font-medium">Frekuensi Latihan (kali/minggu)</label>
                        <input type="number" name="frekuensi_latihan" class="w-full rounded border-gray-300"
                            value="{{ old('frekuensi_latihan', $monitoring->frekuensi_latihan) }}">
                    </div>

                    {{-- Durasi Sesi --}}
                    <div>
                        <label class="block font-medium">Durasi Sesi (menit)</label>
                        <input type="number" name="durasi_sesi" class="w-full rounded border-gray-300"
                            value="{{ old('durasi_sesi', $monitoring->durasi_sesi) }}">
                    </div>

                    {{-- Jumlah Repetisi --}}
                    <div>
                        <label class="block font-medium">Jumlah Repetisi (per sesi)</label>
                        <input type="number" name="jumlah_repetisi" class="w-full rounded border-gray-300"
                            value="{{ old('jumlah_repetisi', $monitoring->jumlah_repetisi) }}">
                    </div>

                    {{-- Sudut Rotasi --}}
                    <div>
                        <label class="block font-medium">Sudut Rotasi</label>
                        <input type="number" step="0.01" name="sudut_rotasi" class="w-full rounded border-gray-300"
                            value="{{ old('sudut_rotasi', $monitoring->sudut_rotasi) }}">
                    </div>

                    {{-- Catatan --}}
                    <div>
                        <label class="block font-medium">Catatan</label>
                        <textarea name="catatan" class="w-full rounded border-gray-300">{{ old('catatan', $monitoring->catatan) }}</textarea>
                    </div>

                    {{-- Jam Mulai --}}
                    <div>
                        <label class="block font-medium">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="w-full rounded border-gray-300"
                            value="{{ old('jam_mulai', $monitoring->jam_mulai ? \Carbon\Carbon::parse($monitoring->jam_mulai)->format('H:i') : '') }}">
                    </div>

                    {{-- Jam Selesai --}}
                    <div>
                        <label class="block font-medium">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="w-full rounded border-gray-300"
                            value="{{ old('jam_selesai', $monitoring->jam_selesai ? \Carbon\Carbon::parse($monitoring->jam_selesai)->format('H:i') : '') }}">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block font-medium">Status</label>
                        <select name="status" class="w-full rounded border-gray-300">
                            <option value="">-- Pilih Status --</option>
                            <option value="selesai"
                                {{ old('status', $monitoring->status) == 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="berlangsung"
                                {{ old('status', $monitoring->status) == 'berlangsung' ? 'selected' : '' }}>Berlangsung
                            </option>
                            <option value="batal"
                                {{ old('status', $monitoring->status) == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
