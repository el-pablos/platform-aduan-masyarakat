<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="p-2 hover:bg-neutral-100 rounded-lg transition-colors group">
                    <svg class="w-5 h-5 text-neutral-600 group-hover:text-neutral-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-neutral-900">
                    Detail Laporan
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success Alert -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 flex items-start space-x-3 animate-fadeIn">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="flex-shrink-0 text-green-600 hover:text-green-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content - Detail Laporan -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Status Update Card -->
                    <div class="bg-white border border-neutral-200 rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-3">
                                    <span class="text-sm font-medium text-neutral-600">Status Laporan:</span>
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-semibold
                                        @if($laporan->status === 'menunggu') bg-yellow-100 text-yellow-800 border border-yellow-200
                                        @elseif($laporan->status === 'diproses') bg-blue-100 text-blue-800 border border-blue-200
                                        @elseif($laporan->status === 'selesai') bg-green-100 text-green-800 border border-green-200
                                        @else bg-red-100 text-red-800 border border-red-200
                                        @endif">
                                        @if($laporan->status === 'menunggu')
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @elseif($laporan->status === 'diproses')
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                        @elseif($laporan->status === 'selesai')
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @endif
                                        {{ ucfirst($laporan->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Form Update Status -->
                            <form action="{{ route('admin.laporan.updateStatus', $laporan) }}" method="POST" class="bg-neutral-50 border border-neutral-200 rounded-lg p-4">
                                @csrf
                                @method('PATCH')
                                <div class="flex items-center space-x-3">
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-neutral-700 mb-2">Update Status</label>
                                        <select name="status" class="w-full border-neutral-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors">
                                            <option value="menunggu" {{ $laporan->status === 'menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                                            <option value="diproses" {{ $laporan->status === 'diproses' ? 'selected' : '' }}>🔄 Diproses</option>
                                            <option value="selesai" {{ $laporan->status === 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                            <option value="ditolak" {{ $laporan->status === 'ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="pt-7">
                                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-0.5">
                                            Update Status
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Laporan Detail Card -->
                    <div class="bg-white border border-neutral-200 rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6">
                            <!-- Judul -->
                            <h1 class="text-3xl font-bold text-neutral-900 mb-6">{{ $laporan->judul }}</h1>

                            <!-- Info Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                                <!-- Pelapor -->
                                <div class="bg-neutral-50 border border-neutral-200 rounded-lg p-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-medium text-neutral-500 uppercase tracking-wide mb-1">Pelapor</p>
                                            <p class="text-sm font-semibold text-neutral-900 truncate">{{ $laporan->user->name }}</p>
                                            <p class="text-xs text-neutral-600 truncate">{{ $laporan->user->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kategori -->
                                <div class="bg-neutral-50 border border-neutral-200 rounded-lg p-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-medium text-neutral-500 uppercase tracking-wide mb-1">Kategori</p>
                                            <p class="text-sm font-semibold text-neutral-900">{{ $laporan->kategori->nama }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Lokasi -->
                                <div class="bg-neutral-50 border border-neutral-200 rounded-lg p-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-pink-600 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-medium text-neutral-500 uppercase tracking-wide mb-1">Lokasi</p>
                                            <p class="text-sm font-semibold text-neutral-900">{{ $laporan->lokasi }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tanggal -->
                                <div class="bg-neutral-50 border border-neutral-200 rounded-lg p-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-medium text-neutral-500 uppercase tracking-wide mb-1">Tanggal Laporan</p>
                                            <p class="text-sm font-semibold text-neutral-900">{{ $laporan->created_at->format('d M Y') }}</p>
                                            <p class="text-xs text-neutral-600">{{ $laporan->created_at->format('H:i') }} WIB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Foto Bukti -->
                            @if($laporan->foto_bukti)
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold text-neutral-900 mb-3 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Foto Bukti
                                    </h3>
                                    <div class="border border-neutral-200 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                                        <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" alt="Foto Bukti" class="w-full h-auto">
                                    </div>
                                </div>
                            @endif

                            <!-- Isi Laporan -->
                            <div>
                                <h3 class="text-lg font-semibold text-neutral-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Deskripsi Laporan
                                </h3>
                                <div class="bg-neutral-50 border border-neutral-200 rounded-lg p-4">
                                    <p class="text-neutral-700 leading-relaxed whitespace-pre-line">{{ $laporan->isi_laporan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - Tanggapan -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Form Tanggapan -->
                    <div class="bg-white border border-neutral-200 rounded-xl shadow-sm overflow-hidden sticky top-6">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Tanggapan
                            </h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('admin.tanggapan.store', $laporan) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-neutral-700 mb-2">Isi Tanggapan</label>
                                    <textarea name="isi_tanggapan" rows="5" required placeholder="Tulis tanggapan Anda untuk laporan ini..."
                                        class="w-full border-neutral-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 resize-none"></textarea>
                                    @error('isi_tanggapan')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-0.5 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Kirim Tanggapan
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Riwayat Tanggapan -->
                    <div class="bg-white border border-neutral-200 rounded-xl shadow-sm overflow-hidden">
                        <div class="bg-neutral-50 border-b border-neutral-200 px-6 py-4">
                            <h3 class="text-lg font-semibold text-neutral-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Riwayat Tanggapan
                                <span class="ml-auto text-sm font-normal text-neutral-500">({{ $laporan->tanggapans->count() }})</span>
                            </h3>
                        </div>
                        <div class="p-6">
                            @if($laporan->tanggapans->count() > 0)
                                <div class="space-y-4 max-h-96 overflow-y-auto">
                                    @foreach($laporan->tanggapans as $index => $tanggapan)
                                        <div class="bg-neutral-50 border border-neutral-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                            <div class="flex items-start space-x-3 mb-3">
                                                <div class="flex-shrink-0">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                                        <span class="text-white font-semibold text-sm">{{ substr($tanggapan->user->name, 0, 1) }}</span>
                                                    </div>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-semibold text-neutral-900">{{ $tanggapan->user->name }}</p>
                                                    <p class="text-xs text-neutral-500 flex items-center mt-0.5">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        {{ $tanggapan->created_at->format('d M Y, H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <p class="text-sm text-neutral-700 leading-relaxed pl-13">{{ $tanggapan->isi_tanggapan }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg class="w-16 h-16 mx-auto text-neutral-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <p class="text-sm text-neutral-500 font-medium">Belum ada tanggapan</p>
                                    <p class="text-xs text-neutral-400 mt-1">Jadilah yang pertama memberikan tanggapan</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</x-app-layout>

