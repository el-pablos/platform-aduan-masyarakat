<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-neutral-900 tracking-tight">
                    Dashboard Laporan
                </h2>
                <p class="text-sm text-neutral-600 mt-1">Kelola dan pantau semua laporan Anda</p>
            </div>
            <a href="{{ route('laporan.create') }}" class="group inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Laporan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success Alert with Modern Design -->
            @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 flex items-start space-x-3 shadow-sm animate-fadeInUp">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-green-900">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="flex-shrink-0 text-green-600 hover:text-green-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Statistics Cards -->
            @if($laporans->count() > 0)
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <!-- Total Laporan -->
                    <div class="bg-white border border-neutral-200 rounded-xl p-5 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-neutral-600">Total Laporan</p>
                                <p class="text-2xl font-bold text-neutral-900 mt-1">{{ $laporans->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Menunggu -->
                    <div class="bg-white border border-neutral-200 rounded-xl p-5 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-neutral-600">Menunggu</p>
                                <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $laporans->where('status', 'menunggu')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Diproses -->
                    <div class="bg-white border border-neutral-200 rounded-xl p-5 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-neutral-600">Diproses</p>
                                <p class="text-2xl font-bold text-blue-600 mt-1">{{ $laporans->where('status', 'diproses')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Selesai -->
                    <div class="bg-white border border-neutral-200 rounded-xl p-5 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-neutral-600">Selesai</p>
                                <p class="text-2xl font-bold text-green-600 mt-1">{{ $laporans->where('status', 'selesai')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Laporan Cards Grid -->
            <div class="bg-white border border-neutral-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 sm:p-8">
                    @if($laporans->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($laporans as $laporan)
                                <div class="group bg-white border border-neutral-200 rounded-xl overflow-hidden hover:shadow-xl hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                                    <!-- Image -->
                                    @if($laporan->foto_bukti)
                                        <div class="relative h-48 overflow-hidden bg-neutral-100">
                                            <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" alt="Foto Bukti" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            <!-- Status Badge on Image -->
                                            <div class="absolute top-3 right-3">
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold backdrop-blur-sm
                                                    @if($laporan->status === 'menunggu') bg-yellow-100/90 text-yellow-800 border border-yellow-200
                                                    @elseif($laporan->status === 'diproses') bg-blue-100/90 text-blue-800 border border-blue-200
                                                    @elseif($laporan->status === 'selesai') bg-green-100/90 text-green-800 border border-green-200
                                                    @else bg-red-100/90 text-red-800 border border-red-200
                                                    @endif">
                                                    @if($laporan->status === 'menunggu')
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @elseif($laporan->status === 'diproses')
                                                        <svg class="w-3 h-3 mr-1 animate-spin" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @elseif($laporan->status === 'selesai')
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @else
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @endif
                                                    {{ ucfirst($laporan->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="relative h-48 bg-gradient-to-br from-neutral-100 to-neutral-200 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <!-- Status Badge -->
                                            <div class="absolute top-3 right-3">
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold
                                                    @if($laporan->status === 'menunggu') bg-yellow-100 text-yellow-800 border border-yellow-200
                                                    @elseif($laporan->status === 'diproses') bg-blue-100 text-blue-800 border border-blue-200
                                                    @elseif($laporan->status === 'selesai') bg-green-100 text-green-800 border border-green-200
                                                    @else bg-red-100 text-red-800 border border-red-200
                                                    @endif">
                                                    {{ ucfirst($laporan->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Content -->
                                    <div class="p-5">
                                        <h3 class="font-bold text-lg text-neutral-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                            {{ $laporan->judul }}
                                        </h3>

                                        <div class="space-y-2 mb-4">
                                            <div class="flex items-center text-sm text-neutral-600">
                                                <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                </svg>
                                                <span class="font-medium">{{ $laporan->kategori->nama }}</span>
                                            </div>
                                            <div class="flex items-start text-sm text-neutral-600">
                                                <svg class="w-4 h-4 mr-2 mt-0.5 text-neutral-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <span class="line-clamp-1">{{ $laporan->lokasi }}</span>
                                            </div>
                                            <div class="flex items-center text-sm text-neutral-600">
                                                <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span>{{ $laporan->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>

                                        <a href="{{ route('laporan.show', $laporan) }}" class="group/link inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                                            Lihat Detail
                                            <svg class="w-4 h-4 ml-1 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-neutral-100 rounded-2xl mb-6">
                                <svg class="w-10 h-10 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-neutral-900 mb-2">Belum Ada Laporan</h3>
                            <p class="text-neutral-600 mb-8 max-w-sm mx-auto">
                                Anda belum membuat laporan apapun. Mulai laporkan masalah publik di sekitar Anda sekarang.
                            </p>
                            <a href="{{ route('laporan.create') }}" class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Buat Laporan Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

