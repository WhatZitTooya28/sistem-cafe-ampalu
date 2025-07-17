<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - {{ $menu->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center p-4 relative" x-data="{ quantity: 1 }">

        <!-- Tombol Close -->
        <a href="{{ route('menu.index') }}" class="absolute top-6 right-6 bg-white text-gray-700 rounded-full p-2 shadow-md hover:bg-gray-200 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </a>

        <div class="w-full max-w-md text-center">
            <!-- Gambar Menu -->
            <div class="relative">
                <img src="{{ $menu->image ? asset('images/menus/' . $menu->image) : 'https://placehold.co/500x500' }}" alt="{{ $menu->name }}" class="w-full h-[300px] object-cover rounded-[30px] shadow-md mx-auto" style="object-position: center;">

                <!-- Badge rating -->
                <div class="absolute bottom-3 right-3 bg-white px-2 py-1 rounded-full flex items-center shadow text-sm font-semibold">
                    <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span>{{ number_format($menu->rating ?? 4.8, 1) }}</span>
                </div>
            </div>

            <!-- Nama & Harga -->
            <div class="mt-4 bg-white px-4 py-3 rounded-xl shadow-sm">
                <div class="flex justify-between items-center">
                    <p class="italic text-base text-gray-800 font-medium">{{ $menu->name }}</p>
                    <span class="text-sm font-semibold text-gray-700">1x</span>
                </div>
                <p class="text-[15px] font-bold text-gray-900 mt-1">Rp. {{ number_format($menu->price, 0, ',', '.') }}</p>
            </div>


            <!-- Notes -->
            <form action="{{ route('cart.add', $menu->id) }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="quantity" :value="quantity">
                <label class="block text-left text-gray-800 font-semibold mb-1 ml-1">NOTES :</label>
                <input type="text" name="notes" placeholder="tuliskan catatan untuk pesanan anda"
                    class="w-full px-4 py-2 rounded-full border border-gray-300 text-sm focus:ring-yellow-400 focus:border-yellow-400 text-center shadow-sm">

                <!-- Total Order & Tombol + - -->
                <div class="mt-5 bg-yellow-400 text-left rounded-3xl px-6 py-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-700 font-semibold mb-1">total order :</p>
                        <p class="text-xl font-extrabold text-gray-900" x-text="'Rp. ' + new Intl.NumberFormat('id-ID').format({{ $menu->price }} * quantity)"></p>
                    </div>
                    <div class="flex items-center bg-yellow-300 rounded-full px-2 py-1 space-x-3">
                        <button type="button" @click="if(quantity > 1) quantity--" class="bg-white w-8 h-8 rounded-full text-xl font-bold flex items-center justify-center shadow">-</button>
                        <span class="text-md font-semibold" x-text="quantity"></span>
                        <button type="button" @click="quantity++" class="bg-white w-8 h-8 rounded-full text-xl font-bold flex items-center justify-center shadow">+</button>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="mt-4 w-full py-3 bg-gray-800 text-white rounded-full font-bold hover:bg-gray-900 transition">
                    Tambah Pesanan
                </button>
            </form>
        </div>
    </div>

</body>
</html>
