<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#f8f9fb] p-10">

<div class="max-w-2xl mx-auto bg-white p-10 rounded-3xl shadow-sm border">

    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900">
            Tambah Produk
        </h1>

        <p class="text-gray-500 mt-2">
            Tambahkan menu kopi, makanan, atau minuman baru.
        </p>
    </div>

    <form action="/product/store" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- NAMA -->
        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">
                Nama Produk
            </label>

            <input type="text" name="name" placeholder="Contoh: Cappuccino"
                class="w-full border border-gray-300 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-400">
        </div>

        <!-- KATEGORI -->
        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">
                Kategori
            </label>

            <select name="category"
                class="w-full border border-gray-300 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-400">

                <option value="Kopi"> Kopi</option>
                <option value="Makanan"> Makanan</option>
                <option value="Minuman"> Minuman</option>
            </select>
        </div>

        <!-- HARGA -->
        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">
                Harga
            </label>

            <input type="number" name="price" placeholder="Harga Produk"
                class="w-full border border-gray-300 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-400">
        </div>
        <!-- DISKON -->
<div class="mb-5">
    <label class="block text-gray-700 font-bold mb-2">
        Diskon Harga
    </label>

    <input type="number" name="discount" placeholder="Contoh: 10"
        class="w-full border border-gray-300 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-400">

    <p class="text-sm text-gray-400 mt-2">
        Isi 0 jika tidak ada diskon
    </p>
</div>

<!-- BEST SELLER -->
<div class="mb-5 flex items-center gap-3">

    <input type="checkbox"
           name="best_seller"
           value="1"
           class="w-5 h-5">

    <label class="text-gray-700 font-bold">
        Jadikan Best Seller
    </label>

</div>

        <!-- STOK -->
        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">
                Stock
            </label>

            <input type="number" name="stock" placeholder="Jumlah Stock"
                class="w-full border border-gray-300 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-400">
        </div>

        <!-- DESKRIPSI -->
        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">
                Deskripsi
            </label>

            <textarea name="description" placeholder="Deskripsi produk"
                class="w-full border border-gray-300 p-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-400"></textarea>
        </div>

        <!-- GAMBAR -->
        <div class="mb-8">
            <label class="block text-gray-700 font-bold mb-2">
                Gambar Produk
            </label>

            <input type="file" name="image"
                class="w-full border border-gray-300 p-4 rounded-2xl">
        </div>

        <!-- BUTTON -->
        <button type="submit"
            class="w-full bg-green-500 hover:bg-green-600 text-white py-4 rounded-2xl text-lg font-bold transition">

            Simpan Produk

        </button>

    </form>

</div>

</body>
</html>