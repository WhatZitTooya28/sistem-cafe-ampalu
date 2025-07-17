<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Cafe Ampalu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Alpine.js tidak lagi dibutuhkan di halaman ini karena pop-up dihilangkan --}}
    <style>
        html { scroll-behavior: smooth; }
        /* Menambahkan style untuk menyembunyikan scrollbar di navigasi kategori */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- Header -->
    <div class="container mx-auto max-w-3xl pt-8 px-4">
        <div class="relative p-4 bg-white rounded-2xl shadow-lg">
            <img src="{{ asset('images/banner-menu.jpg') }}" class="w-full h-40 object-cover rounded-2xl">
            <div class="absolute inset-4 bg-black/30 rounded-2xl flex items-end justify-center p-4">
                @if(session('table_number'))
                    <div class="bg-gray-100/90 backdrop-blur-sm text-gray-800 font-bold py-3 px-8 rounded-lg shadow-md">
                        NOMOR MEJA ANDA : {{ session('table_number') }}
                    </div>
                @endif
            </div>
            <a href="/" class="absolute top-6 left-6 bg-white/80 rounded-full p-2 hover:bg-white transition-colors"><svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg></a>
            <div class="absolute top-6 right-6 flex space-x-2">
                <a href="#" class="bg-white/80 rounded-full p-2 hover:bg-white transition-colors"><svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg></a>
                <a href="#" class="bg-white/80 rounded-full p-2 hover:bg-white transition-colors"><svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></a>
                <a href="#" class="bg-white/80 rounded-full p-2 hover:bg-white transition-colors"><svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></a>
            </div>
        </div>
    </div>

    <!-- Navigasi Kategori -->
    <div class="sticky top-0 bg-gray-50 py-3 z-30 border-b border-t border-gray-200 mt-6">
        <div class="overflow-x-auto no-scrollbar">
            <div class="max-w-3xl mx-auto flex items-center space-x-4 px-4">
                <div class="flex items-center space-x-2 flex-shrink-0">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    <span class="text-gray-800 font-bold whitespace-nowrap">KATEGORI</span>
                </div>
                @foreach($groupedMenus->keys() as $category)
                    <span class="text-gray-300">|</span>
                    <a href="#{{ Str::slug($category) }}" class="text-gray-600 font-semibold whitespace-nowrap hover:text-green-600">{{ strtoupper($category) }}</a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Konten Menu -->
    <div class="container mx-auto max-w-3xl px-4">
        <div class="pt-6" id="semua">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @foreach($groupedMenus as $category => $menus)
                <div id="{{ Str::slug($category) }}" class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4">{{ $category }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($menus as $menu)
                            <!-- Desain Kartu Menu -->
                            <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col">
                                <img src="{{ $menu->image ? asset('images/menus/' . $menu->image) : 'https://placehold.co/300x300' }}" alt="{{ $menu->name }}" class="w-full h-40 object-cover rounded-xl mb-4">
                                <h3 class="text-lg font-bold text-gray-800 text-center mb-2">{{ $menu->name }}</h3>
                                <div class="mt-auto flex justify-between items-center">
                                    <p class="text-lg font-bold text-gray-900">Rp. {{ number_format($menu->price, 0, ',', '.') }}</p>
                                    <a href="{{ route('menu.detail', $menu->id) }}" class="bg-white text-green-600 font-bold py-1 px-4 rounded-full border-2 border-green-600 hover:bg-green-600 hover:text-white transition-colors">
                                        Tambah
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Tombol Keranjang Mengambang -->
    <a href="{{ route('cart.index') }}" class="fixed bottom-6 right-6 bg-yellow-400 p-4 rounded-full shadow-lg transform hover:scale-110 transition-transform z-40">

        @php
            // Menghitung total kuantitas dari semua item di keranjang
            $cart = (array) session('cart');
            $totalCartQuantity = 0;
            if (count($cart) > 0) {
                $totalCartQuantity = array_sum(array_column($cart, 'quantity'));
            }
        @endphp

        {{-- Menampilkan notifikasi jika ada item di keranjang --}}
        @if($totalCartQuantity > 0)
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center">
                {{ $totalCartQuantity }}
            </span>
        @endif

        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
    </a>

    
    {{-- Kode pop-up modal sudah tidak diperlukan lagi di sini karena kita menggunakan halaman detail terpisah --}}

</body>
</html>
