@php
    $statusColor = match($order->status) {
        'Pending' => 'bg-gray-100 text-gray-700',
        'Sedang Dibuat' => 'bg-yellow-100 text-yellow-700',
        'Siap Diambil' => 'bg-blue-100 text-blue-700',
        'Selesai' => 'bg-green-100 text-green-700',
        default => 'bg-gray-100 text-gray-700'
    };
@endphp

<span class="{{ $statusColor }} px-4 py-2 rounded-2xl font-bold">
    {{ $order->status }}
</span>