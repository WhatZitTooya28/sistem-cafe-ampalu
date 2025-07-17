<!DOCTYPE html>
<html lang="id">
<head>
    <title>Menu Pesanan Take Away</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto max-w-3xl">
        <!-- Header -->
        <div class="relative p-4 mt-4">
            <img src="{{ asset('images/banner-cafe.jpg') }}" class="w-full h-40 object-cover rounded-2xl shadow-lg">
            <div class="absolute inset-4 bg-black/30 rounded-2xl flex items-center justify-center p-4">
                <div class="bg-white/80 backdrop-blur-sm text-gray-800 font-bold py-3 px-8 rounded-lg shadow-md">
                    Nama Pelanggan : {{ session('customer_name', 'N/A') }}
                </div>
            </div>
            <a href="{{ route('kasir.dashboard') }}" class="absolute top-6 left-6 bg-white/80 rounded-full p-2 hover:bg-white transition-colors">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
        </div>

        <!-- Daftar Menu -->
        <div class="px-4 py-6">
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 mb-6 rounded-lg">{{ session('success') }}</div>
            @endif

            @foreach($groupedMenus as $category => $menus)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4">{{ $category }}</h2>
                <div class="space-y-4">
                    @foreach($menus as $menu)
                        <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between" x-data="{ quantity: {{ session('cart.'.$menu->id.'.quantity', 0) }} }">
                            <div>
                                <h3 class="font-bold">{{ $menu->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $menu->description }}</p>
                                <p class="font-semibold text-yellow-600">Rp. {{ number_format($menu->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex items-center space-x-2 border border-gray-300 rounded-full">
                                <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $menu->id }}">
                                    <input type="hidden" name="quantity" :value="quantity - 1">
                                    <button type="submit" class="px-3 py-1 font-bold text-lg" :disabled="quantity <= 0">-</button>
                                </form>
                                <span class="px-2 font-bold" x-text="quantity"></span>
                                <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $menu->id }}">
                                    <input type="hidden" name="quantity" :value="quantity + 1">
                                    <button type="submit" class="px-3 py-1 font-bold text-lg">+</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

         <!-- Tombol Keranjang Mengambang -->
        <a href="{{ route('cart.index') }}" class="fixed bottom-6 right-6 bg-yellow-400 p-4 rounded-full shadow-lg transform hover:scale-110 transition-transform">
            @if(session('cart') && count(session('cart')) > 0)
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center">
                    {{ array_sum(array_column(session('cart'), 'quantity')) }}
                </span>
            @endif
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </a>
    </div>
</body>
</html>