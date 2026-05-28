<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Hapiyo Cafe</title>

    @vite(['resources/css/app.css'])

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-[#f8f9fb] min-h-screen">

    

    <!-- NAVBAR -->
    <nav class="bg-white/90 backdrop-blur-md border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-4 sm:py-5 flex justify-between items-center">

            <h1 class="text-2xl sm:text-3xl font-extrabold text-blue-500">
                Hapiyo Cafe
            </h1>

            <a href="/cart"
               class="bg-gray-900 hover:bg-blue-500 text-white px-4 sm:px-6 py-3 rounded-xl sm:rounded-2xl text-sm sm:text-base font-bold transition">
                 Keranjang
            </a>

        </div>
    </nav>

    <!-- HERO -->
    <section class="max-w-7xl mx-auto px-4 sm:px-8 py-8 sm:py-16">

        <div data-aos="fade-up"
             class="bg-white rounded-[28px] sm:rounded-[40px] p-6 sm:p-10 md:p-16 shadow-sm border grid md:grid-cols-2 gap-8 md:gap-10 items-center">

            <div data-aos="fade-right" data-aos-delay="150">
                <p class="text-blue-500 font-bold mb-4">
                    Welcome to Hapiyo
                </p>

                <h2 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                    Pilih Menu <br> Favoritmu
                </h2>

                <p class="text-gray-500 text-base sm:text-lg mt-4 sm:mt-6 leading-relaxed">
                    Nikmati pilihan kopi, makanan, dan minuman terbaik dari Hapiyo Cafe.
                </p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="300"
                 class="relative w-full h-52 sm:h-64 md:h-80 overflow-hidden rounded-[24px] sm:rounded-[35px] shadow-xl sm:shadow-2xl">

                <img id="slider"
                     src="/images/cafe1.jpg"
                     class="w-full h-full object-cover transition-all duration-1000">

                <div class="absolute inset-0 bg-black/10"></div>
            </div>

        </div>

    </section>

    <!-- MENU -->
    <section class="max-w-7xl mx-auto px-4 sm:px-8 pb-16 sm:pb-24">

        @php
            $kopi = $products->where('category', 'Kopi');
            $makanan = $products->where('category', 'Makanan');
            $minuman = $products->where('category', 'Minuman');
        @endphp

        <!-- KOPI -->
        <div class="mb-16" data-aos="fade-up">
            <h3 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6 sm:mb-8">
                Menu Kopi Hapiyo
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($kopi as $product)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @include('components.product-card', ['product' => $product])
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada menu kopi.</p>
                @endforelse
            </div>
        </div>

        <!-- MAKANAN -->
        <div class="mb-16" data-aos="fade-up">
            <h3 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6 sm:mb-8">
                Menu Makanan Hapiyo
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                @forelse($makanan as $product)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @include('components.product-card', ['product' => $product])
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada menu makanan.</p>
                @endforelse
            </div>
        </div>

        <!-- MINUMAN -->
        <div data-aos="fade-up">
            <h3 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6 sm:mb-8">
                Menu Non-Coffee Hapiyo
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                @forelse($minuman as $product)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @include('components.product-card', ['product' => $product])
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada menu minuman.</p>
                @endforelse
            </div>
        </div>

    </section>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 900,
            once: true,
            offset: 120
        });

        

        // SLIDER
        const images = [
            "/images/cafe1.jpg",
            "/images/cafe2.jpg",
            "/images/cafe3.jpg",
            "/images/cafe4.jpg"
        ];

        let current = 0;
        const slider = document.getElementById('slider');

        setInterval(() => {
            current++;

            if (current >= images.length) {
                current = 0;
            }

            slider.style.opacity = 0;

            setTimeout(() => {
                slider.src = images[current];
                slider.style.opacity = 1;
            }, 300);

        }, 3500);
    </script>

</body>
</html>