<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('laporan.show', $laporan) }}" class="p-2 hover:bg-neutral-100 rounded-lg transition-colors">
                <svg class="w-6 h-6 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-neutral-900 tracking-tight">
                    Edit Laporan
                </h2>
                <p class="text-sm text-neutral-600 mt-1">Perbarui informasi laporan Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Info Card -->
            <div class="mb-6 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-5 flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-semibold text-blue-900 mb-1">Tips Mengupdate Laporan</h3>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Pastikan informasi yang diubah tetap akurat</li>
                        <li>• Upload foto baru jika ada perubahan kondisi</li>
                        <li>• Lokasi harus tetap spesifik dan jelas</li>
                    </ul>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white border border-neutral-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('laporan.update', $laporan) }}" method="POST" enctype="multipart/form-data" id="laporanForm" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Judul -->
                        <div>
                            <label for="judul" class="block text-sm font-semibold text-neutral-900 mb-2">
                                Judul Laporan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul', $laporan->judul) }}" required
                                placeholder="Contoh: Jalan Berlubang di Jl. Sudirman"
                                class="w-full px-4 py-3 border border-neutral-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all @error('judul') border-red-500 @enderror">
                            @error('judul')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori_id" class="block text-sm font-semibold text-neutral-900 mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="kategori_id" id="kategori_id" required
                                class="w-full px-4 py-3 border border-neutral-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all @error('kategori_id') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $laporan->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label for="lokasi" class="block text-sm font-semibold text-neutral-900 mb-2">
                                Lokasi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $laporan->lokasi) }}" required
                                placeholder="Contoh: Jl. Sudirman No. 123, Jakarta Pusat"
                                class="w-full px-4 py-3 border border-neutral-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all @error('lokasi') border-red-500 @enderror">
                            @error('lokasi')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Isi Laporan -->
                        <div>
                            <label for="isi_laporan" class="block text-sm font-semibold text-neutral-900 mb-2">
                                Deskripsi Laporan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="isi_laporan" id="isi_laporan" rows="6" required
                                placeholder="Jelaskan masalah yang Anda laporkan secara detail..."
                                class="w-full px-4 py-3 border border-neutral-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all resize-none @error('isi_laporan') border-red-500 @enderror">{{ old('isi_laporan', $laporan->isi_laporan) }}</textarea>
                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-xs text-neutral-500">Minimal 10 karakter</p>
                                <p class="text-xs text-neutral-500">
                                    <span id="charCount">0</span> karakter
                                </p>
                            </div>
                            @error('isi_laporan')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>




                        <!-- Foto Bukti -->
                        <div>
                            <label for="foto_bukti" class="block text-sm font-semibold text-neutral-900 mb-2">
                                Foto Bukti (Opsional)
                            </label>

                            @if($laporan->foto_bukti)
                                <div class="mb-4 relative group">
                                    <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" alt="Foto saat ini"
                                        class="w-full h-64 object-cover rounded-xl border border-neutral-200">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                        <p class="text-white text-sm font-medium">Foto saat ini</p>
                                    </div>
                                </div>
                                <p class="text-sm text-neutral-600 mb-3">Upload foto baru untuk mengganti foto saat ini</p>
                            @endif

                            <div class="relative">
                                <input type="file" name="foto_bukti" id="foto_bukti" accept="image/*"
                                    class="hidden" onchange="previewImage(event)">
                                <label for="foto_bukti"
                                    class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-neutral-300 rounded-xl cursor-pointer bg-neutral-50 hover:bg-neutral-100 transition-all group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-12 h-12 mb-3 text-neutral-400 group-hover:text-neutral-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="mb-2 text-sm text-neutral-600 font-medium">
                                            <span class="text-blue-600">Klik untuk upload</span> atau drag & drop
                                        </p>
                                        <p class="text-xs text-neutral-500">PNG, JPG, JPEG (Max. 2MB)</p>
                                    </div>
                                </label>
                            </div>

                            <!-- Image Preview -->
                            <div id="imagePreview" class="hidden mt-4 relative">
                                <img id="preview" src="" alt="Preview" class="w-full h-64 object-cover rounded-xl border border-neutral-200">
                                <button type="button" onclick="removeImage()"
                                    class="absolute top-3 right-3 bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg shadow-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            @error('foto_bukti')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-neutral-200">
                            <a href="{{ route('laporan.show', $laporan) }}"
                                class="px-6 py-3 bg-white border border-neutral-300 text-neutral-700 font-medium rounded-xl hover:bg-neutral-50 transition-all shadow-sm">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Update Laporan
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Modal -->
    <div id="loadingModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl p-8 max-w-sm mx-4 text-center shadow-2xl">
            <div class="mb-4">
                <dotlottie-wc src="https://lottie.host/embed/a7d3e5e6-9e4f-4e5e-8e5e-5e5e5e5e5e5e/loading.json"
                    autoplay loop style="width: 120px; height: 120px; margin: 0 auto;">
                </dotlottie-wc>
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 mb-2">Mengupdate Laporan...</h3>
            <p class="text-sm text-neutral-600">Mohon tunggu sebentar</p>
        </div>
    </div>

    <script>
        // Character counter
        const textarea = document.getElementById('isi_laporan');
        const charCount = document.getElementById('charCount');

        function updateCharCount() {
            charCount.textContent = textarea.value.length;
        }

        textarea.addEventListener('input', updateCharCount);
        updateCharCount(); // Initial count

        // Image preview
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB');
                    event.target.value = '';
                    return;
                }

                // Validate file type
                if (!file.type.match('image.*')) {
                    alert('File harus berupa gambar!');
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function removeImage() {
            document.getElementById('foto_bukti').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('preview').src = '';
        }

        // Show loading modal on form submit
        document.getElementById('laporanForm').addEventListener('submit', function() {
            document.getElementById('loadingModal').classList.remove('hidden');
        });

        // Drag and drop
        const dropZone = document.querySelector('label[for="foto_bukti"]');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('border-blue-500', 'bg-blue-50');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('border-blue-500', 'bg-blue-50');
            }, false);
        });

        dropZone.addEventListener('drop', function(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            document.getElementById('foto_bukti').files = files;

            // Trigger preview
            const event = new Event('change');
            document.getElementById('foto_bukti').dispatchEvent(event);
        }, false);
    </script>
</x-app-layout>
