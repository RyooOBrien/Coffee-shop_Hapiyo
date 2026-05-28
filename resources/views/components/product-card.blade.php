@php
    $discount = $product->discount ?? 0;
    $finalPrice = $product->price - $discount;
@endphp

<div class="bg-white rounded-[20px] sm:rounded-[32px] overflow-hidden border border-gray-100 
            shadow-sm hover:shadow-xl lg:hover:shadow-2xl lg:hover:-translate-y-2
            transition-all duration-300 group
            {{ $product->stock <= 0 ? 'opacity-60' : '' }}">

    <!-- IMAGE -->
    @if($product->image)
        <div class="overflow-hidden h-28 sm:h-52 md:h-64 relative bg-gray-100">

            @if($product->best_seller)
                <div class="absolute top-2 right-2 z-10">
                    <div class="bg-green-500 text-white px-2 sm:px-4 py-1 sm:py-2 
                                rounded-lg sm:rounded-2xl font-extrabold shadow-lg 
                                text-[10px] sm:text-sm border border-white sm:border-2">
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
                <div class="absolute top-2 left-2 z-10">
                    <div class="bg-red-500 text-white px-2 sm:px-4 py-1 sm:py-2 
                                rounded-lg sm:rounded-2xl font-extrabold shadow-lg 
                                text-[10px] sm:text-sm border border-white sm:border-2">
                        - Rp {{ number_format($product->discount, 0, ',', '.') }}
                    </div>
                </div>
            @endif

            @if($product->stock <= 0)
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                    <span class="bg-red-500 text-white px-3 sm:px-5 py-1.5 sm:py-2 rounded-lg sm:rounded-2xl font-bold text-xs sm:text-lg shadow-lg">
                        Sold Out
                    </span>
                </div>
            @endif

        </div>
    @else
        <div class="w-full h-28 sm:h-52 md:h-64 bg-gray-100 flex items-center justify-center text-gray-400 text-xs sm:text-base text-center px-3">
            Tidak ada gambar
        </div>
    @endif

    <!-- CONTENT -->
    <div class="p-3 sm:p-7 flex flex-col min-h-[210px] sm:min-h-[300px] md:min-h-[320px]">

        <!-- CATEGORY -->
        <p class="text-[10px] sm:text-sm font-extrabold text-blue-500 uppercase tracking-widest mb-2 sm:mb-3">
            {{ $product->category }}
        </p>

        <!-- TITLE -->
        <h3 class="text-base sm:text-2xl lg:text-3xl font-extrabold text-gray-900 leading-tight mb-2 sm:mb-4 line-clamp-2">
            {{ $product->name }}
        </h3>

        <!-- DESCRIPTION -->
        <p class="text-gray-500 text-xs sm:text-base lg:text-lg leading-relaxed line-clamp-2 sm:line-clamp-3 mb-4 sm:mb-8">
            {{ $product->description }}
        </p>

        <!-- PRICE + BUTTON -->
        <div class="mt-auto space-y-3 sm:space-y-0 sm:flex sm:justify-between sm:items-center sm:gap-4">

            <div>
                @if($discount > 0)
                    <p class="text-gray-400 line-through text-xs sm:text-lg font-bold">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <p class="text-base sm:text-2xl lg:text-3xl font-extrabold text-red-500">
                        Rp {{ number_format($finalPrice, 0, ',', '.') }}
                    </p>
                @else
                    <p class="text-base sm:text-2xl lg:text-3xl font-extrabold text-gray-900">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                @endif
            </div>

            @if($product->stock > 0)
                <form action="/cart/add/{{ $product->id }}" method="POST" class="w-full sm:w-auto">
                    @csrf

                    <button type="submit"
                        class="w-full sm:w-auto bg-blue-500 hover:bg-blue-600 
                               text-white px-3 sm:px-7 py-2 sm:py-3 rounded-xl sm:rounded-2xl 
                               font-bold text-xs sm:text-lg shadow-lg 
                               hover:scale-105 transition-all duration-300">
                        Beli
                    </button>
                </form>
            @else
                <button disabled
                    class="w-full sm:w-auto bg-gray-300 cursor-not-allowed
                           text-white px-3 sm:px-7 py-2 sm:py-3 rounded-xl sm:rounded-2xl 
                           font-bold text-xs sm:text-lg shadow">
                    Habis
                </button>
            @endif

        </div>

    </div>

</div>