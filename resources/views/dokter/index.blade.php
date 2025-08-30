<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Dokter
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('dokter.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                        + Tambah Dokter
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-2">Nama</th>
                            <th class="p-2">Email</th>
                            <th class="p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dokters as $dokter)
                            <tr class="border-b">
                                <td class="p-2">{{ $dokter->name }}</td>
                                <td class="p-2">{{ $dokter->email }}</td>
                                <td class="p-2">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('dokter.edit', $dokter->id) }}"
                                            class="px-3 py-1 bg-yellow-500 text-white rounded-lg text-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus dokter ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-600 text-white rounded-lg text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-4 text-center text-gray-500" colspan="5">
                                    Data belum ada
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $dokters->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
