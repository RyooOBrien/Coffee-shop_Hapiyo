@php
    $discount = $product->discount ?? 0;
    $finalPrice = $product->price - $discount;
@endphp

<div class="bg-white rounded-[24px] sm:rounded-[32px] overflow-hidden border border-gray-100 
            shadow-sm hover:shadow-xl lg:hover:shadow-2xl lg:hover:-translate-y-2
            transition-all duration-300 group
            {{ $product->stock <= 0 ? 'opacity-60' : '' }}">

    <!-- IMAGE -->
    @if($product->image)
        <div class="overflow-hidden h-40 sm:h-52 md:h-64 relative bg-gray-100">

            @if($product->best_seller)
                <div class="absolute top-3 right-3 z-10">
                    <div class="bg-green-500 text-white px-3 sm:px-4 py-1.5 sm:py-2 
                                rounded-xl sm:rounded-2xl font-extrabold shadow-lg 
                                text-xs sm:text-sm border-2 border-white">
                        🔥 Paling Laris
                    </div>
                </div>
            @endif

            <img src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 class="w-full h-full object-cover 
                        group-hover:scale-105 transition duration-500
                        {{ $product->stock <= 0 ? 'grayscale' : '' }}">

            @if($product->discount > 0)
                <div class="absolute top-3 left-3 z-10">
                    <div class="bg-red-500 text-white px-3 sm:px-4 py-1.5 sm:py-2 
                                rounded-xl sm:rounded-2xl font-extrabold shadow-lg 
                                text-xs sm:text-sm border-2 border-white">
                        - Rp {{ number_format($product->discount, 0, ',', '.') }}
                    </div>
                </div>
            @endif

            @if($product->stock <= 0)
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                    <span class="bg-red-500 text-white px-4 sm:px-5 py-2 rounded-xl sm:rounded-2xl font-bold text-sm sm:text-lg shadow-lg">
                        Sold Out
                    </span>
                </div>
            @endif

        </div>
    @else
        <div class="w-full h-40 sm:h-52 md:h-64 bg-gray-100 flex items-center justify-center text-gray-400 text-sm sm:text-base">
            Tidak ada gambar
        </div>
    @endif

    <!-- CONTENT -->
    <div class="p-5 sm:p-7 flex flex-col min-h-[240px] sm:min-h-[300px] md:min-h-[320px]">

        <!-- CATEGORY -->
        <p class="text-xs sm:text-sm font-extrabold text-blue-500 uppercase tracking-widest mb-2 sm:mb-3">
            {{ $product->category }}
        </p>

        <!-- TITLE -->
        <h3 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-gray-900 leading-tight mb-3 sm:mb-4">
            {{ $product->name }}
        </h3>

        <!-- DESCRIPTION -->
        <p class="text-gray-500 text-sm sm:text-base lg:text-lg leading-relaxed line-clamp-3 mb-6 sm:mb-8">
            {{ $product->description }}
        </p>

        <!-- PRICE + BUTTON -->
        <div class="flex justify-between items-center mt-auto gap-3 sm:gap-4">

            <div>
                @if($discount > 0)
                    <p class="text-gray-400 line-through text-sm sm:text-lg font-bold">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-red-500">
                        Rp {{ number_format($finalPrice, 0, ',', '.') }}
                    </p>
                @else
                    <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-gray-900">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                @endif
            </div>

            @if($product->stock > 0)
                <form action="/cart/add/{{ $product->id }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 
                               text-white px-5 sm:px-7 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl 
                               font-bold text-sm sm:text-lg shadow-lg 
                               hover:scale-105 transition-all duration-300">
                        Beli
                    </button>
                </form>
            @else
                <button disabled
                    class="bg-gray-300 cursor-not-allowed
                           text-white px-5 sm:px-7 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl 
                           font-bold text-sm sm:text-lg shadow">
                    Habis
                </button>
            @endif

        </div>

    </div>

</div>