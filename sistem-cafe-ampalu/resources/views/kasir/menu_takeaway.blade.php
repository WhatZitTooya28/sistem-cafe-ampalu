<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu Pesanan Take Away</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

@php
    // Membaca dari sesi 'admin_cart' yang khusus untuk kasir
    $cart = (array) session('admin_cart');
    $initialTotalQuantity = 0;
    if (count($cart) > 0) {
        $initialTotalQuantity = array_sum(array_column($cart, 'quantity'));
    }
@endphp

<body class="bg-white" x-data="{ totalCartQuantity: {{ $initialTotalQuantity }} }" @cart-updated.window="totalCartQuantity += $event.detail.quantityChange">

    <div class="container mx-auto max-w-3xl">
        <header class="relative w-full">
            <img src="{{ asset('images/banner-cafe.jpg') }}" class="w-full h-48 object-cover rounded-b-3xl">
            <div class="absolute inset-0 bg-black/50 rounded-b-3xl flex items-center justify-center p-4">
                <div class="bg-black/40 backdrop-blur-sm text-white font-bold py-2 px-6 rounded-full border border-white/30">
                    Nama Pelanggan : {{ session('customer_name', 'Anonyme') }}
                </div>
            </div>
            <a href="{{ route('kasir.dashboard') }}" class="absolute top-4 left-4 bg-white/30 backdrop-blur-sm text-white rounded-full p-2 hover:bg-white/50 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
        </header>

        <nav class="sticky top-0 bg-white/80 backdrop-blur-md py-3 z-20 border-b border-gray-200 mt-4">
            <div class="overflow-x-auto no-scrollbar">
                <div class="max-w-3xl mx-auto flex items-center space-x-4 px-4">
                    <div class="flex items-center space-x-2 flex-shrink-0">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                        <span class="text-gray-800 font-bold whitespace-nowrap">KATEGORI</span>
                    </div>
                    <span class="text-gray-300">|</span>
                    @foreach($groupedMenus->keys() as $category)
                        <a href="#{{ Str::slug($category) }}" class="text-gray-600 font-semibold whitespace-nowrap hover:text-orange-500 transition-colors">{{ strtoupper($category) }}</a>
                    @endforeach
                </div>
            </div>
        </nav>

        <main class="px-4 py-6">
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 mb-6 rounded-lg">{{ session('success') }}</div>
            @endif

            @foreach($groupedMenus as $category => $menus)
            <section id="{{ Str::slug($category) }}" class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 pb-2 mb-4">{{ $category }}</h2>
                <div class="space-y-4">
                    @foreach($menus as $menu)
                        <div x-data="{ 
                                // Membaca dari sesi 'admin_cart'
                                quantity: {{ session('admin_cart.'.$menu->id.'.quantity', 0) }},
                                updateCart(newQuantity) {
                                    if (newQuantity < 0) return;
                                    
                                    let oldQuantity = this.quantity;
                                    this.quantity = newQuantity; 

                                    // Mengarah ke rute baru yang khusus untuk kasir
                                    fetch('{{ route('kasir.cart.takeaway.update') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content
                                        },
                                        body: JSON.stringify({
                                            id: '{{ $menu->id }}',
                                            quantity: newQuantity
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if(data.success) {
                                            this.$dispatch('cart-updated', { quantityChange: newQuantity - oldQuantity });
                                        } else {
                                            this.quantity = oldQuantity;
                                        }
                                    });
                                }
                            }" 
                            class="flex items-center justify-between border-b border-gray-100 py-4">
                            
                            <div>
                                <h3 class="font-bold text-gray-800">{{ $menu->name }}</h3>
                                <p class="font-semibold text-orange-500">Rp. {{ number_format($menu->price, 0, ',', '.') }}</p>
                            </div>

                            <div class="flex items-center space-x-4">
                                <button @click="updateCart(quantity - 1)" :disabled="quantity <= 0" class="w-8 h-8 rounded-full border border-gray-300 text-lg font-bold text-gray-500 disabled:opacity-50">-</button>
                                <span class="text-lg font-bold w-6 text-center" x-text="quantity"></span>
                                <button @click="updateCart(quantity + 1)" class="w-8 h-8 rounded-full border border-gray-300 text-lg font-bold text-gray-500">+</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endforeach
        </main>
    </div>

    <div class="fixed bottom-6 right-6 flex flex-col items-center space-y-4 z-30">
        <a href="#" class="w-12 h-12 bg-gray-800 text-white flex items-center justify-center rounded-full shadow-lg transform hover:scale-110 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
        </a>
        <a href="{{ route('kasir.cart.takeaway.index') }}" class="relative w-16 h-16 bg-yellow-400 flex items-center justify-center rounded-full shadow-lg transform hover:scale-110 transition-transform">
            <div x-show="totalCartQuantity > 0" x-transition class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center border-2 border-white" style="display: none;" x-text="totalCartQuantity"></div>
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </a>
    </div>
    
</body>
</html>