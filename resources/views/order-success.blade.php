<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Berhasil</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#EFF6FF] min-h-screen flex items-center justify-center p-6">

<div class="max-w-2xl w-full bg-white rounded-[40px] shadow-2xl p-10">

    <!-- SUCCESS -->
    <div class="text-center mb-10">

        <h1 class="text-5xl font-extrabold text-gray-900">
            Order Berhasil
        </h1>

        <p class="text-gray-500 text-lg mt-4">
            Pesanan kamu sedang diproses oleh kasir
        </p>

        <p class="text-black-500 font-extrabold text-lg mt-4">
            Terima kasih sudah datang di hapiyo
        </p>

    </div>

    <!-- INFO -->
    <div class="bg-blue-50 rounded-3xl p-8 mb-8">

        <div class="flex justify-between items-center mb-5">
            <span class="text-gray-500 font-semibold">
                Nomor Antrian
            </span>

            <span class="text-4xl font-extrabold text-black-600">
                #{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}
            </span>
        </div>

        <div class="flex justify-between items-center mb-4">
            <span class="text-gray-500">
                Nama Pemesan
            </span>

            <span class="font-extrabold text-black-800">
                {{ $order->customer_name }}
            </span>
        </div>

        <div class="flex justify-between items-center mb-4">
            <span class="text-gray-500">
                Pembayaran
            </span>

            <span class="font-extrabold text-black-800">
                {{ $order->payment_method }}
            </span>
        </div>

        <div class="flex justify-between items-center mb-4">
            <span class="text-gray-500">
                Status
            </span>

            <div id="orderStatus">
                @include('kasir.partials.order-status-live', ['order' => $order])
            </div>
        </div>

        <div class="flex justify-between items-center">
            <span class="text-gray-500">
                Total
            </span>

            <span class="text-3xl font-extrabold text-black-600">
                Rp {{ number_format($order->total,0,',','.') }}
            </span>
        </div>

    </div>

    <!-- MENU -->
    <div class="mb-10">

        <h2 class="text-2xl font-extrabold text-gray-800 mb-5">
            Detail Pesanan
        </h2>

        <div class="space-y-4">

            @foreach($order->items as $item)

            <div class="flex justify-between items-center border-b pb-4">

                <div>
                    <h3 class="font-bold text-gray-800 text-lg">
                        {{ $item->product_name }}
                    </h3>

                    <p class="text-gray-500">
                        {{ $item->quantity }} x Rp {{ number_format($item->price,0,',','.') }}
                    </p>
                </div>

                <div class="font-extrabold text-gray-800">
                    Rp {{ number_format($item->subtotal,0,',','.') }}
                </div>

            </div>

            @endforeach

        </div>

    </div>

    <!-- BUTTON -->
    <div class="mt-8">

        <a href="/menu"
           class="w-full block bg-blue-600 hover:bg-blue-700 
           text-white py-4 rounded-2xl text-center 
           font-bold text-lg">
            Pesan Lagi
        </a>

    </div>

</div>

<script>
function loadOrderStatus() {
    fetch('/order-status-live/{{ $order->id }}')
        .then(response => response.text())
        .then(html => {
            document.getElementById('orderStatus').innerHTML = html;
        })
        .catch(error => {
            console.log('Gagal mengambil status order:', error);
        });
}

setInterval(loadOrderStatus, 3000);
</script>

</body>
</html>