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
                    Buat Laporan Baru
                </h2>
                <p class="text-sm text-neutral-600 mt-1">Laporkan masalah publik di sekitar Anda</p>
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
                    <h3 class="text-sm font-semibold text-blue-900 mb-1">Tips Membuat Laporan</h3>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Berikan judul yang jelas dan deskriptif</li>
                        <li>• Sertakan lokasi yang spesifik</li>
                        <li>• Upload foto bukti untuk mempercepat proses</li>
                    </ul>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white border border-neutral-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" id="laporanForm" class="space-y-6">
                        @csrf

                        <!-- Judul -->
                        <div>
                            <label for="judul" class="block text-sm font-semibold text-neutral-900 mb-2">
                                Judul Laporan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
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
                            <div class="relative">
                                <select name="kategori_id" id="kategori_id" required
                                    class="w-full px-4 py-3 border border-neutral-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none @error('kategori_id') border-red-500 @enderror">
                                    <option value="">Pilih Kategori Masalah</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
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
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" required
                                    placeholder="Contoh: Jl. Sudirman No. 123, Jakarta Pusat"
                                    class="w-full pl-12 pr-4 py-3 border border-neutral-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all @error('lokasi') border-red-500 @enderror">
                            </div>
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
                                Deskripsi Masalah <span class="text-red-500">*</span>
                            </label>
                            <textarea name="isi_laporan" id="isi_laporan" rows="6" required
                                placeholder="Jelaskan masalah yang Anda laporkan secara detail..."
                                class="w-full px-4 py-3 border border-neutral-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all resize-none @error('isi_laporan') border-red-500 @enderror">{{ old('isi_laporan') }}</textarea>
                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-xs text-neutral-500">Minimal 20 karakter</p>
                                <p class="text-xs text-neutral-500" id="charCount">0 karakter</p>
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
                                Foto Bukti <span class="text-neutral-500 font-normal">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <input type="file" name="foto_bukti" id="foto_bukti" accept="image/*" class="hidden">
                                <div id="fileUploadArea" class="border-2 border-dashed border-neutral-300 rounded-xl p-8 text-center hover:border-blue-400 hover:bg-blue-50/50 transition-all cursor-pointer">
                                    <div id="uploadPlaceholder">
                                        <svg class="mx-auto w-12 h-12 text-neutral-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="text-sm font-medium text-neutral-700 mb-1">Klik untuk upload foto</p>
                                        <p class="text-xs text-neutral-500">PNG, JPG, GIF hingga 2MB</p>
                                    </div>
                                    <div id="imagePreview" class="hidden">
                                        <img id="previewImg" src="" alt="Preview" class="max-h-48 mx-auto rounded-lg mb-3">
                                        <p class="text-sm font-medium text-neutral-700" id="fileName"></p>
                                        <button type="button" id="removeImage" class="mt-2 text-sm text-red-600 hover:text-red-700 font-medium">
                                            Hapus Foto
                                        </button>
                                    </div>
                                </div>
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

                        <!-- Buttons -->
                        <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 pt-6 border-t border-neutral-200">
                            <a href="{{ route('laporan.index') }}" class="w-full sm:w-auto px-6 py-3 text-center border border-neutral-300 rounded-xl text-neutral-700 font-medium hover:bg-neutral-50 transition-all">
                                Batal
                            </a>
                            <button type="submit" id="submitBtn" class="w-full sm:w-auto group inline-flex items-center justify-center px-6 py-3 text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 rounded-xl shadow-sm hover:shadow-md font-medium transition-all duration-200 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Loading Modal dengan Lottie - Modern Design -->
    <div id="loadingModal" class="hidden fixed inset-0 bg-neutral-900/50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm mx-4 text-center transform transition-all">
            <dotlottie-wc
                src="https://lottie.host/embed/a7c3e0e4-3b5a-4c5a-8f5a-3b5a4c5a8f5a/3b5a4c5a8f.lottie"
                autoplay
                loop
                style="width: 200px; height: 200px; margin: 0 auto;">
            </dotlottie-wc>
            <h3 class="mt-4 text-lg font-bold text-neutral-900">Mengirim Laporan...</h3>
            <p class="mt-2 text-sm text-neutral-600">Mohon tunggu sebentar, laporan Anda sedang diproses</p>
            <div class="mt-4 flex items-center justify-center space-x-1">
                <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
            </div>
        </div>
    </div>

    <script>
        // Form submission with loading modal
        document.getElementById('laporanForm').addEventListener('submit', function() {
            document.getElementById('loadingModal').classList.remove('hidden');
            document.getElementById('submitBtn').disabled = true;
        });

        // Character counter for textarea
        const textarea = document.getElementById('isi_laporan');
        const charCount = document.getElementById('charCount');

        textarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count + ' karakter';

            if (count < 20) {
                charCount.classList.add('text-red-500');
                charCount.classList.remove('text-neutral-500');
            } else {
                charCount.classList.remove('text-red-500');
                charCount.classList.add('text-neutral-500');
            }
        });

        // File upload preview
        const fileInput = document.getElementById('foto_bukti');
        const fileUploadArea = document.getElementById('fileUploadArea');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const fileName = document.getElementById('fileName');
        const removeImageBtn = document.getElementById('removeImage');

        fileUploadArea.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    fileInput.value = '';
                    return;
                }

                // Validate file type
                if (!file.type.match('image.*')) {
                    alert('File harus berupa gambar (PNG, JPG, GIF).');
                    fileInput.value = '';
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    fileName.textContent = file.name;
                    uploadPlaceholder.classList.add('hidden');
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        removeImageBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            fileInput.value = '';
            uploadPlaceholder.classList.remove('hidden');
            imagePreview.classList.add('hidden');
            previewImg.src = '';
            fileName.textContent = '';
        });

        // Prevent default drag and drop
        fileUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('border-blue-500', 'bg-blue-50');
        });

        fileUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-500', 'bg-blue-50');
        });

        fileUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-500', 'bg-blue-50');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>

