<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-neutral-900 tracking-tight">
                Dashboard Admin
            </h2>
            <p class="text-sm text-neutral-600 mt-1">Kelola semua laporan masuk dari warga</p>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success Alert -->
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

            <!-- Filter Card -->
            <div class="mb-6 bg-white border border-neutral-200 rounded-xl shadow-sm p-6">
                <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <label for="status" class="text-sm font-semibold text-neutral-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter Status:
                    </label>
                    <div class="flex-1 flex items-center gap-3">
                        <div class="relative flex-1 max-w-xs">
                            <select name="status" id="status" class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none">
                                <option value="">Semua Status</option>
                                <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-xl shadow-sm hover:shadow-md font-medium transition-all duration-200 transform hover:-translate-y-0.5">
                            Terapkan Filter
                        </button>
                        @if(request('status'))
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2.5 border border-neutral-300 rounded-xl text-neutral-700 font-medium hover:bg-neutral-50 transition-all">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>


            <!-- Table Card -->
            <div class="bg-white border border-neutral-200 rounded-2xl shadow-sm overflow-hidden">
                @if($laporans->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-neutral-200">
                            <thead class="bg-neutral-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">
                                        Judul Laporan
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">
                                        Pelapor
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">
                                        Kategori
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">
                                        Lokasi
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-neutral-200">
                                @foreach($laporans as $laporan)
                                    <tr class="hover:bg-neutral-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if($laporan->foto_bukti)
                                                    <div class="flex-shrink-0 h-10 w-10 mr-3">
                                                        <img class="h-10 w-10 rounded-lg object-cover border border-neutral-200" src="{{ asset('storage/' . $laporan->foto_bukti) }}" alt="">
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="text-sm font-semibold text-neutral-900">{{ Str::limit($laporan->judul, 40) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-xs font-semibold mr-2">
                                                    {{ substr($laporan->user->name, 0, 1) }}
                                                </div>
                                                <div class="text-sm text-neutral-900">{{ $laporan->user->name }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center text-sm text-neutral-900">
                                                <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                </svg>
                                                {{ $laporan->kategori->nama }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-neutral-900 max-w-xs truncate">{{ $laporan->lokasi }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold
                                                @if($laporan->status === 'menunggu') bg-yellow-100 text-yellow-800 border border-yellow-200
                                                @elseif($laporan->status === 'diproses') bg-blue-100 text-blue-800 border border-blue-200
                                                @elseif($laporan->status === 'selesai') bg-green-100 text-green-800 border border-green-200
                                                @else bg-red-100 text-red-800 border border-red-200
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
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-600">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-neutral-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $laporan->created_at->format('d/m/Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.laporan.show', $laporan) }}" class="inline-flex items-center px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition-colors">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-neutral-100 rounded-2xl mb-6">
                            <svg class="w-10 h-10 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-neutral-900 mb-2">Tidak Ada Laporan</h3>
                        <p class="text-neutral-600">
                            @if(request('status'))
                                Tidak ada laporan dengan status "{{ ucfirst(request('status')) }}".
                            @else
                                Belum ada laporan yang masuk dari warga.
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

