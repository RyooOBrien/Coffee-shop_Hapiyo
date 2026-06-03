<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happiyo Cafe</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-cover bg-center relative"
style="background-image: url('{{ asset('images/cafe1.jpg') }}');">

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/30"></div>

    <!-- CONTENT -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-6">

        <div class="w-full max-w-xl text-center">

            <!-- LOGO -->
            <div class="mb-10">
                <h1 class="text-6xl font-extrabold text-white tracking-tight drop-shadow-lg">
                    Happiyo Cafe
                </h1>

                <p class="mt-5 text-gray-200 text-lg leading-relaxed">
                    Sistem manajemen cafe untuk admin dan kasir.
                </p>

            </div>

            <!-- CARD LOGIN -->
            <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-10 shadow-2xl">

                <h2 class="text-3xl font-bold text-white mb-3">
                    Masuk ke Dashboard
                </h2>

                <p class="text-gray-200 mb-8">
                    Login untuk mengelola menu, produk, dan transaksi cafe.
                </p>

                <a href="{{ route('login') }}"
                   class="block w-full bg-white text-gray-900 hover:bg-green-500 hover:text-white py-4 rounded-2xl font-bold transition duration-300 shadow-lg">

                    Login Admin / Kasir

                </a>

            </div>

            <!-- FOOTER -->
            <p class="mt-8 text-sm text-gray-300">
                © 2026 Happiyo Cafe. All rights reserved.
            </p>

        </div>

    </div>

</body>
</html>