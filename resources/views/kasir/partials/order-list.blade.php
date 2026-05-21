<div class="space-y-6">

    @forelse($orders as $order)

    <div class="bg-white rounded-3xl shadow border p-6">

        <div class="flex justify-between items-start mb-5">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Order #{{ $order->id }}
                </h2>

                <p class="text-gray-500 mt-2">
                    Nama Pemesan:
                    <span class="font-bold text-gray-900">
                        {{ $order->customer_name }}
                    </span>
                </p>
                <p class="text-gray-500">
                    Tanggal:
                    <span class="font-bold text-gray-900">
                        {{ $order->created_at->format('d M Y - H:i') }}
                    </span>
                </p>

                <p class="text-gray-500">
                    Pembayaran: {{ $order->payment_method }}
                </p>

                <p class="text-gray-500">
                    Status:
                    <span class="font-bold {{ $order->status == 'Selesai' ? 'text-green-600' : 'text-orange-500' }}">
                        {{ $order->status }}
                    </span>
                </p>
            </div>

            <div class="text-right">
                <p class="text-gray-500">Total</p>
                <h3 class="text-3xl font-extrabold text-blue-600">
                    Rp {{ number_format($order->total,0,',','.') }}
                </h3>
            </div>
        </div>

        <div class="border-t pt-4 space-y-3">
            @foreach($order->items as $item)
                <div class="flex justify-between text-gray-700">
                    <span>
                        {{ $item->product_name }} x {{ $item->quantity }}
                    </span>
                    <span class="font-bold">
                        Rp {{ number_format($item->subtotal,0,',','.') }}
                    </span>
                </div>
            @endforeach
        </div>

        @if($order->status != 'Selesai')

<div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-6">

    <form action="/kasir/orders/{{ $order->id }}/status" method="POST">
        @csrf
        <input type="hidden" name="status" value="Sedang Dibuat">

        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-4 rounded-2xl font-bold">
            Sedang Dibuat
        </button>
    </form>

    <form action="/kasir/orders/{{ $order->id }}/status" method="POST">
        @csrf
        <input type="hidden" name="status" value="Siap Diambil">

        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-4 rounded-2xl font-bold">
            Siap Diambil
        </button>
    </form>

    <form action="/kasir/orders/{{ $order->id }}/status" method="POST">
        @csrf
        <input type="hidden" name="status" value="Selesai">

        <button class="w-full bg-green-500 hover:bg-green-600 text-white py-4 rounded-2xl font-bold">
            Selesai
        </button>
    </form>

</div>

@endif

    </div>

    @empty

    <div class="bg-white rounded-3xl shadow p-10 text-center">
        <h2 class="text-2xl font-bold text-gray-700">
            Belum ada order masuk
        </h2>
    </div>

    @endforelse

</div>