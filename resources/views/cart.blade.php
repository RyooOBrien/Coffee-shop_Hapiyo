<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#EFF6FF] min-h-screen">

<div class="max-w-6xl mx-auto px-4 sm:px-8 py-6 sm:py-10">

    <!-- HEADER -->
    <div class="flex justify-between items-center gap-4 mb-8 sm:mb-10">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-blue-700 leading-tight">
            Keranjang <br class="sm:hidden"> Belanja
        </h1>

        <a href="/menu"
           class="bg-gray-900 hover:bg-blue-600 text-white px-4 sm:px-6 py-3 rounded-2xl font-bold shadow text-xs sm:text-base text-center">
            + Tambah <br class="sm:hidden"> Menu
        </a>
    </div>

    @if(session('cart'))

    <div class="space-y-4 sm:space-y-6">
        @php $total = 0; @endphp

        @foreach($cart as $id => $item)

        @php
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        @endphp

        <!-- CART ITEM -->
        <div class="bg-white rounded-3xl shadow-md sm:shadow-lg p-4 sm:p-6">

            <div class="flex gap-4 sm:gap-6">

                <!-- IMAGE -->
                <img src="{{ asset('storage/' . $item['image']) }}"
                     class="w-20 h-20 sm:w-28 sm:h-28 object-cover rounded-2xl bg-gray-100 flex-shrink-0">

                <!-- INFO -->
                <div class="flex-1 min-w-0">

                    <div class="flex justify-between gap-3">

                        <div>
                            <h2 class="text-base sm:text-2xl font-extrabold text-gray-800 leading-tight line-clamp-2">
                                {{ $item['name'] }}
                            </h2>

                            <p class="text-blue-600 font-bold mt-1 sm:mt-2 text-sm sm:text-base">
                                Rp {{ number_format($item['price'],0,',','.') }}
                            </p>
                        </div>

                        <div class="text-right flex-shrink-0">
                            <p class="text-base sm:text-2xl font-extrabold text-gray-800">
                                Rp {{ number_format($subtotal,0,',','.') }}
                            </p>
                        </div>

                    </div>

                    <!-- ACTIONS -->
                    <div class="flex justify-between items-center mt-4">

                        <div class="flex items-center gap-2 sm:gap-3">
                            <form action="/cart/decrease/{{ $id }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white w-8 h-8 sm:w-9 sm:h-9 rounded-full font-bold shadow">
                                    -
                                </button>
                            </form>

                            <span class="font-extrabold text-base sm:text-lg min-w-[20px] text-center">
                                {{ $item['quantity'] }}
                            </span>

                            <form action="/cart/increase/{{ $id }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white w-8 h-8 sm:w-9 sm:h-9 rounded-full font-bold shadow">
                                    +
                                </button>
                            </form>
                        </div>

                        <form action="/cart/remove/{{ $id }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="bg-gray-900 hover:bg-red-500 text-white px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition">
                                Hapus
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        </div>

        @endforeach
    </div>

    <!-- CHECKOUT BOX -->
    <div class="mt-8 sm:mt-10 bg-white p-5 sm:p-8 rounded-3xl shadow-lg">

        <div class="flex justify-between items-center gap-4">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-800">
                Total
            </h2>

            <span class="text-2xl sm:text-4xl font-extrabold text-blue-600 text-right">
                Rp {{ number_format($total,0,',','.') }}
            </span>
        </div>

        <form action="/checkout" method="POST">
            @csrf

            <div class="mt-6 sm:mt-8 mb-5 sm:mb-6">
                <label class="block font-bold text-gray-700 mb-2 sm:mb-3">
                    Nama Pemesan
                </label>

                <input type="text"
                    name="customer_name"
                    placeholder="Masukkan nama pemesan"
                    class="w-full border border-gray-200 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
            </div>

            <div class="mt-6 sm:mt-8">
                <label class="block font-bold text-gray-700 mb-2 sm:mb-3">
                    Metode Pembayaran
                </label>

                <select id="paymentMethod" name="payment_method"
                    class="w-full border border-gray-200 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-400" required>

                    <option value="">Pilih Pembayaran</option>
                    <option value="Cash">Cash</option>
                    <option value="QRIS">QRIS</option>

                </select>
            </div>

            <!-- QRIS BOX -->
            <div id="qrisBox" class="hidden mt-6 bg-blue-50 border border-blue-100 rounded-3xl p-5 sm:p-6 text-center">

                <p class="text-xl sm:text-2xl font-extrabold text-gray-800 mb-2">
                    Scan QRIS
                </p>

                <p class="text-gray-500 mb-5 text-sm sm:text-base">
                    Scan kode QRIS di bawah ini untuk melakukan pembayaran.
                </p>

                <img src="/images/qris.jpg"
                    class="w-56 h-56 sm:w-72 sm:h-72 object-contain mx-auto bg-white p-4 rounded-3xl shadow-lg border">

                <p class="text-xs sm:text-sm text-gray-500 mt-5">
                    Setelah pembayaran berhasil, klik tombol Checkout.
                </p>

            </div>

            <button type="submit"
                class="w-full mt-6 bg-blue-600 hover:bg-blue-700
                text-white py-4 rounded-2xl text-lg sm:text-xl font-bold shadow-lg transition">
                Checkout
            </button>
        </form>

    </div>

    @else

    <!-- EMPTY CART -->
    <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-lg text-center">

        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-700">
            Keranjang Masih Kosong
        </h2>

        <a href="/menu"
           class="inline-block mt-6 bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-bold transition">
            Kembali ke Menu
        </a>

    </div>

    @endif

</div>

<script>
    const paymentMethod = document.getElementById('paymentMethod');
    const qrisBox = document.getElementById('qrisBox');

    function toggleQris() {
        if (paymentMethod.value === 'QRIS') {
            qrisBox.classList.remove('hidden');
        } else {
            qrisBox.classList.add('hidden');
        }
    }

    if (paymentMethod) {
        paymentMethod.addEventListener('change', toggleQris);
        toggleQris();
    }
</script>

</body>
</html>