<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Cafe Ampalu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html, body { height: 100%; }
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url("{{ asset('images/cafe-background.jpg') }}");
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4" x-data="{ isDineInModalOpen: false, isTakeAwayModalOpen: false }">

    <div class="absolute inset-0 bg-black opacity-50"></div>

    <div class="w-full max-w-lg bg-gray-200 rounded-2xl shadow-lg overflow-hidden relative">
        <div class="absolute top-5 right-5 z-10">
            <a href="{{ route('login') }}" class="bg-white text-gray-800 font-semibold py-2 px-5 rounded-full shadow-md hover:bg-gray-100">login</a>
        </div>
        <div class="w-full">
            <img src="{{ asset('images/banner-cafe.jpg') }}" alt="Banner Cafe Ampalu" class="w-full h-64 object-cover rounded-t-2xl">
        </div>
        <div class="p-8 text-gray-800 text-center">
            <h1 class="text-2xl font-bold mb-4">Cara menggunakan SAC Order</h1>
            <div class="flex items-center justify-center mb-8">
                <img src="{{ asset('images/alur-pemesanan.png') }}" alt="Alur Pesan Bayar Makan" class="max-w-xs w-full h-auto">
            </div>
            <h2 class="text-lg font-bold mb-4">Anda ingin makan apa hari ini?</h2>
            <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                <button @click="isDineInModalOpen = true" class="bg-white text-gray-800 font-bold py-3 px-8 rounded-lg shadow-md hover:bg-gray-100 transform hover:scale-105 transition-all">
                    Makan di Tempat
                </button>
                <button @click="isTakeAwayModalOpen = true" class="bg-white text-gray-800 font-bold py-3 px-8 rounded-lg shadow-md hover:bg-gray-100 transform hover:scale-105 transition-all">
                    Bawa pulang
                </button>
            </div>
            <div class="mt-10">
                <p class="text-xs text-gray-400 font-semibold">Ampalu Cafe © 2025</p>
            </div>
        </div>
    </div>

    <div x-show="isDineInModalOpen" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" style="display: none;">
        <div @click.away="isDineInModalOpen = false" class="bg-white rounded-lg shadow-xl p-8 w-full max-w-sm">
            <h3 class="text-xl font-bold mb-4">Makan di Tempat</h3>
            <form action="{{ route('session.setTable') }}" method="POST">
                @csrf
                <label for="table_number" class="block text-sm font-medium text-gray-700">Nomor Meja</label>
                <input type="number" required min="1" name="table_number" id="table_number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500" placeholder="Masukkan Nomor Meja Anda">
                <button type="submit" class="mt-6 w-full bg-gray-800 text-white font-bold py-3 rounded-lg hover:bg-gray-900 transition-colors">Simpan</button>
            </form>
        </div>
    </div>

    <div x-show="isTakeAwayModalOpen" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" style="display: none;">
        <div @click.away="isTakeAwayModalOpen = false" class="bg-white rounded-lg shadow-xl p-8 w-full max-w-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Bawa Pulang</h3>
                <button @click="isTakeAwayModalOpen = false" class="text-gray-500 hover:text-gray-800 text-3xl">&times;</button>
            </div>
            <form action="{{ route('session.setCustomerName') }}" method="POST">
                @csrf
                <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Pemesan</label>
                <input type="text" required name="customer_name" id="customer_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500" placeholder="Masukkan Nama Anda">
                <button type="submit" class="mt-6 w-full bg-gray-800 text-white font-bold py-3 rounded-lg hover:bg-gray-900 transition-colors">Simpan</button>
            </form>
        </div>
    </div>

</body>
</html>