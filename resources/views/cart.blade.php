<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#EFF6FF] min-h-screen">

<div class="max-w-6xl mx-auto px-8 py-10">

    <div class="flex justify-between items-center mb-10">
        <h1 class="text-5xl font-bold text-blue-700">
             Keranjang Belanja
        </h1>

        <a href="/menu"
           class="bg-gray-900 hover:bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold shadow">
            + Tambah Menu Lain
        </a>
    </div>

    @if(session('cart'))

    <div class="space-y-6">
        @php $total = 0; @endphp

        @foreach($cart as $id => $item)

        @php
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        @endphp

        <div class="bg-white rounded-3xl shadow-lg p-6 flex items-center justify-between">

            <div class="flex items-center gap-6">
                <img src="{{ asset('storage/' . $item['image']) }}"
                     class="w-28 h-28 object-cover rounded-2xl">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $item['name'] }}
                    </h2>

                    <p class="text-blue-600 font-bold mt-2">
                        Rp {{ number_format($item['price'],0,',','.') }}
                    </p>

                    <div class="flex items-center gap-3 mt-3">
                        <form action="/cart/decrease/{{ $id }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white w-8 h-8 rounded-full">
                                -
                            </button>
                        </form>

                        <span class="font-bold text-lg">
                            {{ $item['quantity'] }}
                        </span>

                        <form action="/cart/increase/{{ $id }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white w-8 h-8 rounded-full">
                                +
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <div class="text-2xl font-bold text-gray-700">
                    Rp {{ number_format($subtotal,0,',','.') }}
                </div>

                <form action="/cart/remove/{{ $id }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="bg-gray-800 hover:bg-red-500 text-white px-4 py-2 rounded-xl">
                        Hapus
                    </button>
                </form>
            </div>

        </div>

        @endforeach
    </div>

    <div class="mt-10 bg-white p-8 rounded-3xl shadow-lg">

        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-bold text-gray-800">
                Total
            </h2>

            <span class="text-4xl font-extrabold text-blue-600">
                Rp {{ number_format($total,0,',','.') }}
            </span>
        </div>

        <form action="/checkout" method="POST">
            @csrf

            <div class="mt-8 mb-6">
                <label class="block font-bold text-gray-700 mb-3">
                    Nama Pemesan
                </label>

                <input type="text"
                    name="customer_name"
                    placeholder="Masukkan nama pemesan"
                    class="w-full border p-4 rounded-2xl"
                    required>
            </div>

            <div class="mt-8">
                <label class="block font-bold text-gray-700 mb-3">
                    Metode Pembayaran
                </label>

                <select id="paymentMethod" name="payment_method"
                    class="w-full border p-4 rounded-2xl" required>

                    <option value="">Pilih Pembayaran</option>
                    <option value="Cash">Cash</option>
                    <option value="QRIS">QRIS</option>

                </select>
            </div>

            <!-- QRIS BOX -->
            <div id="qrisBox" class="hidden mt-6 bg-blue-50 border border-blue-100 rounded-3xl p-6 text-center">

                <p class="text-2xl font-extrabold text-gray-800 mb-2">
                    Scan QRIS
                </p>

                <p class="text-gray-500 mb-5">
                    Scan kode QRIS di bawah ini untuk melakukan pembayaran.
                </p>

                <img src="/images/qris.jpg"
                    class="w-72 h-72 object-contain mx-auto bg-white p-4 rounded-3xl shadow-lg border">

                <p class="text-sm text-gray-500 mt-5">
                    Setelah pembayaran berhasil, klik tombol Checkout.
                </p>

            </div>

            <button type="submit"
                class="w-full mt-6 bg-blue-600 hover:bg-blue-700
                text-white py-4 rounded-2xl text-xl font-bold">
                Checkout
            </button>
        </form>

    </div>

    @else

    <div class="bg-white p-10 rounded-3xl shadow-lg text-center">

        <h2 class="text-3xl font-bold text-gray-700">
            Keranjang Masih Kosong
        </h2>

        <a href="/menu"
           class="inline-block mt-6 bg-blue-600 text-white px-8 py-4 rounded-2xl">
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