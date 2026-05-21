@php
    $discount = $product->discount ?? 0;
    $finalPrice = $product->price - $discount;
@endphp

<div class="bg-white rounded-[32px] overflow-hidden border border-gray-100 
            shadow-sm hover:shadow-2xl hover:-translate-y-3 
            transition-all duration-300 group
            {{ $product->stock <= 0 ? 'opacity-60' : '' }}">

    <!-- IMAGE -->
    @if($product->image)
        <div class="overflow-hidden h-64 relative">
            @if($product->best_seller)
<div class="absolute top-4 right-4 z-10">
    <div class="bg-green-500 text-white px-4 py-2 
                rounded-2xl font-extrabold shadow-lg 
                text-sm border-2 border-white">
        🔥 Paling Laris
    </div>
</div>
@endif

            <img src="{{ asset('storage/' . $product->image) }}"
                 class="w-full h-full object-cover 
                 group-hover:scale-110 transition duration-500
                 {{ $product->stock <= 0 ? 'grayscale' : '' }}">

            @if($product->discount > 0)
<div class="absolute top-4 left-2 z-10">
    <div class="bg-red-500 text-white px-4 py-2 rounded-2xl 
                font-extrabold shadow-lg text-sm border-2 border-white">
        - Rp {{ number_format($product->discount,0,',','.') }}
    </div>
</div>
@endif

            @if($product->stock <= 0)
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                    <span class="bg-red-500 text-white px-5 py-2 rounded-2xl font-bold text-lg shadow-lg">
                        Sold Out
                    </span>
                </div>
            @endif

        </div>
    @else
        <div class="w-full h-64 bg-gray-100 flex items-center justify-center text-gray-400">
            Tidak ada gambar
        </div>
    @endif

    <!-- CONTENT -->
    <div class="p-7 flex flex-col min-h-[320px]">

        <!-- CATEGORY -->
        <p class="text-sm font-extrabold text-blue-500 uppercase tracking-widest mb-3">
            {{ $product->category }}
        </p>

        <!-- TITLE -->
        <h3 class="text-3xl font-extrabold text-gray-900 leading-tight mb-4">
            {{ $product->name }}
        </h3>

        <!-- DESCRIPTION -->
        <p class="text-gray-500 text-lg leading-relaxed line-clamp-3 mb-8">
            {{ $product->description }}
        </p>

        <!-- PRICE + BUTTON -->
        <div class="flex justify-between items-center mt-auto gap-4">

            <div>
                @if($discount > 0)
                    <p class="text-gray-400 line-through text-lg font-bold">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <p class="text-3xl font-extrabold text-red-500">
                        Rp {{ number_format($finalPrice, 0, ',', '.') }}
                    </p>
                @else
                    <p class="text-3xl font-extrabold text-gray-900">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                @endif
            </div>

            @if($product->stock > 0)

                <form action="/cart/add/{{ $product->id }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 
                               text-white px-7 py-3 rounded-2xl 
                               font-bold text-lg shadow-lg 
                               hover:scale-105 transition-all duration-300">
                        Beli
                    </button>
                </form>

            @else

                <button disabled
                    class="bg-gray-300 cursor-not-allowed
                           text-white px-7 py-3 rounded-2xl 
                           font-bold text-lg shadow">
                    Habis
                </button>

            @endif

        </div>

    </div>

</div>