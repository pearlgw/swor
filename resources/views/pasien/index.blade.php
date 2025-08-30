<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Pasien
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('pasien.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                        + Tambah Pasien
                    </a>

                    <div class="flex">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pasien..."
                            class="px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                            id="searchInput" />
                    </div>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- TABLE dibungkus supaya gampang di-replace --}}
                <div id="tableContainer">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-2">Kode Pasien</th>
                                <th class="p-2">Nama</th>
                                <th class="p-2">Umur</th>
                                <th class="p-2">Metode</th>
                                <th class="p-2">Diagnosa Utama</th>
                                <th class="p-2">Tanggal Mulai Terapi</th>
                                <th class="p-2">Dokter</th>
                                <th class="p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pasiens as $pasien)
                                <tr class="border-b">
                                    <td class="p-2">{{ $pasien->kode_pasien }}</td>
                                    <td class="p-2">{{ $pasien->nama }}</td>
                                    <td class="p-2">{{ $pasien->umur ?? '-' }}</td>
                                    <td class="p-2">{{ $pasien->metode ?? '-' }}</td>
                                    <td class="p-2">{{ $pasien->diagnosa_utama ?? '-' }}</td>
                                    <td class="p-2">
                                        {{ $pasien->tanggal_mulai_terapi ? $pasien->tanggal_mulai_terapi->format('d-m-Y') : '-' }}
                                    </td>
                                    <td class="p-2">{{ $pasien->user?->name ?? '-' }}</td>
                                    <td class="p-2">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('pasien.edit', $pasien->id) }}"
                                                class="px-3 py-1 bg-yellow-500 text-white rounded-lg text-sm">
                                                Edit
                                            </a>
                                            <a href="{{ route('pasien.show', $pasien->id) }}"
                                                class="px-3 py-1 bg-blue-500 text-white rounded-lg text-sm">
                                                Show
                                            </a>
                                            <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus pasien ini?')">
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
                                    <td class="p-4 text-center text-gray-500" colspan="8">
                                        Data pasien belum ada
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $pasiens->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let timeout = null;
        const input = document.getElementById('searchInput');
        const tableContainer = document.getElementById('tableContainer');

        // Realtime search
        input.addEventListener('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                fetch(`{{ route('pasien.index') }}?search=${input.value}`)
                    .then(res => res.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newTable = doc.querySelector('#tableContainer').innerHTML;
                        tableContainer.innerHTML = newTable;
                    });
            }, 400);
        });

        // Pagination Ajax
        document.addEventListener('click', function(e) {
            if (e.target.closest('#tableContainer .pagination a')) {
                e.preventDefault();
                fetch(e.target.href)
                    .then(res => res.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newTable = doc.querySelector('#tableContainer').innerHTML;
                        tableContainer.innerHTML = newTable;
                    });
            }
        });
    </script>
</x-app-layout>
