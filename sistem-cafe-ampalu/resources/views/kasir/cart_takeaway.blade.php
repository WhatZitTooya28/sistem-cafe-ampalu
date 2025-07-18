<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto max-w-md p-4 pb-48">
        <header class="flex items-center mb-6">
            <a href="{{ route('kasir.menu.takeaway') }}" class="p-2 -ml-2 text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h1 class="text-xl font-bold text-center flex-grow text-gray-800">Pesanan</h1>
            <div class="w-6"></div> </header>

        <div class="space-y-4">
            @php 
                $cart = (array) session('admin_cart');
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
                                
                                fetch('{{ route('kasir.cart.takeaway.update') }}', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content },
                                    body: JSON.stringify({ id: this.itemId, quantity: newQuantity })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if(data.success) {
                                        this.quantity = newQuantity;
                                        window.dispatchEvent(new CustomEvent('update-total'));
                                        if (newQuantity === 0) { document.getElementById('cart-item-' + this.itemId).remove(); }
                                        if (data.cartEmpty) { location.reload(); }
                                    }
                                });
                            }
                        }" 
                        id="cart-item-{{ $id }}"
                        class="bg-red-50 p-4 rounded-2xl flex items-center justify-between">
                        
                        <div>
                            <h2 class="font-bold text-gray-800">{{ $details['name'] }}</h2>
                            <p class="font-semibold text-yellow-600">Rp. {{ number_format($details['price'], 0, ',', '.') }}</p>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button @click="updateCart(quantity + 1)" class="px-3 py-1 font-bold text-gray-600">+</button>
                                <span class="px-4 font-bold text-gray-800" x-text="quantity"></span>
                                <button @click="updateCart(quantity - 1)" :disabled="quantity <= 0" class="px-3 py-1 font-bold text-gray-600 disabled:opacity-50">-</button>
                            </div>
                            <button @click="updateCart(0)" class="bg-white text-red-500 rounded-full p-2 shadow-md hover:bg-red-50 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
                 <div class="mt-8">
                    <a href="{{ route('kasir.menu.takeaway') }}" class="w-full text-center bg-yellow-400 text-gray-800 font-bold py-3 rounded-lg block hover:bg-yellow-500 transition">
                        Pesan Lagi
                    </a>
                </div>
            @else
                <div class="text-center py-16">
                    <h3 class="mt-2 text-lg font-medium text-gray-900">Keranjang Anda Kosong.</h3>
                </div>
            @endif
        </div>
    </div>

    @if(count($cart) > 0)
    <div x-data="{}" @update-total.window="window.location.reload()">
        <div class="fixed bottom-0 left-0 right-0 bg-orange-500 rounded-t-[50px] shadow-2xl">
            <div class="w-full max-w-2xl mx-auto text-white font-semibold 
                        flex flex-col items-center justify-center space-y-5 p-8">
                
                <div class="flex flex-col space-y-2 text-left w-full max-w-xs">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <span>Nama Pelanggan : <span class="font-bold">{{ session('customer_name', 'Anonyme') }}</span></span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2m0-10a9 9 0 110 18 9 9 0 010-18z" /></svg>
                        <span>TOTAL <span class="ml-12">:</span> <span class="font-bold ml-2">Rp. {{ number_format($total, 0, ',', '.') }}</span></span>
                    </div>
                </div>

                <form action="{{ route('order.store.takeaway') }}" method="POST" class="w-full max-w-xs">
                    @csrf
                    <button type="submit" class="w-full bg-white text-orange-600 font-bold py-3 px-6 rounded-full shadow-lg hover:bg-gray-200 transition-colors duration-300 flex items-center justify-center">
                        <span>Sudah Bayar</span>
                        <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
</body>
</html>