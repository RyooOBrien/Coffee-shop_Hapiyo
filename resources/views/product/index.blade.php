<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#f8f9fb]">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 min-h-screen bg-white border-r p-8">

        <h1 class="text-4xl font-bold mb-12 text-gray-800">
            Hapiyo
        </h1>

        <ul class="space-y-4 text-lg text-gray-700 list-none p-0 m-0">

            <li>
                <a href="/admin"
                   class="block px-5 py-4 rounded-3xl hover:bg-blue-50 hover:text-blue-500 transition font-semibold">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="/product"
                   class="block px-5 py-4 rounded-3xl bg-blue-50 text-blue-500 font-bold">
                    Menu Kopi
                </a>
            </li>

            <li>
                <a href="/admin/orders"
                   class="block px-5 py-4 rounded-3xl hover:bg-blue-50 hover:text-blue-500 transition font-semibold">
                    Orders
                </a>
            </li>

            <li>
                <a href="/admin/laporan"
                   class="block px-5 py-4 rounded-3xl hover:bg-blue-50 hover:text-blue-500 transition font-semibold">
                    Laporan
                </a>
            </li>

            <li class="pt-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="w-full text-left px-5 py-4 rounded-3xl
                        text-red-500 hover:bg-red-50 font-semibold transition">
                        Logout
                    </button>
                </form>
            </li>

        </ul>

    </div>

    <!-- CONTENT -->
    <div class="flex-1 p-10">

        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-4xl font-extrabold text-gray-900">
                    Manajemen Produk
                </h1>

                <p class="text-gray-500 mt-2">
                    Kelola menu kopi, makanan, dan minuman.
                </p>
            </div>

            <a href="/product/create"
               class="bg-blue-500 hover:bg-green-600 text-white px-6 py-3 rounded-2xl font-bold shadow">
                + Tambah Produk
            </a>

        </div>

        <div class="bg-white rounded-3xl shadow-sm border overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-4 text-left">Gambar</th>
                        <th class="p-4 text-left">Nama</th>
                        <th class="p-4 text-left">Kategori</th>
                        <th class="p-4 text-left">Harga</th>
                        <th class="p-4 text-left">Diskon</th>
                        <th class="p-4 text-left">Harga Akhir</th>
                        <th class="p-4 text-left">Stock</th>
                        <th class="p-4 text-left">Deskripsi</th>
                        <th class="p-4 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)

                    @php
                    $discount = $product->discount ?? 0;
                    $finalPrice = max($product->price - $discount, 0);
                    @endphp

                    <tr class="border-b hover:bg-blue-50 transition">

                        <td class="p-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     class="w-20 h-20 object-cover rounded-xl shadow">
                            @else
                                <span class="text-gray-400">Tidak ada gambar</span>
                            @endif
                        </td>

                        <td class="p-4 font-bold text-gray-800">
                            {{ $product->name }}
                        </td>

                        <td class="p-4">
                            <span class="px-4 py-2 rounded-full text-sm font-bold bg-blue-50 text-blue-500">
                                {{ $product->category ?? 'Kopi' }}
                            </span>
                        </td>

                        <td class="p-4 font-semibold text-gray-700">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td class="p-4">
                            @if($discount > 0)
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-red-50 text-red-500 font-extrabold text-sm whitespace-nowrap">
                                - Rp {{ number_format($discount, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        <td class="p-4 font-extrabold text-green-600">
                            Rp {{ number_format($finalPrice, 0, ',', '.') }}
                        </td>

                        <td class="p-4">
                            {{ $product->stock }}
                        </td>

                        <td class="p-4 text-gray-600 max-w-[220px]">
                            <p class="line-clamp-2">
                            {{ $product->description }}
                            </p>
                        </td>

                        <td class="p-4">
                            <div class="flex gap-2">

                                <a href="/product/{{ $product->id }}/edit"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl">
                                    Edit
                                </a>

                                <form action="/product/{{ $product->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        onclick="return confirm('Yakin ingin hapus produk?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                    @endforeach
                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>