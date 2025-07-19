<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Belanja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto max-w-2xl p-4 pb-64">
        <h1 class="text-2xl font-bold text-center mb-6">TOTAL PESANAN ANDA :</h1>

        @if(session('success'))
            <div id="success-alert" class="bg-green-100 border-green-400 text-green-700 border px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="space-y-4">
            @php 
                $cart = (array) session('cart');
                $total = 0;
            @endphp
            @if(count($cart) > 0)
                @foreach($cart as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    
                    <div x-data="{ 
                            quantity: {{ $details['quantity'] }},
                            itemId: '{{ $id }}',
                            updateCart(newQuantity) {
                                if (newQuantity < 0) return;
                                fetch('{{ route('cart.update') }}', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content },
                                    body: JSON.stringify({ id: this.itemId, quantity: newQuantity })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if(data.success) {
                                        this.quantity = newQuantity;
                                        document.getElementById('total-price-value').innerText = 'Rp. ' + data.newTotal;
                                        if (newQuantity === 0) { document.getElementById('cart-item-' + this.itemId).remove(); }
                                        if (data.cartEmpty) { location.reload(); }
                                    }
                                });
                            }
                        }" 
                        id="cart-item-{{ $id }}"
                        class="bg-red-50 p-4 rounded-2xl flex items-center space-x-4">
                        
                        <img src="{{ $details['image'] ? asset('images/menus/' . $details['image']) : 'https://placehold.co/100x100' }}" alt="{{ $details['name'] }}" class="w-24 h-24 rounded-2xl object-cover">
                        <div class="flex-grow">
                            <h2 class="font-bold text-gray-800">{{ $details['name'] }}</h2>
                            <p class="text-gray-600">Rp. {{ number_format($details['price'], 0, ',', '.') }}</p>
                            <div class="flex items-center mt-2 border border-gray-300 rounded-lg w-min">
                                <button @click="updateCart(quantity - 1)" class="px-3 py-1" :disabled="quantity <= 0">-</button>
                                <span class="px-4 font-bold" x-text="quantity"></span>
                                <button @click="updateCart(quantity + 1)" class="px-3 py-1">+</button>
                            </div>
                        </div>
                        <button @click="updateCart(0)" class="bg-white text-red-500 rounded-full p-2 shadow">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endforeach
            @else
                <p class="text-center text-gray-500">Keranjang Anda kosong.</p>
            @endif
        </div>

        <div class="mt-8">
            <a href="{{ route('menu.index') }}" class="w-full text-center bg-yellow-400 text-gray-800 font-bold py-3 rounded-lg block hover:bg-yellow-500 transition">
                Pesan Lagi
            </a>
        </div>
    </div>

    @if(count($cart) > 0)
    <div class="fixed bottom-0 left-0 right-0 bg-orange-500 rounded-t-[50px] shadow-2xl">
        <div class="w-full max-w-2xl mx-auto text-gray-800 font-semibold 
                    flex flex-col items-center justify-center space-y-5 p-8">
            
            <div class="flex flex-col space-y-2 text-left w-full max-w-xs text-white">
                <div class="flex items-center space-x-3">
                    @if(session('customer_name'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <span>Nama Pelanggan : <span class="font-bold">{{ session('customer_name') }}</span></span>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        <span>Nomor Meja : <span class="font-bold">{{ session('table_number', 'N/A') }}</span></span>
                    @endif
                </div>
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2m0-10a9 9 0 110 18 9 9 0 010-18z" /></svg>
                    <span>TOTAL 
                        <span class="ml-12">:</span> 
                        <span id="total-price-value" class="ml-2">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </span>
                </div>
            </div>

            <div class="w-full max-w-xs">
                <a href="{{ route('payment.show') }}" class="w-full bg-white text-orange-600 font-bold py-3 px-6 rounded-full shadow-lg hover:bg-gray-200 transition-colors duration-300 flex items-center justify-center">
                    <span>Lanjutkan Pembayaran</span>
                    <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </a>
            </div>

            <div class="flex items-center text-xs pt-3 text-white/80">
                <span>POWERED BY</span>
                <span class="ml-2 text-xl font-black italic">F</span>
            </div>
        </div>
    </div>
    @endif
</body>
</html>