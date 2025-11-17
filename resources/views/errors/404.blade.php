<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    
    <!-- Lottie -->
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>
    
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="text-center px-4">
        <!-- Lottie Animation -->
        <dotlottie-wc 
            src="https://lottie.host/embed/b7c3e0e4-3b5a-4c5a-8f5a-3b5a4c5a8f5a/3b5a4c5a8f.lottie" 
            autoplay 
            loop 
            style="width: 300px; height: 300px; margin: 0 auto;">
        </dotlottie-wc>
        
        <h1 class="text-6xl font-bold text-gray-800 mb-4">404</h1>
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Halaman Tidak Ditemukan</h2>
        <p class="text-gray-600 mb-8">Maaf, halaman yang Anda cari tidak dapat ditemukan.</p>
        
        <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>

