<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Berhasil</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#EFF6FF] min-h-screen flex items-start sm:items-center justify-center px-4 py-6 sm:p-6">

<div class="w-full max-w-[420px] sm:max-w-2xl bg-white rounded-[28px] sm:rounded-[40px] shadow-2xl px-5 py-7 sm:p-10">

    <!-- SUCCESS -->
    <div class="text-center mb-7 sm:mb-10">

        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
            Order Berhasil
        </h1>

        <p class="text-gray-500 text-sm sm:text-lg mt-3 sm:mt-4">
            Pesanan kamu sedang diproses oleh kasir
        </p>

        <p class="text-gray-900 font-extrabold text-sm sm:text-lg mt-4">
            Terima kasih sudah datang di hapiyo
        </p>

    </div>

    <!-- INFO -->
    <div class="bg-blue-50 rounded-3xl p-5 sm:p-8 mb-7 sm:mb-8">

        <div class="flex justify-between items-center gap-4 mb-5">
            <span class="text-gray-500 font-semibold text-sm sm:text-base">
                Nomor Antrian
            </span>

            <span class="text-3xl sm:text-4xl font-extrabold text-gray-900 whitespace-nowrap">
                #{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}
            </span>
        </div>

        <div class="flex justify-between items-center gap-4 mb-4">
            <span class="text-gray-500 text-sm sm:text-base">
                Nama Pemesan
            </span>

            <span class="font-extrabold text-gray-900 text-sm sm:text-base text-right break-words">
                {{ $order->customer_name }}
            </span>
        </div>

        <div class="flex justify-between items-center gap-4 mb-4">
            <span class="text-gray-500 text-sm sm:text-base">
                Pembayaran
            </span>

            <span class="font-extrabold text-gray-900 text-sm sm:text-base">
                {{ $order->payment_method }}
            </span>
        </div>

        <div class="flex justify-between items-center gap-4 mb-4">
            <span class="text-gray-500 text-sm sm:text-base">
                Status
            </span>

            <div id="orderStatus" class="text-sm sm:text-base">
                @include('kasir.partials.order-status-live', ['order' => $order])
            </div>
        </div>

        <div class="flex justify-between items-center gap-4 pt-3 border-t border-blue-100">
            <span class="text-gray-500 text-sm sm:text-base">
                Total
            </span>

            <span class="text-2xl sm:text-3xl font-extrabold text-gray-900 whitespace-nowrap">
                Rp {{ number_format($order->total,0,',','.') }}
            </span>
        </div>

    </div>

    <!-- MENU -->
    <div class="mb-8 sm:mb-10">

        <h2 class="text-xl sm:text-2xl font-extrabold text-gray-800 mb-4 sm:mb-5">
            Detail Pesanan
        </h2>

        <div class="space-y-4">

            @foreach($order->items as $item)

            <div class="grid grid-cols-[1fr_auto] gap-4 items-start border-b pb-4">

                <div class="min-w-0">
                    <h3 class="font-extrabold text-gray-800 text-sm sm:text-lg leading-snug break-words">
                        {{ $item->product_name }}
                    </h3>

                    <p class="text-gray-500 text-xs sm:text-base mt-1">
                        {{ $item->quantity }} x Rp {{ number_format($item->price,0,',','.') }}
                    </p>
                </div>

                <div class="font-extrabold text-gray-800 text-sm sm:text-base whitespace-nowrap pt-1">
                    Rp {{ number_format($item->subtotal,0,',','.') }}
                </div>

            </div>

            @endforeach

        </div>

    </div>

    <!-- BUTTON -->
    <div class="mt-6 sm:mt-8">

        <a href="/menu"
           class="w-full block bg-blue-600 hover:bg-blue-700 
           text-white py-4 rounded-2xl text-center 
           font-bold text-base sm:text-lg">
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