<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Dokter
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <form action="{{ route('dokter.update', $dokter->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $dokter->name) }}"
                            class="w-full rounded border-gray-300">
                        @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium">Email</label>
                        <input type="text" name="email" value="{{ old('email', $dokter->email) }}"
                            class="w-full rounded border-gray-300">
                        @error('email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium">Password (kosongkan jika tidak diganti)</label>
                        <input type="password" name="password" class="w-full rounded border-gray-300">
                        @error('password')
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
