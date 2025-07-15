<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan: {{ $menu->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Memuat Alpine.js untuk interaktivitas --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center p-4 relative">

        <!-- Tombol Close di pojok kanan atas -->
        <a href="{{ route('menu.index') }}" class="absolute top-6 right-6 bg-gray-200 text-gray-800 rounded-full p-2 shadow-lg hover:bg-gray-300 z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>

        <!-- Kontainer Utama -->
        <div class="w-full max-w-lg" x-data="{ quantity: 1 }">
            <!-- Gambar Menu -->
            <div class="relative px-8">
                <img src="{{ $menu->image ? asset('images/menus/' . $menu->image) : 'https://placehold.co/800x600' }}" alt="{{ $menu->name }}" class="w-full h-auto rounded-3xl shadow-lg">
                <!-- Rating Bintang -->
                <div class="absolute -bottom-4 right-12 flex items-center bg-white px-3 py-1 rounded-full text-sm shadow-md">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <span class="ml-1 font-bold text-gray-800">4.8</span>
                </div>
            </div>

            <!-- Detail dan Aksi (Kartu terpisah) -->
            <div class="bg-white rounded-2xl shadow-xl mt-6 p-6 pt-10">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $menu->name }}</h1>
                        <p class="text-2xl font-bold text-gray-900 mt-1">Rp. {{ number_format($menu->price, 0, ',', '.') }}</p>
                    </div>
                    <span class="text-2xl font-bold text-gray-700" x-text="'x' + quantity"></span>
                </div>

                <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" :value="quantity">
                    <div class="my-6">
                        <label for="notes" class="text-xl font-bold text-gray-800">NOTES :</label>
                        <input type="text" name="notes" id="notes" placeholder="Tuliskan catatan untuk pesanan anda" class="mt-2 w-full border-gray-300 rounded-full shadow-sm focus:ring-yellow-500 focus:border-yellow-500 text-center py-3">
                    </div>

                    <div class="p-4 bg-yellow-400 rounded-2xl flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">Total Order:</p>
                            <p class="text-3xl font-bold text-gray-900" x-text="'Rp. ' + new Intl.NumberFormat('id-ID').format({{ $menu->price }} * quantity)"></p>
                        </div>
                        <div class="flex items-center space-x-3 bg-yellow-300 rounded-full p-1">
                            <button type="button" @click="if(quantity > 1) quantity--" class="bg-white rounded-full w-10 h-10 flex items-center justify-center text-xl font-bold shadow">-</button>
                            <span class="text-2xl font-bold w-8 text-center" x-text="quantity"></span>
                            <button type="button" @click="quantity++" class="bg-white rounded-full w-10 h-10 flex items-center justify-center text-xl font-bold shadow">+</button>
                        </div>
                    </div>
                    <button type="submit" class="mt-4 w-full bg-gray-800 text-white font-bold py-3 rounded-lg hover:bg-gray-900 transition-colors">
                        Tambah Pesanan
                    </button>
                </form>
            </div>
            <!-- Footer -->
            <div class="text-center mt-4">
               <p class="text-xs text-gray-400 font-semibold">POWERED BY F</p>
            </div>
        </div>
    </div>
</body>
</html>