<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Laporan Saya') }}
            </h2>
            <a href="{{ route('laporan.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                Buat Laporan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($laporans->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($laporans as $laporan)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition">
                                    @if($laporan->foto_bukti)
                                        <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" alt="Foto Bukti" class="w-full h-48 object-cover rounded-md mb-4">
                                    @endif
                                    <h3 class="font-bold text-lg mb-2">{{ $laporan->judul }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">
                                        <span class="font-semibold">Kategori:</span> {{ $laporan->kategori->nama }}
                                    </p>
                                    <p class="text-sm text-gray-600 mb-2">
                                        <span class="font-semibold">Lokasi:</span> {{ $laporan->lokasi }}
                                    </p>
                                    <p class="text-sm text-gray-600 mb-4">
                                        <span class="font-semibold">Status:</span> 
                                        <span class="px-2 py-1 rounded text-xs font-semibold
                                            @if($laporan->status === 'menunggu') bg-yellow-100 text-yellow-800
                                            @elseif($laporan->status === 'diproses') bg-blue-100 text-blue-800
                                            @elseif($laporan->status === 'selesai') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($laporan->status) }}
                                        </span>
                                    </p>
                                    <a href="{{ route('laporan.show', $laporan) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                                        Lihat Detail →
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada laporan</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat laporan baru.</p>
                            <div class="mt-6">
                                <a href="{{ route('laporan.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Buat Laporan
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

