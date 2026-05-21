<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Hapiyo Cafe</title>

    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-[#f8f9fb]">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 min-h-screen bg-white border-r p-8">

        <h1 class="text-3xl font-extrabold text-gray-700 mb-12">
            Hapiyo
        </h1>

        <ul class="space-y-3 text-lg text-gray-700 list-none p-0 m-0">

            <li>
                <a href="/admin"
                   class="block px-4 py-3 rounded-2xl bg-blue-50 text-blue-500 font-bold">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="/product"
                   class="block px-4 py-3 rounded-2xl hover:bg-blue-50 hover:text-blue-500 transition">
                    Menu Kopi
                </a>
            </li>

            <li>
                <a href="/admin/orders"
                   class="block px-4 py-3 rounded-2xl hover:bg-blue-50 hover:text-blue-500 transition">
                    Orders
                </a>
            </li>

            <li>
                <a href="/admin/laporan"
                   class="block px-4 py-3 rounded-2xl hover:bg-blue-50 hover:text-blue-500 transition">
                    Laporan
                </a>
            </li>

            <li class="pt-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-2xl
                        text-red-500 hover:bg-red-50 font-semibold transition">
                        Logout
                    </button>
                </form>
            </li>

        </ul>

    </div>

    <!-- CONTENT -->
    <div class="flex-1 p-10">

        <!-- HEADER -->
        <div class="mb-10">
            <h2 class="text-5xl font-extrabold text-gray-900">
                Dashboard Admin
            </h2>

            <p class="text-gray-500 mt-3 text-lg">
                Dashboard Orderan Hari Ini
            </p>
        </div>

        <!-- CARD STATS -->
        <div class="grid md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white rounded-3xl p-8 shadow-sm border hover:shadow-xl transition duration-300">
                <p class="text-gray-500 text-lg mb-3">Total Orders</p>

                <h3 class="text-5xl font-extrabold text-black-500">
                    {{ $totalOrderHariIni }}
                </h3>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-sm border hover:shadow-xl transition duration-300">
                <p class="text-gray-500 text-lg mb-3">Pendapatan</p>

                <h3 class="text-5xl font-extrabold text-black-500">
                    Rp {{ number_format($pendapatanHariIni,0,',','.') }}
                </h3>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-sm border hover:shadow-xl transition duration-300">
                <p class="text-gray-500 text-lg mb-3">Order Selesai</p>

                <h3 class="text-5xl font-extrabold text-black-500">
                    {{ $selesaiHariIni }}
                </h3>
            </div>

        </div>

        <!-- WELCOME CARD -->
        <div class="bg-white rounded-3xl p-10 shadow-sm border mb-10">

            <h3 class="text-3xl font-bold text-gray-900 mb-4">
                Selamat Datang Admin
            </h3>

            <p class="text-gray-500 text-lg leading-relaxed">
                Kelola menu kopi, transaksi, dan aktivitas cafe.
            </p>

        </div>

        <!-- GRAFIK PENJUALAN -->
        <div class="bg-white rounded-3xl shadow-sm border p-8 mb-10">

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900">
                    Grafik Penjualan
                </h2>

                <p class="text-gray-500 mt-2">
                    Statistik pendapatan cafe minggu ini
                </p>
            </div>

            <div class="h-[350px]">
                <canvas id="salesChart"></canvas>
            </div>

        </div>

        <!-- RECENT ORDERS -->
        <div class="bg-white rounded-3xl shadow-sm border p-8 mb-10">

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900">
                    Recent Orders
                </h2>

                <p class="text-gray-500 mt-2">
                    Order terbaru yang masuk ke sistem
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b text-gray-500">
                            <th class="py-4">Customer</th>
                            <th class="py-4">Menu</th>
                            <th class="py-4">Total</th>
                            <th class="py-4">Status</th>
                            <th class="py-4">Jam</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="py-5 font-semibold text-gray-800">
                                    {{ $order->customer_name }}
                                </td>

                                <td class="py-5 text-gray-600">
                                    @foreach($order->items as $item)
                                        <div>
                                            {{ $item->product_name }} x{{ $item->quantity }}
                                        </div>
                                    @endforeach
                                </td>

                                <td class="py-5 font-bold text-black-500">
                                    Rp {{ number_format($order->total,0,',','.') }}
                                </td>

                                <td class="py-5">
                                    @if($order->status == 'Selesai')
                                        <span class="px-4 py-2 rounded-full bg-green-100 text-green-600 font-bold text-sm">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-600 font-bold text-sm">
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                <td class="py-5 text-gray-500">
                                    {{ $order->created_at->format('H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500">
                                    Belum ada order terbaru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        <!-- PIE CHART MENU TERLARIS -->
        <div class="bg-white rounded-3xl shadow-sm border p-8">

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900">
                    Menu Terlaris
                </h2>

                <p class="text-gray-500 mt-2">
                    Statistik menu yang paling sering dipesan
                </p>
            </div>

            <div class="h-[400px] flex justify-center">
                <canvas id="pieChart"></canvas>
            </div>

        </div>

    </div>

</div>

<script>
    const ctx = document.getElementById('salesChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labelsGrafik),
            datasets: [{
                label: 'Pendapatan',
                data: @json($dataGrafik),
                borderWidth: 4,
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    const pieCtx = document.getElementById('pieChart');

    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: @json($pieLabels),
            datasets: [{
                data: @json($pieData),
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // AUTO REFRESH DASHBOARD SETIAP 10 DETIK
    setInterval(() => {
        location.reload();
    }, 5000);
</script>

</body>
</html>