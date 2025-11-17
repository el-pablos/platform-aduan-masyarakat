<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Laporan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" id="laporanForm">
                        @csrf

                        <!-- Judul -->
                        <div class="mb-4">
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Laporan</label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('judul')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="kategori_id" id="kategori_id" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-4">
                            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                            <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('lokasi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Isi Laporan -->
                        <div class="mb-4">
                            <label for="isi_laporan" class="block text-sm font-medium text-gray-700 mb-2">Isi Laporan</label>
                            <textarea name="isi_laporan" id="isi_laporan" rows="5" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('isi_laporan') }}</textarea>
                            @error('isi_laporan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto Bukti -->
                        <div class="mb-6">
                            <label for="foto_bukti" class="block text-sm font-medium text-gray-700 mb-2">Foto Bukti (Opsional)</label>
                            <input type="file" name="foto_bukti" id="foto_bukti" accept="image/*"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                            @error('foto_bukti')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('laporan.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                Batal
                            </a>
                            <button type="submit" id="submitBtn" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Kirim Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Modal dengan Lottie -->
    <div id="loadingModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-1/2 -translate-y-1/2 mx-auto p-5 w-96">
            <div class="bg-white rounded-lg shadow-xl p-8 text-center">
                <dotlottie-wc 
                    src="https://lottie.host/embed/a7c3e0e4-3b5a-4c5a-8f5a-3b5a4c5a8f5a/3b5a4c5a8f.lottie" 
                    autoplay 
                    loop 
                    style="width: 200px; height: 200px; margin: 0 auto;">
                </dotlottie-wc>
                <p class="mt-4 text-lg font-semibold text-gray-700">Mengirim laporan...</p>
                <p class="mt-2 text-sm text-gray-500">Mohon tunggu sebentar</p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('laporanForm').addEventListener('submit', function() {
            document.getElementById('loadingModal').classList.remove('hidden');
            document.getElementById('submitBtn').disabled = true;
        });
    </script>
</x-app-layout>

