<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('laporan.index') }}" class="p-2 hover:bg-neutral-100 rounded-lg transition-colors">
                <svg class="w-6 h-6 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-neutral-900 tracking-tight">
                    Detail Laporan
                </h2>
                <p class="text-sm text-neutral-600 mt-1">Informasi lengkap laporan Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main Card -->
            <div class="bg-white border border-neutral-200 rounded-2xl shadow-sm overflow-hidden">
                <!-- Header Section -->
                <div class="p-6 sm:p-8 border-b border-neutral-200">
                    <!-- Status Badge -->
                    <div class="mb-6">
                        <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold
                            @if($laporan->status === 'menunggu') bg-yellow-100 text-yellow-800 border border-yellow-200
                            @elseif($laporan->status === 'diproses') bg-blue-100 text-blue-800 border border-blue-200
                            @elseif($laporan->status === 'selesai') bg-green-100 text-green-800 border border-green-200
                            @else bg-red-100 text-red-800 border border-red-200
                            @endif">
                            @if($laporan->status === 'menunggu')
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                            @elseif($laporan->status === 'diproses')
                                <svg class="w-4 h-4 mr-2 animate-spin" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                                </svg>
                            @elseif($laporan->status === 'selesai')
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            @else
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                            Status: {{ ucfirst($laporan->status) }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl font-bold text-neutral-900 mb-6 leading-tight">{{ $laporan->judul }}</h1>

                    <!-- Info Grid -->
                    <div class="grid sm:grid-cols-3 gap-4">
                        <div class="flex items-start space-x-3 p-4 bg-neutral-50 rounded-xl">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-neutral-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium text-neutral-500 mb-1">Kategori</p>
                                <p class="text-sm font-semibold text-neutral-900">{{ $laporan->kategori->nama }}</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3 p-4 bg-neutral-50 rounded-xl">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-neutral-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium text-neutral-500 mb-1">Lokasi</p>
                                <p class="text-sm font-semibold text-neutral-900 truncate">{{ $laporan->lokasi }}</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3 p-4 bg-neutral-50 rounded-xl">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-neutral-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium text-neutral-500 mb-1">Tanggal Laporan</p>
                                <p class="text-sm font-semibold text-neutral-900">{{ $laporan->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-6 sm:p-8 space-y-8">
                    <!-- Foto Bukti -->
                    @if($laporan->foto_bukti)
                        <div>
                            <h3 class="text-lg font-bold text-neutral-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Foto Bukti
                            </h3>
                            <div class="relative rounded-xl overflow-hidden border border-neutral-200 shadow-sm group">
                                <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" alt="Foto Bukti" class="w-full h-auto">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                            </div>
                        </div>
                    @endif

                    <!-- Isi Laporan -->
                    <div>
                        <h3 class="text-lg font-bold text-neutral-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Deskripsi Masalah
                        </h3>
                        <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
                            <p class="text-neutral-700 leading-relaxed whitespace-pre-line">{{ $laporan->isi_laporan }}</p>
                        </div>
                    </div>

                    <!-- Tanggapan Section -->
                    <div class="border-t border-neutral-200 pt-8">
                        <h3 class="text-lg font-bold text-neutral-900 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Tanggapan Petugas
                            @if($laporan->tanggapans->count() > 0)
                                <span class="ml-2 px-2.5 py-0.5 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                                    {{ $laporan->tanggapans->count() }}
                                </span>
                            @endif
                        </h3>

                        @if($laporan->tanggapans->count() > 0)
                            <div class="space-y-4">
                                @foreach($laporan->tanggapans as $tanggapan)
                                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
                                        <div class="flex items-start space-x-4">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold">
                                                    {{ substr($tanggapan->user->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between mb-2">
                                                    <div>
                                                        <p class="font-semibold text-neutral-900">{{ $tanggapan->user->name }}</p>
                                                        <p class="text-xs text-neutral-600 flex items-center mt-1">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            {{ $tanggapan->created_at->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full border border-blue-200">
                                                        {{ ucfirst($tanggapan->user->role) }}
                                                    </span>
                                                </div>
                                                <p class="text-neutral-700 leading-relaxed">{{ $tanggapan->isi_tanggapan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12 bg-neutral-50 rounded-xl border-2 border-dashed border-neutral-300">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-neutral-100 rounded-full mb-4">
                                    <svg class="w-8 h-8 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-sm font-semibold text-neutral-900 mb-1">Belum Ada Tanggapan</h4>
                                <p class="text-sm text-neutral-600">Petugas akan segera menanggapi laporan Anda</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

