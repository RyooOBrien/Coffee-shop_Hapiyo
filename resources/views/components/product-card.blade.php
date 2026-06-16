@php
    $discount = $product->discount ?? 0;
    $finalPrice = $product->price - $discount;
@endphp

<div class="h-full flex flex-col bg-white rounded-[18px] sm:rounded-[28px] overflow-hidden border border-gray-100 
            shadow-sm hover:shadow-xl lg:hover:shadow-2xl lg:hover:-translate-y-2
            transition-all duration-300 group
            {{ $product->stock <= 0 ? 'opacity-60' : '' }}">

    <!-- IMAGE -->
    @if($product->image)
        <div class="overflow-hidden h-24 sm:h-40 md:h-44 relative bg-gray-100 flex-shrink-0">

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
        <div class="w-full h-24 sm:h-40 md:h-44 bg-gray-100 flex items-center justify-center text-gray-400 text-xs sm:text-base text-center px-3 flex-shrink-0">
            Tidak ada gambar
        </div>
    @endif

    <!-- CONTENT -->
    <div class="p-3 sm:p-5 flex flex-col flex-1">

        <!-- CATEGORY -->
        <p class="text-[10px] sm:text-sm font-extrabold text-blue-500 uppercase tracking-widest mb-2 sm:mb-3">
            {{ $product->category }}
        </p>

        <!-- TITLE -->
        <h3 class="text-sm sm:text-xl lg:text-2xl font-extrabold text-gray-900 leading-tight mb-2 sm:mb-3 line-clamp-2 min-h-[36px] sm:min-h-[56px]">
            {{ $product->name }}
        </h3>

        <!-- DESCRIPTION -->
        <p class="text-gray-500 text-[11px] sm:text-sm lg:text-base leading-relaxed line-clamp-2 sm:line-clamp-3 mb-3 sm:mb-5 min-h-[34px] sm:min-h-[60px]">
            {{ $product->description }}
        </p>

        <!-- PRICE + BUTTON -->
<div class="mt-auto space-y-2">

    <div class="min-h-[42px] sm:min-h-[58px] flex flex-col justify-end">
        @if($discount > 0)
            <p class="text-gray-400 line-through text-[11px] sm:text-sm font-bold">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>

            <p class="text-sm sm:text-xl lg:text-2xl font-extrabold text-red-500">
                Rp {{ number_format($finalPrice, 0, ',', '.') }}
            </p>
        @else
            <p class="text-sm sm:text-xl lg:text-2xl font-extrabold text-gray-900">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>
        @endif
    </div>

    @if($product->stock > 0)
        <form action="/cart/add/{{ $product->id }}" method="POST" class="w-full">
            @csrf

            <button type="submit"
                class="w-full h-9 sm:h-11 bg-blue-500 hover:bg-blue-600 
                       text-white px-3 rounded-lg sm:rounded-xl 
                       font-bold text-[11px] sm:text-sm shadow-md 
                       hover:scale-105 transition-all duration-300">
                Beli
            </button>
        </form>
    @else
        <button disabled
            class="w-full h-9 sm:h-11 bg-gray-300 cursor-not-allowed
                   text-white px-3 rounded-lg sm:rounded-xl 
                   font-bold text-[11px] sm:text-sm shadow">
            Habis
        </button>
    @endif

</div>

    </div>

</div>