<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Laporan') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-800">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Detail Laporan -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <!-- Status & Update Status -->
                            <div class="mb-6 flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($laporan->status === 'menunggu') bg-yellow-100 text-yellow-800
                                    @elseif($laporan->status === 'diproses') bg-blue-100 text-blue-800
                                    @elseif($laporan->status === 'selesai') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    Status: {{ ucfirst($laporan->status) }}
                                </span>

                                <!-- Form Update Status -->
                                <form action="{{ route('admin.laporan.updateStatus', $laporan) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="menunggu" {{ $laporan->status === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="diproses" {{ $laporan->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="selesai" {{ $laporan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="ditolak" {{ $laporan->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <button type="submit" class="px-3 py-1 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                                        Update
                                    </button>
                                </form>
                            </div>

                            <!-- Judul -->
                            <h1 class="text-3xl font-bold mb-4">{{ $laporan->judul }}</h1>

                            <!-- Info -->
                            <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                                <div>
                                    <span class="font-semibold text-gray-600">Pelapor:</span>
                                    <span class="ml-2">{{ $laporan->user->name }}</span>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-600">Email:</span>
                                    <span class="ml-2">{{ $laporan->user->email }}</span>
                                </div>
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
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Form Tanggapan & Riwayat -->
                <div class="lg:col-span-1">
                    <!-- Form Tanggapan -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <h3 class="font-semibold text-lg mb-4">Tambah Tanggapan</h3>
                            <form action="{{ route('admin.tanggapan.store', $laporan) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <textarea name="isi_tanggapan" rows="4" required placeholder="Tulis tanggapan Anda..."
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                    @error('isi_tanggapan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                    Kirim Tanggapan
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Riwayat Tanggapan -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="font-semibold text-lg mb-4">Riwayat Tanggapan</h3>
                            @if($laporan->tanggapans->count() > 0)
                                <div class="space-y-4">
                                    @foreach($laporan->tanggapans as $tanggapan)
                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <div class="mb-2">
                                                <p class="font-semibold text-sm text-gray-900">{{ $tanggapan->user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $tanggapan->created_at->format('d M Y, H:i') }}</p>
                                            </div>
                                            <p class="text-sm text-gray-700">{{ $tanggapan->isi_tanggapan }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">Belum ada tanggapan</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

