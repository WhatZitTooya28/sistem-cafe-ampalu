<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Cafe Ampalu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50" x-data="{ isSearchOpen: false, isNotificationOpen: false, isSidebarOpen: false, searchTerm: '' }">
    
    <div class="container mx-auto max-w-3xl pt-8 px-4">
        <div class="relative p-4 bg-white rounded-2xl shadow-lg">
            <img src="{{ asset('images/banner-menu.jpg') }}" class="w-full h-40 object-cover rounded-2xl">
            
            <div class="absolute inset-4 bg-black/30 rounded-2xl flex items-end justify-center p-4">
                @if(session('table_number'))
                    <div class="bg-gray-100/90 backdrop-blur-sm text-gray-800 font-bold py-3 px-8 rounded-lg shadow-md">
                        NOMOR MEJA ANDA : {{ session('table_number') }}
                    </div>
                @elseif(session('customer_name'))
                    <div class="bg-gray-100/90 backdrop-blur-sm text-gray-800 font-bold py-3 px-8 rounded-lg shadow-md">
                        NAMA PEMESAN : {{ session('customer_name') }}
                    </div>
                @endif
            </div>

            <a href="/" class="absolute top-6 left-6 bg-white/80 rounded-full p-2 hover:bg-white transition-colors"><svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
            
            <div class="absolute top-6 right-6 flex space-x-2">
                <div class="relative">
                    <button @click="isNotificationOpen = !isNotificationOpen" class="bg-white/80 rounded-full p-2 hover:bg-white transition-colors"><svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg></button>
                    <div x-show="isNotificationOpen" @click.away="isNotificationOpen = false" x-transition class="absolute top-14 right-0 bg-white shadow-xl rounded-xl border w-80 text-sm z-40" style="display: none;">
                        <div class="p-4">
                            <p class="font-bold text-gray-800 mb-3">Status Pesanan Terakhir</p>
                            @if($latestOrder)
                                @php
                                    $statusText = ucwords(str_replace('_', ' ', $latestOrder->status));
                                    $statusClasses = [
                                        'menunggu_pembayaran' => ['color' => 'yellow', 'icon' => '<svg class="w-5 h-5 text-yellow-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'],
                                        'proses' => ['color' => 'blue', 'icon' => '<svg class="w-5 h-5 text-blue-500 flex-shrink-0 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.096 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>'],
                                        'siap_diambil' => ['color' => 'green', 'icon' => '<svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'],
                                    ];
                                    $config = $statusClasses[$latestOrder->status] ?? ['color' => 'gray', 'icon' => ''];
                                    $colorClass = "bg-{$config['color']}-100 text-{$config['color']}-800";
                                @endphp
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                    {!! $config['icon'] !!}
                                    <span class="font-semibold px-3 py-1 rounded-full text-xs {{ $colorClass }}">{{ $statusText }}</span>
                                </div>
                            @else
                                <p class="text-gray-600">Anda belum memiliki pesanan aktif.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <button @click="isSearchOpen = !isSearchOpen" class="bg-white/80 rounded-full p-2 hover:bg-white transition-colors"><svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
                <button @click="isSidebarOpen = true" class="bg-white/80 rounded-full p-2 hover:bg-white transition-colors"><svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
            </div>
        </div>
    </div>

    <div class="sticky top-0 bg-gray-50/95 backdrop-blur-sm py-3 z-20 border-b border-t border-gray-200 mt-6">
        <div x-show="isSearchOpen" x-transition class="max-w-3xl mx-auto px-4 pb-3">
            <input type="text" x-model="searchTerm" placeholder="Cari menu favoritmu..." class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div class="overflow-x-auto no-scrollbar">
            <div class="max-w-3xl mx-auto flex items-center space-x-4 px-4">
                <div class="flex items-center space-x-2 flex-shrink-0"><svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg><span class="text-gray-800 font-bold whitespace-nowrap">KATEGORI</span></div>
                @foreach($groupedMenus->keys() as $category)
                    <span class="text-gray-300">|</span><a href="#{{ Str::slug($category) }}" class="text-gray-600 font-semibold whitespace-nowrap hover:text-green-600">{{ strtoupper($category) }}</a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container mx-auto max-w-3xl px-4">
        <div class="pt-6" id="semua">
            @if(session('success'))<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg" role="alert"><p class="font-bold">Sukses</p><p>{{ session('success') }}</p></div>@endif
            @foreach($groupedMenus as $category => $menus)
                <div id="{{ Str::slug($category) }}" class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4">{{ $category }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($menus as $menu)
                            <div x-show="searchTerm === '' || '{{ strtolower($menu->name) }}'.includes(searchTerm.toLowerCase())" x-transition class="bg-white rounded-2xl shadow-md p-4 flex flex-col">
                                <img src="{{ $menu->image ? asset('images/menus/' . $menu->image) : 'https://placehold.co/300x300' }}" alt="{{ $menu->name }}" class="w-full h-40 object-cover rounded-xl mb-4">
                                <h3 class="text-lg font-bold text-gray-800 text-center mb-2">{{ $menu->name }}</h3>
                                <div class="mt-auto flex justify-between items-center">
                                    <p class="text-lg font-bold text-gray-900">Rp. {{ number_format($menu->price, 0, ',', '.') }}</p>
                                    <a href="{{ route('menu.detail', $menu->id) }}" class="bg-white text-green-600 font-bold py-1 px-4 rounded-full border-2 border-green-600 hover:bg-green-600 hover:text-white transition-colors">Tambah</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <a href="{{ route('cart.index') }}" class="fixed bottom-6 right-6 bg-yellow-400 p-4 rounded-full shadow-lg transform hover:scale-110 transition-transform z-40">
        @php $totalCartQuantity = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0; @endphp
        @if($totalCartQuantity > 0)<span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center">{{ $totalCartQuantity }}</span>@endif
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
    </a>

    <div x-show="isSidebarOpen" class="fixed inset-0 z-50 flex" style="display:none;">
        <div @click="isSidebarOpen = false" class="fixed inset-0 bg-black/50" x-show="isSidebarOpen" x-transition:enter="transition-opacity ease-in-out duration-300" x-transition:enter-start="opacity-0" x-transition:leave="transition-opacity ease-in-out duration-300" x-transition:leave-end="opacity-0"></div>
        <div class="relative w-72 max-w-[80vw] bg-white p-6 flex flex-col" x-show="isSidebarOpen" x-transition:enter="transition ease-in-out duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
            <button @click="isSidebarOpen = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gray-200 rounded-full mx-auto flex items-center justify-center mb-3"><svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg></div>
                <h2 class="font-bold text-lg">Hai, {{ session('customer_name') ?: 'Table '.session('table_number', 'N/A') }}</h2>
            </div>
            <nav class="space-y-3">
                <a href="{{ route('order.history') }}" class="flex items-center space-x-3 p-3 bg-gray-100 rounded-lg text-gray-700 font-semibold"><img src="https://api.iconify.design/material-symbols/receipt-long-outline.svg?color=%23888888" class="w-6 h-6"><span>Order History</span></a>
                <a href="{{ route('order.status') }}" class="flex items-center space-x-3 p-3 bg-gray-100 rounded-lg text-gray-700 font-semibold"><img src="https://api.iconify.design/icon-park-outline/handle-right.svg?color=%23888888" class="w-6 h-6"><span>Status Orders</span></a>
                <a href="{{ route('rating.latest') }}" class="flex items-center space-x-3 p-3 bg-gray-100 rounded-lg text-gray-700 font-semibold"><img src="https://api.iconify.design/material-symbols/hotel-class-outline-rounded.svg?color=%23888888" class="w-6 h-6"><span>Rating menu</span></a>
            </nav>
            <div class="mt-auto flex justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
            </div>
        </div>
    </div>

</body>
</html>