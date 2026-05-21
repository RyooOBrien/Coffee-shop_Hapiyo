<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#f8f9fb] p-10">

<div class="max-w-2xl mx-auto bg-white p-10 rounded-3xl shadow-sm border">

    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900">
            Edit Produk
        </h1>

        <p class="text-gray-500 mt-2">
            Ubah informasi menu Happiyo Cafe.
        </p>
    </div>

    <form action="/product/{{ $product->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- NAMA -->
        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">
                Nama Produk
            </label>

            <input type="text" name="name"
                value="{{ $product->name }}"
                class="w-full border border-gray-300 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <!-- HARGA -->
        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">
                Harga
            </label>

            <input type="number" name="price"
                value="{{ $product->price }}"
                class="w-full border border-gray-300 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <!-- DISKON -->
        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">
                Diskon (%)
            </label>

            <input type="number" name="discount"
                value="{{ $product->discount ?? 0 }}"
                class="w-full border border-gray-300 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-red-400">

            <p class="text-sm text-gray-400 mt-2">
                Isi 0 jika tidak ada diskon
            </p>
        </div>
        
        <!-- BEST SELLER -->
        <div class="mb-5 flex items-center gap-3">

        <input type="checkbox"
           name="best_seller"
           value="1"
           class="w-5 h-5"
           {{ $product->best_seller ? 'checked' : '' }}>

        <label class="text-gray-700 font-bold">
        Jadikan Best Seller
        </label>

        </div>

        <!-- STOCK -->
        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">
                Stock
            </label>

            <input type="number" name="stock"
                value="{{ $product->stock }}"
                class="w-full border border-gray-300 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <!-- DESKRIPSI -->
        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">
                Deskripsi
            </label>

            <textarea name="description"
                class="w-full border border-gray-300 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-400">{{ $product->description }}</textarea>
        </div>

        <!-- IMAGE PREVIEW -->
        @if($product->image)
            <div class="mb-5">
                <p class="text-gray-700 font-bold mb-3">
                    Gambar Saat Ini
                </p>

                <img src="{{ asset('storage/' . $product->image) }}"
                    class="w-36 h-36 object-cover rounded-2xl shadow">
            </div>
        @endif

        <!-- IMAGE -->
        <div class="mb-8">
            <label class="block text-gray-700 font-bold mb-2">
                Ganti Gambar
            </label>

            <input type="file" name="image"
                class="w-full border border-gray-300 p-4 rounded-2xl">
        </div>

        <!-- BUTTON -->
        <div class="flex gap-4">

            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-2xl font-bold transition shadow-lg">

                Update Produk

            </button>

            <a href="/product"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-4 rounded-2xl font-bold transition">
                Batal
            </a>

        </div>

    </form>

</div>

</body>
</html>