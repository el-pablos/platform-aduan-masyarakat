<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Laporan') }}
            </h2>
            <a href="{{ route('laporan.index') }}" class="text-indigo-600 hover:text-indigo-800">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Status Badge -->
                    <div class="mb-6">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            @if($laporan->status === 'menunggu') bg-yellow-100 text-yellow-800
                            @elseif($laporan->status === 'diproses') bg-blue-100 text-blue-800
                            @elseif($laporan->status === 'selesai') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            Status: {{ ucfirst($laporan->status) }}
                        </span>
                    </div>

                    <!-- Judul -->
                    <h1 class="text-3xl font-bold mb-4">{{ $laporan->judul }}</h1>

                    <!-- Info -->
                    <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                        <div>
                            <span class="font-semibold text-gray-600">Kategori:</span>
                            <span class="ml-2">{{ $laporan->kategori->nama }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-600">Lokasi:</span>
                            <span class="ml-2">{{ $laporan->lokasi }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-600">Tanggal:</span>
                            <span class="ml-2">{{ $laporan->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>

                    <!-- Foto Bukti -->
                    @if($laporan->foto_bukti)
                        <div class="mb-6">
                            <h3 class="font-semibold text-lg mb-2">Foto Bukti</h3>
                            <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" alt="Foto Bukti" class="max-w-full h-auto rounded-lg shadow-md">
                        </div>
                    @endif

                    <!-- Isi Laporan -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-lg mb-2">Isi Laporan</h3>
                        <p class="text-gray-700 whitespace-pre-line">{{ $laporan->isi_laporan }}</p>
                    </div>

                    <!-- Tanggapan -->
                    @if($laporan->tanggapans->count() > 0)
                        <div class="border-t pt-6">
                            <h3 class="font-semibold text-lg mb-4">Tanggapan dari Petugas</h3>
                            <div class="space-y-4">
                                @foreach($laporan->tanggapans as $tanggapan)
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-start justify-between mb-2">
                                            <div>
                                                <p class="font-semibold text-gray-900">{{ $tanggapan->user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $tanggapan->created_at->format('d M Y, H:i') }}</p>
                                            </div>
                                        </div>
                                        <p class="text-gray-700">{{ $tanggapan->isi_tanggapan }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="border-t pt-6">
                            <div class="text-center py-8 bg-gray-50 rounded-lg">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">Belum ada tanggapan dari petugas</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

