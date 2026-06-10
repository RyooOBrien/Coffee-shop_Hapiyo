<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Orders - Hapiyo Cafe</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#f8f9fb] min-h-screen">

<div class="max-w-7xl mx-auto px-8 py-10">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">

        <div>
            <h1 class="text-5xl font-extrabold text-gray-900">
                Riwayat Orders
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Semua data pesanan cafe tersimpan di sini.
            </p>
        </div>

        <a href="/admin"
           class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold">
            Kembali Dashboard
        </a>

    </div>

    <!-- LIST ORDERS -->
    <div class="space-y-6">

        @php
    $currentDate = null;
@endphp

@forelse($orders as $order)

    @php
        $orderDate = $order->created_at->locale('id')->translatedFormat('d F Y');
    @endphp

    @if($currentDate !== $orderDate)
        <div class="mt-10 mb-4">
            <h2 class="text-2xl font-extrabold text-gray-800">
                {{ $orderDate }}
            </h2>
            <p class="text-gray-500">
                Riwayat pesanan pada tanggal ini
            </p>
        </div>

        @php
            $currentDate = $orderDate;
        @endphp
    @endif
        <div class="bg-white rounded-3xl shadow-sm border p-8">

            <div class="flex justify-between items-start">

                <div>

                    <h2 class="text-2xl font-bold text-gray-900 mb-4">
                        Order #{{ $order->id }}
                    </h2>

                    <p class="text-gray-500">
                        Nama Pemesan:
                        <span class="font-bold text-gray-900">
                            {{ $order->customer_name }}
                        </span>
                    </p>

                    <p class="text-gray-500 mt-1">
                        Pembayaran:
                        <span class="font-semibold">
                            {{ $order->payment_method }}
                        </span>
                    </p>

                    <p class="text-gray-500 mt-1">
                        Tanggal:
                        <span class="font-semibold text-gray-900">
                            {{ $order->created_at->locale('id')->translatedFormat('d F Y - H:i') }}
                        </span>
                    </p>

                    <p class="text-gray-500 mt-1">
                        Status:
                        <span class="font-bold {{ $order->status == 'Selesai' ? 'text-green-600' : 'text-orange-500' }}">
                            {{ $order->status }}
                        </span>
                    </p>

                    <p class="text-gray-500 mt-1">
                        Closed:
                        <span class="font-semibold">
                            {{ $order->closed_at ? $order->closed_at->locale('id')->translatedFormat('d F Y - H:i') : 'Belum Close' }}
                        </span>
                    </p>

                </div>

                <div class="text-right">

                    <p class="text-gray-500">
                        Total
                    </p>

                    <h3 class="text-4xl font-extrabold text-blue-600">
                        Rp {{ number_format($order->total,0,',','.') }}
                    </h3>

                </div>

            </div>

            <!-- ITEM -->
            <div class="mt-6 border-t pt-5 space-y-2">

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

        <div class="bg-white rounded-3xl shadow-sm border p-10 text-center">

            <h2 class="text-3xl font-bold text-gray-700 mb-3">
                Belum Ada Order
            </h2>

            <p class="text-gray-500">
                Riwayat pesanan masih kosong.
            </p>

        </div>

        @endforelse
        <div class="mt-10 flex flex-col items-center justify-center gap-4">

    <p class="text-gray-500 text-sm">
        Menampilkan {{ $orders->firstItem() }} sampai {{ $orders->lastItem() }}
        dari {{ $orders->total() }} order
    </p>

    <div class="flex items-center justify-center gap-2">

        {{-- Tombol Previous --}}
        @if ($orders->onFirstPage())
            <span class="px-4 py-3 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed">
                ‹
            </span>
        @else
            <a href="{{ $orders->previousPageUrl() }}"
               class="px-4 py-3 rounded-xl bg-white border hover:bg-blue-50 text-gray-700 font-bold">
                ‹
            </a>
        @endif

        {{-- Nomor Halaman --}}
        @for ($page = 1; $page <= $orders->lastPage(); $page++)
            @if ($page == $orders->currentPage())
                <span class="px-4 py-3 rounded-xl bg-blue-500 text-white font-bold shadow">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $orders->url($page) }}"
                   class="px-4 py-3 rounded-xl bg-white border hover:bg-blue-50 text-gray-700 font-bold">
                    {{ $page }}
                </a>
            @endif
        @endfor

        {{-- Tombol Next --}}
        @if ($orders->hasMorePages())
            <a href="{{ $orders->nextPageUrl() }}"
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

    </div>

</div>

</body>
</html>