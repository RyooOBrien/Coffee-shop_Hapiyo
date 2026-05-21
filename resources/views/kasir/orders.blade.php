<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kasir Orders</title>

    @vite(['resources/css/app.css'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-[#f8f9fb] min-h-screen">

<div class="max-w-6xl mx-auto px-8 py-10">

    @php
        $totalOrder = $orders->count();
        $pendingOrder = $orders->where('status', 'Pending')->count();
        $selesaiOrder = $orders->where('status', 'Selesai')->count();
        $totalPendapatan = $orders->where('status', 'Selesai')->sum('total');
    @endphp

    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-5xl font-extrabold text-gray-900">
                Orders Kasir
            </h1>

            <p class="text-gray-500 mt-2">
                Daftar pesanan customer yang masuk.
            </p>
        </div>

        <div class="flex gap-4">

            <form id="closeForm" method="POST" action="/kasir/orders/close-today">
                @csrf

                <button type="button"
                    onclick="confirmClose()"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-2xl font-bold">
                    Close Hari Ini
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-2xl font-bold">
                    Logout
                </button>
            </form>

        </div>
    </div>

    <!-- STATISTIK DASHBOARD -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

        <div class="bg-white rounded-3xl shadow border p-6">
            <p class="text-gray-500 font-semibold">Total Order</p>
            <h2 class="text-4xl font-extrabold text-gray-900 mt-3">
                {{ $totalOrder }}
            </h2>
        </div>

        <div class="bg-white rounded-3xl shadow border p-6">
            <p class="text-gray-500 font-semibold">Pending</p>
            <h2 class="text-4xl font-extrabold text-black-500 mt-3">
                {{ $pendingOrder }}
            </h2>
        </div>

        <div class="bg-white rounded-3xl shadow border p-6">
            <p class="text-gray-500 font-semibold">Selesai</p>
            <h2 class="text-4xl font-extrabold text-black-600 mt-3">
                {{ $selesaiOrder }}
            </h2>
        </div>

        <div class="bg-white rounded-3xl shadow border p-6">
            <p class="text-gray-500 font-semibold">Pendapatan</p>
            <h2 class="text-3xl font-extrabold text-black-600 mt-3">
                Rp {{ number_format($totalPendapatan,0,',','.') }}
            </h2>
        </div>

    </div>

    <!-- ORDER LIST AUTO UPDATE -->
    <div id="order-list">
        @include('kasir.partials.order-list')
    </div>

</div>

<script>
function confirmClose() {
    Swal.fire({
        title: 'Close Order Hari Ini?',
        text: 'Semua order hari ini akan ditutup dan tidak tampil lagi di kasir.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Close!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        background: '#ffffff',
        customClass: {
            popup: 'rounded-3xl',
            title: 'font-bold',
            confirmButton: 'rounded-xl px-6 py-3',
            cancelButton: 'rounded-xl px-6 py-3'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('closeForm').submit();
        }
    });
}

function loadOrders() {
    fetch('/kasir/orders-live')
        .then(response => response.text())
        .then(html => {
            document.getElementById('order-list').innerHTML = html;
        })
        .catch(error => {
            console.log('Gagal mengambil data order:', error);
        });
}

setInterval(loadOrders, 3000);
</script>

</body>
</html>