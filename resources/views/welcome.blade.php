<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lapor Cepat - Layanan Publik Digital</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Lottie -->
        <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', system-ui, -apple-system, sans-serif;
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
                animation: fadeInUp 0.6s ease-out 0.1s both;
            }

            .animate-fadeInUp-delay-2 {
                animation: fadeInUp 0.6s ease-out 0.2s both;
            }

            .animate-fadeInUp-delay-3 {
                animation: fadeInUp 0.6s ease-out 0.3s both;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }

            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
        </style>
    </head>
    <body class="antialiased bg-neutral-50">
        <!-- Navbar - Modern Minimalist with Glassmorphism -->
        <nav class="fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-md border-b border-neutral-200 z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                        <h1 class="text-xl font-semibold text-neutral-900 tracking-tight">Lapor Cepat</h1>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-2">
                        @auth
                            @if(auth()->user()->role === 'warga')
                                <a href="{{ route('laporan.index') }}" class="px-4 py-2 text-sm font-medium text-neutral-700 hover:text-neutral-900 hover:bg-neutral-100 rounded-lg transition-all duration-200">
                                    Dashboard
                                </a>
                                <a href="{{ route('laporan.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                    Buat Laporan
                                </a>
                            @elseif(auth()->user()->role === 'petugas' || auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium text-neutral-700 hover:text-neutral-900 hover:bg-neutral-100 rounded-lg transition-all duration-200">
                                    Dashboard Admin
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-neutral-700 hover:text-neutral-900 hover:bg-neutral-100 rounded-lg transition-all duration-200">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                Daftar Sekarang
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuBtn" class="md:hidden p-2 text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 rounded-lg transition-colors">
                        <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden border-t border-neutral-200 bg-white/95 backdrop-blur-md">
                <div class="px-4 py-3 space-y-2">
                    @auth
                        @if(auth()->user()->role === 'warga')
                            <a href="{{ route('laporan.index') }}" class="block px-4 py-2.5 text-sm font-medium text-neutral-700 hover:bg-neutral-100 rounded-lg transition-colors">
                                Dashboard
                            </a>
                            <a href="{{ route('laporan.create') }}" class="block px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg text-center shadow-sm">
                                Buat Laporan
                            </a>
                        @elseif(auth()->user()->role === 'petugas' || auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm font-medium text-neutral-700 hover:bg-neutral-100 rounded-lg transition-colors">
                                Dashboard Admin
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2.5 text-sm font-medium text-neutral-700 hover:bg-neutral-100 rounded-lg transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="block px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg text-center shadow-sm">
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section - Modern Minimalist -->
        <div class="relative pt-24 pb-16 sm:pt-32 sm:pb-24 overflow-hidden">
            <!-- Background Decorative Elements -->
            <div class="absolute top-20 right-0 -z-10 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-40 left-0 -z-10 w-96 h-96 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-20 left-1/2 -z-10 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <!-- Left Content -->
                    <div class="text-center lg:text-left">
                        <!-- Badge -->
                        <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-blue-50 border border-blue-100 mb-6 animate-fadeInUp">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-2 animate-pulse"></span>
                            <span class="text-sm font-medium text-blue-700">Platform Layanan Publik Digital</span>
                        </div>

                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-neutral-900 leading-tight mb-6 animate-fadeInUp-delay-1">
                            Laporkan Masalah<br/>
                            <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Publik dengan Mudah</span>
                        </h1>

                        <p class="text-lg text-neutral-600 mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed animate-fadeInUp-delay-2">
                            Platform digital untuk melaporkan masalah publik seperti jalan rusak, sampah, dan penerangan jalan.
                            Laporan Anda akan segera ditanggapi oleh petugas terkait dengan cepat dan transparan.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start animate-fadeInUp-delay-3">
                            @auth
                                @if(auth()->user()->role === 'warga')
                                    <a href="{{ route('laporan.create') }}" class="group inline-flex items-center justify-center px-6 py-3.5 text-base font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                                        Buat Laporan Baru
                                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('laporan.index') }}" class="inline-flex items-center justify-center px-6 py-3.5 text-base font-medium text-neutral-700 bg-white hover:bg-neutral-50 border border-neutral-300 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-0.5">
                                        Lihat Laporan Saya
                                    </a>
                                @else
                                    <a href="{{ route('admin.dashboard') }}" class="group inline-flex items-center justify-center px-6 py-3.5 text-base font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                                        Dashboard Admin
                                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('register') }}" class="group inline-flex items-center justify-center px-6 py-3.5 text-base font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                                    Mulai Sekarang
                                    <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3.5 text-base font-medium text-neutral-700 bg-white hover:bg-neutral-50 border border-neutral-300 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-0.5">
                                    Masuk
                                </a>
                            @endauth
                        </div>

                        <!-- Stats -->
                        <div class="mt-12 grid grid-cols-3 gap-6 max-w-md mx-auto lg:mx-0">
                            <div class="text-center lg:text-left">
                                <div class="text-2xl sm:text-3xl font-bold text-neutral-900">1000+</div>
                                <div class="text-sm text-neutral-600 mt-1">Laporan</div>
                            </div>
                            <div class="text-center lg:text-left">
                                <div class="text-2xl sm:text-3xl font-bold text-neutral-900">95%</div>
                                <div class="text-sm text-neutral-600 mt-1">Terselesaikan</div>
                            </div>
                            <div class="text-center lg:text-left">
                                <div class="text-2xl sm:text-3xl font-bold text-neutral-900">24/7</div>
                                <div class="text-sm text-neutral-600 mt-1">Layanan</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Lottie Animation -->
                    <div class="relative lg:mt-0 mt-8">
                        <div class="relative z-10 animate-float">
                            <dotlottie-wc
                                src="https://lottie.host/d7e8e0e4-3b5a-4c5a-8f5a-3b5a4c5a8f5a/3b5a4c5a8f.lottie"
                                autoplay
                                loop
                                style="width: 100%; max-width: 550px; height: auto; margin: 0 auto;">
                            </dotlottie-wc>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Features Section - Modern Card Design -->
        <div class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-blue-50 border border-blue-100 mb-4">
                        <span class="text-sm font-medium text-blue-700">Fitur Unggulan</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-neutral-900 mb-4">
                        Cara Kerja Lapor Cepat
                    </h2>
                    <p class="text-lg text-neutral-600 max-w-2xl mx-auto">
                        Proses pelaporan yang mudah, cepat, dan transparan untuk masyarakat
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="group relative bg-white border border-neutral-200 rounded-2xl p-8 hover:shadow-xl hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-t-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-neutral-900 mb-3">Buat Laporan</h3>
                        <p class="text-neutral-600 leading-relaxed">
                            Laporkan masalah publik dengan mudah melalui formulir online yang sederhana dan intuitif. Lengkapi dengan foto bukti untuk mempercepat proses.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group relative bg-white border border-neutral-200 rounded-2xl p-8 hover:shadow-xl hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-t-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-neutral-900 mb-3">Pantau Status</h3>
                        <p class="text-neutral-600 leading-relaxed">
                            Pantau perkembangan laporan Anda secara real-time. Dapatkan notifikasi setiap ada update dari petugas terkait.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group relative bg-white border border-neutral-200 rounded-2xl p-8 hover:shadow-xl hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-t-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-neutral-900 mb-3">Terima Tanggapan</h3>
                        <p class="text-neutral-600 leading-relaxed">
                            Dapatkan tanggapan dan solusi dari petugas yang berwenang. Proses transparan dan dapat dipertanggungjawabkan.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="py-20 bg-neutral-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-blue-50 border border-blue-100 mb-4">
                        <span class="text-sm font-medium text-blue-700">Kategori Laporan</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-neutral-900 mb-4">
                        Jenis Masalah yang Dapat Dilaporkan
                    </h2>
                    <p class="text-lg text-neutral-600 max-w-2xl mx-auto">
                        Berbagai kategori masalah publik yang dapat Anda laporkan
                    </p>
                </div>

                <!-- Categories Grid -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Category 1 -->
                    <div class="bg-white border border-neutral-200 rounded-xl p-6 hover:shadow-lg hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-neutral-900 mb-2">Jalan Rusak</h3>
                                <p class="text-sm text-neutral-600">Jalan berlubang, retak, atau rusak yang membahayakan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Category 2 -->
                    <div class="bg-white border border-neutral-200 rounded-xl p-6 hover:shadow-lg hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-neutral-900 mb-2">Sampah</h3>
                                <p class="text-sm text-neutral-600">Tumpukan sampah, tempat sampah penuh, atau tidak terangkut</p>
                            </div>
                        </div>
                    </div>

                    <!-- Category 3 -->
                    <div class="bg-white border border-neutral-200 rounded-xl p-6 hover:shadow-lg hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-neutral-900 mb-2">Penerangan Jalan</h3>
                                <p class="text-sm text-neutral-600">Lampu jalan mati atau rusak yang perlu diperbaiki</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="py-20 bg-gradient-to-br from-blue-500 to-indigo-600 relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full filter blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
            </div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
                    Siap Membuat Laporan?
                </h2>
                <p class="text-lg text-blue-100 mb-8 max-w-2xl mx-auto">
                    Bergabunglah dengan ribuan warga yang telah mempercayai Lapor Cepat untuk melaporkan masalah publik di lingkungan mereka.
                </p>
                @guest
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium text-blue-600 bg-white hover:bg-blue-50 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                        Daftar Gratis Sekarang
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium text-white bg-white/10 hover:bg-white/20 border-2 border-white/30 rounded-xl backdrop-blur-sm transition-all duration-200 transform hover:-translate-y-0.5">
                        Sudah Punya Akun? Masuk
                    </a>
                </div>
                @else
                <a href="{{ auth()->user()->role === 'warga' ? route('laporan.create') : route('admin.dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium text-blue-600 bg-white hover:bg-blue-50 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                    {{ auth()->user()->role === 'warga' ? 'Buat Laporan Baru' : 'Ke Dashboard Admin' }}
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                @endguest
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-neutral-900 text-neutral-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <!-- Brand -->
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-white">Lapor Cepat</h3>
                        </div>
                        <p class="text-neutral-400 mb-4 max-w-md">
                            Platform digital untuk melaporkan masalah publik dengan cepat, mudah, dan transparan. Bersama membangun lingkungan yang lebih baik.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-neutral-800 hover:bg-neutral-700 rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-neutral-800 hover:bg-neutral-700 rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-neutral-800 hover:bg-neutral-700 rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Tautan Cepat</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Masuk</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Daftar</a></li>
                            @auth
                                @if(auth()->user()->role === 'warga')
                                    <li><a href="{{ route('laporan.index') }}" class="hover:text-white transition-colors">Dashboard</a></li>
                                    <li><a href="{{ route('laporan.create') }}" class="hover:text-white transition-colors">Buat Laporan</a></li>
                                @else
                                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard Admin</a></li>
                                @endif
                            @endauth
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Kontak</h4>
                        <ul class="space-y-2">
                            <li class="flex items-start space-x-2">
                                <svg class="w-5 h-5 text-neutral-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>info@laporcepat.id</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <svg class="w-5 h-5 text-neutral-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>(021) 1234-5678</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <svg class="w-5 h-5 text-neutral-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Jakarta, Indonesia</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom Bar -->
                <div class="border-t border-neutral-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-neutral-400 text-sm">
                        &copy; {{ date('Y') }} Lapor Cepat. All rights reserved.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-neutral-400 hover:text-white text-sm transition-colors">Kebijakan Privasi</a>
                        <a href="#" class="text-neutral-400 hover:text-white text-sm transition-colors">Syarat & Ketentuan</a>
                        <a href="#" class="text-neutral-400 hover:text-white text-sm transition-colors">Bantuan</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Mobile Menu Toggle Script -->
        <script>
            document.getElementById('mobileMenuBtn').addEventListener('click', function() {
                const menu = document.getElementById('mobileMenu');
                const menuIcon = document.getElementById('menuIcon');
                const closeIcon = document.getElementById('closeIcon');

                menu.classList.toggle('hidden');
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        </script>
    </body>
</html>

