<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Berhasil</title>

    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50 flex items-center justify-center px-6">

    <div class="relative bg-white/90 backdrop-blur-xl border border-white shadow-2xl rounded-[40px] p-10 md:p-14 max-w-2xl w-full text-center overflow-hidden">

        <div class="absolute -top-20 -right-20 w-40 h-40 bg-green-200 rounded-full blur-3xl opacity-70"></div>
        <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-blue-200 rounded-full blur-3xl opacity-70"></div>

        <div class="relative z-10">

            <div class="mx-auto w-28 h-28 bg-green-500 rounded-full flex items-center justify-center shadow-2xl mb-8 animate-bounce">
                <span class="text-6xl text-white">✓</span>
            </div>

            <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 mb-5">
                Order Berhasil
            </h1>

            <p class="text-gray-500 text-xl leading-relaxed mb-8">
                Terima kasih sudah memesan di
                <span class="font-bold text-blue-600">Happiyo Cafe</span>.
                Pesanan kamu sedang diproses oleh kasir 
            </p>

            <div class="bg-blue-50 border border-blue-100 rounded-3xl p-5 mb-8">
                <p class="text-gray-500 font-semibold">
                    Status Pesanan
                </p>

                <h2 class="text-2xl font-extrabold text-blue-600 mt-1">
                    Menunggu Diproses Kasir
                </h2>
            </div>

            <a href="/menu"
               class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-bold text-lg shadow-lg transition hover:-translate-y-1">
                Kembali ke Menu
            </a>

        </div>

    </div>

</body>
</html>