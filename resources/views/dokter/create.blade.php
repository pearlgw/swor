<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Dokter
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                {{-- Notifikasi error global --}}
                {{-- @if ($errors->any())
                    <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700">
                        <strong>Terjadi kesalahan!</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <form action="{{ route('dokter.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block font-medium">Nama</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full rounded border-gray-300">
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium">Email</label>
                        <input type="text" name="email" value="{{ old('email') }}"
                               class="w-full rounded border-gray-300">
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium">Password</label>
                        <input type="password" name="password"
                               class="w-full rounded border-gray-300">
                        @error('password')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

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
