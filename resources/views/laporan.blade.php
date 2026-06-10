<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Cafe - Hapiyo</title>

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
        }
    </style>
</head>

<body class="bg-[#f8f9fb] min-h-screen">

<div class="max-w-7xl mx-auto px-8 py-10 print-area">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">

        <div>
            <h1 class="text-5xl font-extrabold text-gray-900">
                Laporan Cafe
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Statistik penjualan dan aktivitas cafe.
            </p>
            @if($selectedDate)
                <p class="text-blue-500 mt-2 text-lg font-bold">
                    Laporan tanggal {{ \Carbon\Carbon::parse($selectedDate)->locale('id')->translatedFormat('d F Y') }}
                </p>
            @endif
        </div>

        <div class="flex gap-4 no-print">

            <a href="{{ route('admin.laporan.export-excel') }}"
            class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-2xl font-bold">
                Export Excel
            </a>

            <button onclick="window.print()"
                class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-2xl font-bold">
                Cetak Tanggal Ini
            </button>

            <a href="{{ route('admin.laporan.print-all') }}" target="_blank"
                class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded-2xl font-bold">
                Cetak Semua
            </a>
            <a href="/admin"
            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold">
                Kembali Dashboard
            </a>

        </div>

    </div>

    <!-- CARD STATS -->
    <div class="grid md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-3xl p-8 shadow-sm border">
            <p class="text-gray-500 text-lg mb-3">
                Total Orders
            </p>

            <h3 class="text-5xl font-extrabold text-black-500">
                {{ $totalOrders }}
            </h3>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border">
            <p class="text-gray-500 text-lg mb-3">
                Total Pendapatan
            </p>

            <h3 class="text-5xl font-extrabold text-black-500">
                Rp {{ number_format($totalPendapatan,0,',','.') }}
            </h3>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border">
            <p class="text-gray-500 text-lg mb-3">
                Menu Terlaris
            </p>

            <h3 class="text-3xl font-extrabold text-black-500">
                {{ $menuTerlaris->first()->product_name ?? '-' }}
            </h3>
        </div>

    </div>

    <!-- MENU TERLARIS -->
    <div class="bg-white rounded-3xl shadow-sm border p-8 mb-10">

        <h2 class="text-3xl font-bold text-gray-900 mb-6">
            Top 5 Menu Terlaris
        </h2>

        <div class="space-y-4">

            @foreach($menuTerlaris as $menu)

            <div class="flex justify-between items-center border-b pb-3">

                <p class="text-lg font-semibold text-gray-700">
                    {{ $menu->product_name }}
                </p>

                <p class="text-black-500 font-bold text-xl">
                    {{ $menu->total_qty }}x
                </p>

            </div>

            @endforeach

        </div>

    </div>

<!-- RIWAYAT TRANSAKSI -->
<div class="bg-white rounded-3xl shadow-sm border p-8">

    <h2 class="text-3xl font-bold text-gray-900 mb-8">
        Riwayat Transaksi
    </h2>

    <div class="space-y-6">

        @forelse($orders as $order)

        <div class="border rounded-3xl p-6">

            <div class="flex justify-between items-start">

                <div>

                    <h3 class="text-2xl font-bold text-gray-900">
                        Order #{{ $order->id }}
                    </h3>

                    <p class="text-gray-500 mt-2">
                        {{ $order->customer_name }}
                    </p>

                    <p class="text-gray-500">
                        {{ $order->created_at->locale('id')->translatedFormat('d F Y - H:i') }}
                    </p>

                </div>

                <div class="text-right">

                    <p class="text-gray-500">
                        Total
                    </p>

                    <h3 class="text-3xl font-extrabold text-black-500">
                        Rp {{ number_format($order->total,0,',','.') }}
                    </h3>

                </div>

            </div>

            <!-- ITEMS -->
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

        @empty

        <div class="text-center py-10 text-gray-500 font-semibold">
            Belum ada riwayat transaksi.
        </div>

        @endforelse

    </div>

    <!-- PAGINATION PER TANGGAL -->
    @if ($tanggalLaporan->hasPages())
        <div class="mt-10 flex flex-col items-center justify-center gap-4 no-print">

            <p class="text-gray-500 text-sm">
                Halaman {{ $tanggalLaporan->currentPage() }} dari {{ $tanggalLaporan->lastPage() }}
                tanggal laporan
            </p>

            <div class="flex items-center justify-center gap-2">

                {{-- Previous --}}
                @if ($tanggalLaporan->onFirstPage())
                    <span class="px-4 py-3 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed">
                        ‹
                    </span>
                @else
                    <a href="{{ $tanggalLaporan->previousPageUrl() }}"
                       class="px-4 py-3 rounded-xl bg-white border hover:bg-blue-50 text-gray-700 font-bold">
                        ‹
                    </a>
                @endif

                {{-- Nomor Halaman --}}
                @for ($page = 1; $page <= $tanggalLaporan->lastPage(); $page++)
                    @if ($page == $tanggalLaporan->currentPage())
                        <span class="px-4 py-3 rounded-xl bg-blue-500 text-white font-bold shadow">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $tanggalLaporan->url($page) }}"
                           class="px-4 py-3 rounded-xl bg-white border hover:bg-blue-50 text-gray-700 font-bold">
                            {{ $page }}
                        </a>
                    @endif
                @endfor

                {{-- Next --}}
                @if ($tanggalLaporan->hasMorePages())
                    <a href="{{ $tanggalLaporan->nextPageUrl() }}"
                       class="px-4 py-3 rounded-xl bg-white border hover:bg-blue-50 text-gray-700 font-bold">
                        ›
                    </a>
                @else
                    <span class="px-4 py-3 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed">
                        ›
                    </span>
                @endif

            </div>
        </div>
    @endif

</div>

</div>

</body>
</html>