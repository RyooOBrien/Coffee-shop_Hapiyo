<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Semua Laporan - Hapiyo</title>

    @vite(['resources/css/app.css'])

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .print-area {
                max-width: 100% !important;
                padding: 20px !important;
            }

            .day-section {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body class="bg-[#f8f9fb] min-h-screen">

<div class="max-w-7xl mx-auto px-8 py-10 print-area">

    <div class="flex justify-between items-center mb-10">

        <div>
            <h1 class="text-5xl font-extrabold text-gray-900">
                Laporan Semua Transaksi
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Semua laporan penjualan Hapiyo Cafe.
            </p>

            <p class="text-blue-500 mt-2 text-lg font-bold">
                Dicetak pada {{ now()->locale('id')->translatedFormat('d F Y - H:i') }}
            </p>
        </div>

        <div class="flex gap-4 no-print">
            <button onclick="window.print()"
                class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-2xl font-bold">
                Cetak / Save PDF
            </button>

            <a href="/admin/laporan"
               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold">
                Kembali
            </a>
        </div>

    </div>

    <div class="grid md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-3xl p-8 shadow-sm border">
            <p class="text-gray-500 text-lg mb-3">
                Total Orders
            </p>

            <h3 class="text-5xl font-extrabold">
                {{ $totalOrders }}
            </h3>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border">
            <p class="text-gray-500 text-lg mb-3">
                Total Pendapatan
            </p>

            <h3 class="text-5xl font-extrabold">
                Rp {{ number_format($totalPendapatan,0,',','.') }}
            </h3>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border">
            <p class="text-gray-500 text-lg mb-3">
                Menu Terlaris
            </p>

            <h3 class="text-3xl font-extrabold">
                {{ $menuTerlaris->first()->product_name ?? '-' }}
            </h3>
        </div>

    </div>

    <div class="bg-white rounded-3xl shadow-sm border p-8 mb-10">

        <h2 class="text-3xl font-bold text-gray-900 mb-6">
            Top 5 Menu Terlaris Keseluruhan
        </h2>

        <div class="space-y-4">

            @forelse($menuTerlaris as $menu)

                <div class="flex justify-between items-center border-b pb-3">

                    <p class="text-lg font-semibold text-gray-700">
                        {{ $menu->product_name }}
                    </p>

                    <p class="font-bold text-xl">
                        {{ $menu->total_qty }}x
                    </p>

                </div>

            @empty

                <p class="text-gray-500">
                    Belum ada data menu terlaris.
                </p>

            @endforelse

        </div>

    </div>

    @forelse($ordersByDate as $date => $orders)

        <div class="bg-white rounded-3xl shadow-sm border p-8 mb-10 day-section">

            <h2 class="text-3xl font-bold text-gray-900 mb-2">
                {{ \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('d F Y') }}
            </h2>

            <p class="text-gray-500 mb-8">
                Total transaksi: {{ $orders->count() }} order
            </p>

            <div class="space-y-6">

                @foreach($orders as $order)

                    <div class="border rounded-3xl p-6">

                        <div class="flex justify-between items-start">

                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">
                                    Order #{{ $order->id }}
                                </h3>

                                <p class="text-gray-500 mt-2">
                                    Nama Pemesan: {{ $order->customer_name }}
                                </p>

                                <p class="text-gray-500">
                                    Pembayaran: {{ $order->payment_method }}
                                </p>

                                <p class="text-gray-500">
                                    Jam: {{ $order->created_at->format('H:i') }}
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="text-gray-500">
                                    Total
                                </p>

                                <h3 class="text-3xl font-extrabold">
                                    Rp {{ number_format($order->total,0,',','.') }}
                                </h3>
                            </div>

                        </div>

                        <div class="mt-5 border-t pt-5 space-y-2">

                            @foreach($order->items as $item)

                                <div class="flex justify-between text-gray-700">

                                    <p>
                                        {{ $item->product_name }} x {{ $item->quantity }}
                                    </p>

                                    <p class="font-semibold">
                                        Rp {{ number_format($item->subtotal,0,',','.') }}
                                    </p>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    @empty

        <div class="bg-white rounded-3xl border p-10 text-center text-gray-500 font-semibold">
            Belum ada transaksi selesai.
        </div>

    @endforelse

</div>

<script>
    window.addEventListener('load', function () {
        window.print();
    });
</script>

</body>
</html>