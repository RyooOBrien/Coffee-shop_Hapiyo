<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hapiyo Cafe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-cover bg-center relative"
style="background-image: url('{{ asset('images/cafe1.jpg') }}');">

    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <div class="relative z-10 min-h-screen flex items-center justify-center px-6">

        <div class="w-full max-w-md">

            <div class="text-center mb-8">
                <h1 class="text-5xl font-extrabold text-white drop-shadow-lg">
                    Hapiyo Cafe
                </h1>
                <p class="text-gray-200 mt-3">
                    Login Admin / Kasir
                </p>
            </div>

            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-8">

                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    Masuk ke Dashboard
                </h2>

                <p class="text-gray-500 mb-8">
                    Silakan login menggunakan akun yang sudah terdaftar.
                </p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Email
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center text-sm text-gray-600">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-orange-500">
                            <span class="ml-2">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-gray-900 hover:bg-orange-500 text-white py-4 rounded-2xl font-bold transition shadow-lg">
                        Login
                    </button>
                </form>

            </div>

            <p class="text-center text-gray-300 text-sm mt-6">
                © 2026 Hapiyo Cafe
            </p>

        </div>

    </div>

</body>
</html>