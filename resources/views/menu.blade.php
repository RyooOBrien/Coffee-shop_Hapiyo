<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Hapiyo Cafe</title>

    @vite(['resources/css/app.css'])

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-[#f8f9fb] min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white/90 backdrop-blur-md border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-4 sm:py-5 flex justify-between items-center gap-4">

            <h1 class="text-2xl sm:text-3xl font-extrabold text-blue-500">
                Hapiyo Cafe
            </h1>

            <a href="/cart"
               class="bg-gray-900 hover:bg-blue-500 text-white px-4 sm:px-6 py-3 rounded-xl sm:rounded-2xl text-sm sm:text-base font-bold transition whitespace-nowrap">
                Keranjang
            </a>

        </div>
    </nav>

    <!-- HERO -->
    <section class="max-w-7xl mx-auto px-4 sm:px-8 py-6 sm:py-12 md:py-16">

        <div data-aos="fade-up"
             class="bg-white rounded-[26px] sm:rounded-[40px] p-5 sm:p-10 md:p-16 shadow-sm border grid md:grid-cols-2 gap-6 sm:gap-8 md:gap-10 items-center">

            <div data-aos="fade-right" data-aos-delay="150">
                <p class="text-blue-500 font-bold mb-3 sm:mb-4 text-sm sm:text-base">
                    Welcome to Hapiyo
                </p>

                <h2 class="text-3xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                    Pilih Menu <br> Favoritmu
                </h2>

                <p class="text-gray-500 text-sm sm:text-lg mt-4 sm:mt-6 leading-relaxed">
                    Nikmati pilihan kopi, makanan, dan minuman terbaik dari Hapiyo Cafe.
                </p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="300"
                 class="relative w-full h-44 sm:h-64 md:h-80 overflow-hidden rounded-[22px] sm:rounded-[35px] shadow-xl sm:shadow-2xl">

                <img id="slider"
                     src="/images/cafe1.jpg"
                     class="w-full h-full object-cover transition-all duration-1000"
                     alt="Hapiyo Cafe">

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

        <!-- PILIH KATEGORI -->
        <div class="mb-6 flex gap-3 overflow-x-auto no-scrollbar pb-2">
            <a href="#kopi"
               class="px-6 py-3 rounded-2xl bg-blue-500 text-white font-bold whitespace-nowrap shadow">
                Kopi
            </a>

            <a href="#makanan"
               class="px-6 py-3 rounded-2xl bg-white text-gray-700 font-bold whitespace-nowrap border hover:bg-blue-50 hover:text-blue-500 transition">
                Makanan
            </a>

            <a href="#minuman"
               class="px-6 py-3 rounded-2xl bg-white text-gray-700 font-bold whitespace-nowrap border hover:bg-blue-50 hover:text-blue-500 transition">
                Non-Coffee
            </a>
        </div>

        <!-- SEARCH MENU -->
        <div class="mb-10 bg-white rounded-3xl border shadow-sm p-4">
            <div class="flex flex-col sm:flex-row gap-3">

                <input
                    type="text"
                    id="searchMenuInput"
                    placeholder="Cari menu favoritmu..."
                    autocomplete="off"
                    class="w-full px-5 py-4 rounded-2xl border border-gray-300 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-semibold"
                >

                <button
                    type="button"
                    id="resetSearchMenu"
                    class="px-6 py-4 rounded-2xl bg-gray-900 hover:bg-blue-500 text-white font-bold transition">
                    Hapus
                </button>

            </div>
        </div>

        <!-- KOPI -->
        <div id="kopi" class="product-section mb-12 sm:mb-16 scroll-mt-28" data-aos="fade-up">

            <div class="mb-5 sm:mb-8">
                <h3 class="text-2xl sm:text-4xl font-extrabold text-gray-900">
                    Menu Kopi Hapiyo
                </h3>
            </div>

            <div class="relative">

                <!-- PANAH KIRI -->
                <button type="button" onclick="scrollMenu('kopiSlider', -380)"
                    class="hidden md:flex absolute left-3 top-1/2 -translate-y-1/2 z-30
                    w-14 h-14 items-center justify-center rounded-full
                    bg-white/90 backdrop-blur-md border border-white/70
                    shadow-[0_10px_30px_rgba(15,23,42,0.18)]
                    text-gray-900 hover:bg-blue-500 hover:text-white
                    hover:scale-105 active:scale-95 transition-all duration-300">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2.8"
                         stroke="currentColor"
                         class="w-6 h-6">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <!-- SLIDER MENU -->
                <div id="kopiSlider"
                     class="flex gap-4 sm:gap-8 overflow-x-auto scroll-smooth snap-x snap-mandatory no-scrollbar pb-5 px-2">

                    @forelse($kopi as $product)
                        <div class="product-item min-w-[220px] sm:min-w-[280px] md:min-w-[310px] lg:min-w-[330px] snap-start"
                             data-name="{{ strtolower($product->name ?? '') }}"
                             data-category="{{ strtolower($product->category ?? '') }}"
                             data-description="{{ strtolower($product->description ?? '') }}"
                             data-aos="fade-up"
                             data-aos-delay="{{ $loop->index * 100 }}">
                            @include('components.product-card', ['product' => $product])
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada menu kopi.</p>
                    @endforelse

                </div>

                <!-- PANAH KANAN -->
                <button type="button" onclick="scrollMenu('kopiSlider', 380)"
                    class="hidden md:flex absolute right-3 top-1/2 -translate-y-1/2 z-30
                    w-14 h-14 items-center justify-center rounded-full
                    bg-white/90 backdrop-blur-md border border-white/70
                    shadow-[0_10px_30px_rgba(15,23,42,0.18)]
                    text-gray-900 hover:bg-blue-500 hover:text-white
                    hover:scale-105 active:scale-95 transition-all duration-300">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2.8"
                         stroke="currentColor"
                         class="w-6 h-6">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>

            </div>
        </div>

        <!-- MAKANAN -->
        <div id="makanan" class="product-section mb-12 sm:mb-16 scroll-mt-28" data-aos="fade-up">

            <div class="mb-5 sm:mb-8">
                <h3 class="text-2xl sm:text-4xl font-extrabold text-gray-900">
                    Menu Makanan Hapiyo
                </h3>
            </div>

            <div class="relative">

                <!-- PANAH KIRI -->
                <button type="button" onclick="scrollMenu('makananSlider', -380)"
                    class="hidden md:flex absolute left-3 top-1/2 -translate-y-1/2 z-30
                    w-14 h-14 items-center justify-center rounded-full
                    bg-white/90 backdrop-blur-md border border-white/70
                    shadow-[0_10px_30px_rgba(15,23,42,0.18)]
                    text-gray-900 hover:bg-blue-500 hover:text-white
                    hover:scale-105 active:scale-95 transition-all duration-300">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2.8"
                         stroke="currentColor"
                         class="w-6 h-6">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <!-- SLIDER MENU -->
                <div id="makananSlider"
                     class="flex gap-4 sm:gap-8 overflow-x-auto scroll-smooth snap-x snap-mandatory no-scrollbar pb-5 px-2">

                    @forelse($makanan as $product)
                        <div class="product-item min-w-[220px] sm:min-w-[280px] md:min-w-[310px] lg:min-w-[330px] snap-start"
                             data-name="{{ strtolower($product->name ?? '') }}"
                             data-category="{{ strtolower($product->category ?? '') }}"
                             data-description="{{ strtolower($product->description ?? '') }}"
                             data-aos="fade-up"
                             data-aos-delay="{{ $loop->index * 100 }}">
                            @include('components.product-card', ['product' => $product])
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada menu makanan.</p>
                    @endforelse

                </div>

                <!-- PANAH KANAN -->
                <button type="button" onclick="scrollMenu('makananSlider', 380)"
                    class="hidden md:flex absolute right-3 top-1/2 -translate-y-1/2 z-30
                    w-14 h-14 items-center justify-center rounded-full
                    bg-white/90 backdrop-blur-md border border-white/70
                    shadow-[0_10px_30px_rgba(15,23,42,0.18)]
                    text-gray-900 hover:bg-blue-500 hover:text-white
                    hover:scale-105 active:scale-95 transition-all duration-300">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2.8"
                         stroke="currentColor"
                         class="w-6 h-6">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>

            </div>
        </div>

        <!-- MINUMAN -->
        <div id="minuman" class="product-section mb-12 sm:mb-16 scroll-mt-28" data-aos="fade-up">

            <div class="mb-5 sm:mb-8">
                <h3 class="text-2xl sm:text-4xl font-extrabold text-gray-900">
                    Menu Non-Coffee Hapiyo
                </h3>
            </div>

            <div class="relative">

                <!-- PANAH KIRI -->
                <button type="button" onclick="scrollMenu('minumanSlider', -380)"
                    class="hidden md:flex absolute left-3 top-1/2 -translate-y-1/2 z-30
                    w-14 h-14 items-center justify-center rounded-full
                    bg-white/90 backdrop-blur-md border border-white/70
                    shadow-[0_10px_30px_rgba(15,23,42,0.18)]
                    text-gray-900 hover:bg-blue-500 hover:text-white
                    hover:scale-105 active:scale-95 transition-all duration-300">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2.8"
                         stroke="currentColor"
                         class="w-6 h-6">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <!-- SLIDER MENU -->
                <div id="minumanSlider"
                     class="flex gap-4 sm:gap-8 overflow-x-auto scroll-smooth snap-x snap-mandatory no-scrollbar pb-5 px-2">

                    @forelse($minuman as $product)
                        <div class="product-item min-w-[220px] sm:min-w-[280px] md:min-w-[310px] lg:min-w-[330px] snap-start"
                             data-name="{{ strtolower($product->name ?? '') }}"
                             data-category="{{ strtolower($product->category ?? '') }}"
                             data-description="{{ strtolower($product->description ?? '') }}"
                             data-aos="fade-up"
                             data-aos-delay="{{ $loop->index * 100 }}">
                            @include('components.product-card', ['product' => $product])
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada menu minuman.</p>
                    @endforelse

                </div>

                <!-- PANAH KANAN -->
                <button type="button" onclick="scrollMenu('minumanSlider', 380)"
                    class="hidden md:flex absolute right-3 top-1/2 -translate-y-1/2 z-30
                    w-14 h-14 items-center justify-center rounded-full
                    bg-white/90 backdrop-blur-md border border-white/70
                    shadow-[0_10px_30px_rgba(15,23,42,0.18)]
                    text-gray-900 hover:bg-blue-500 hover:text-white
                    hover:scale-105 active:scale-95 transition-all duration-300">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2.8"
                         stroke="currentColor"
                         class="w-6 h-6">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>

            </div>
        </div>

        <!-- MENU TIDAK DITEMUKAN -->
        <div id="menuNotFound"
             class="hidden bg-white rounded-3xl border p-10 text-center text-gray-500 font-bold">
            Menu tidak ditemukan.
        </div>

    </section>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 900,
            once: true,
            offset: 80,
            disable: function () {
                return window.innerWidth < 768;
            }
        });

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

        function scrollMenu(sliderId, amount) {
            const menuSlider = document.getElementById(sliderId);

            if (!menuSlider) return;

            menuSlider.scrollBy({
                left: amount,
                behavior: 'smooth'
            });
        }

        const searchMenuInput = document.getElementById('searchMenuInput');
        const resetSearchMenu = document.getElementById('resetSearchMenu');
        const menuItems = document.querySelectorAll('.product-item');
        const productSections = document.querySelectorAll('.product-section');
        const menuNotFound = document.getElementById('menuNotFound');

        searchMenuInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            let totalFound = 0;

            menuItems.forEach(function (item) {
                const name = item.dataset.name || '';
                const category = item.dataset.category || '';
                const description = item.dataset.description || '';

                const isMatch = name.includes(keyword);

                if (keyword === '' || isMatch) {
                    item.classList.remove('hidden');
                    totalFound++;
                } else {
                    item.classList.add('hidden');
                }
            });

            productSections.forEach(function (section) {
                const visibleItems = section.querySelectorAll('.product-item:not(.hidden)');

                if (keyword !== '' && visibleItems.length === 0) {
                    section.classList.add('hidden');
                } else {
                    section.classList.remove('hidden');
                }
            });

            if (keyword !== '' && totalFound === 0) {
                menuNotFound.classList.remove('hidden');
            } else {
                menuNotFound.classList.add('hidden');
            }
        });

        resetSearchMenu.addEventListener('click', function () {
            searchMenuInput.value = '';

            menuItems.forEach(function (item) {
                item.classList.remove('hidden');
            });

            productSections.forEach(function (section) {
                section.classList.remove('hidden');
            });

            menuNotFound.classList.add('hidden');
        });
    </script>

</body>
</html>