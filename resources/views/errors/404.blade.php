<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Lapor Cepat</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Lottie -->
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-fadeInUp-delay-1 {
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        .animate-fadeInUp-delay-2 {
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</head>
<body class="bg-neutral-50 antialiased">
    <!-- Background Decorative Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 right-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-40 left-0 w-96 h-96 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-20 left-1/2 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full">
            <div class="text-center">
                <!-- Logo -->
                <div class="flex justify-center mb-8 animate-fadeInUp">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:shadow-blue-500/50 transition-shadow">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-semibold text-neutral-900 tracking-tight">Lapor Cepat</span>
                    </a>
                </div>

                <!-- Lottie Animation -->
                <div class="mb-8 animate-float">
                    <dotlottie-wc
                        src="https://lottie.host/d7e8e0e4-3b5a-4c5a-8f5a-3b5a4c5a8f5a/3b5a4c5a8f.lottie"
                        autoplay
                        loop
                        style="width: 100%; max-width: 400px; height: auto; margin: 0 auto;">
                    </dotlottie-wc>
                </div>

                <!-- Error Code -->
                <div class="mb-6 animate-fadeInUp">
                    <h1 class="text-8xl sm:text-9xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                        404
                    </h1>
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-red-50 border border-red-200 mb-4">
                        <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span class="text-sm font-medium text-red-700">Halaman Tidak Ditemukan</span>
                    </div>
                </div>

                <!-- Message -->
                <div class="mb-8 animate-fadeInUp-delay-1">
                    <h2 class="text-2xl sm:text-3xl font-bold text-neutral-900 mb-3">
                        Oops! Halaman Tidak Ditemukan
                    </h2>
                    <p class="text-lg text-neutral-600 max-w-2xl mx-auto leading-relaxed">
                        Maaf, halaman yang Anda cari tidak dapat ditemukan. Halaman mungkin telah dipindahkan, dihapus, atau URL yang Anda masukkan salah.
                    </p>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fadeInUp-delay-2">
                    <a href="{{ url('/') }}" class="group inline-flex items-center justify-center px-6 py-3.5 text-base font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>

                    <button onclick="window.history.back()" class="inline-flex items-center justify-center px-6 py-3.5 text-base font-medium text-neutral-700 bg-white hover:bg-neutral-50 border border-neutral-300 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Halaman Sebelumnya
                    </button>
                </div>

                <!-- Help Links -->
                <div class="mt-12 pt-8 border-t border-neutral-200 animate-fadeInUp-delay-2">
                    <p class="text-sm text-neutral-500 mb-4">Butuh bantuan? Coba halaman berikut:</p>
                    <div class="flex flex-wrap justify-center gap-4">
                        @auth
                            @if(auth()->user()->role === 'warga')
                                <a href="{{ route('laporan.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:underline">
                                    Dashboard Saya
                                </a>
                                <span class="text-neutral-300">•</span>
                                <a href="{{ route('laporan.create') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:underline">
                                    Buat Laporan
                                </a>
                            @else
                                <a href="{{ route('admin.dashboard') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:underline">
                                    Dashboard Admin
                                </a>
                            @endif
                            <span class="text-neutral-300">•</span>
                            <a href="{{ route('profile.edit') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:underline">
                                Profile
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:underline">
                                Masuk
                            </a>
                            <span class="text-neutral-300">•</span>
                            <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:underline">
                                Daftar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

