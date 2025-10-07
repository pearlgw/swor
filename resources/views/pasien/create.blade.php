<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Pasien
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <form action="{{ route('pasien.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block font-medium">Nama</label>
                        <input type="text" name="nama" class="w-full rounded border-gray-300"
                            value="{{ old('nama') }}">
                        @error('nama')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium">Umur</label>
                        <input type="number" name="umur" class="w-full rounded border-gray-300"
                            value="{{ old('umur') }}">
                    </div>

                    <div>
                        <label class="block font-medium">Metode</label>
                        <input type="text" name="metode" class="w-full rounded border-gray-300"
                            value="{{ old('metode') }}">
                    </div>

                    <div>
                        <label class="block font-medium">Diagnosa Utama</label>
                        <textarea name="diagnosa_utama" class="w-full rounded border-gray-300">{{ old('diagnosa_utama') }}</textarea>
                    </div>

                    <div>
                        <label class="block font-medium">Tingkat Hemiparese</label>
                        <input type="text" name="tingkat_hemiparese" class="w-full rounded border-gray-300"
                            value="{{ old('tingkat_hemiparese') }}">
                    </div>

                    <div>
                        <label class="block font-medium">Riwayat Penyakit</label>
                        <textarea name="riwayat_penyakit" class="w-full rounded border-gray-300">{{ old('riwayat_penyakit') }}</textarea>
                    </div>

                    <div>
                        <label class="block font-medium">Tanggal Sakit</label>
                        <input type="date" name="tanggal_sakit" class="w-full rounded border-gray-300"
                            value="{{ old('tanggal_sakit') }}">
                    </div>

                    <div>
                        <label class="block font-medium">Tanggal Mulai Terapi</label>
                        <input type="date" name="tanggal_mulai_terapi" class="w-full rounded border-gray-300"
                            value="{{ old('tanggal_mulai_terapi') }}">
                    </div>

                    @if (Auth::user()->is_admin === 0)
                        <input type="hidden" name="dokter_id">
                    @elseif (Auth::user()->is_admin === 1)
                        <div>
                            <label class="block font-medium">Dokter</label>
                            <select name="dokter_id" class="w-full rounded border-gray-300">
                                <option value="">-- Pilih Dokter --</option>
                                @foreach ($dokters as $dokter)
                                    <option value="{{ $dokter->id }}"
                                        {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>
                                        {{ $dokter->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
