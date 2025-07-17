<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-200">

    <div class="max-w-md mx-auto p-4 py-8">
        
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            
            <header class="flex items-center p-4 border-b border-gray-100">
                <a href="{{ route('cart.index') }}" class="p-2 text-gray-500 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <h1 class="text-xl font-bold text-center flex-grow text-gray-800">Pembayaran</h1>
                <div class="w-8"></div> </header>

            <div x-data="{ paymentMethod: '' }">
                <main class="p-6">
                    <div class="bg-orange-100 text-orange-800 flex items-center justify-between py-2 px-4 rounded-full mb-6">
                        <span class="text-sm font-semibold">Tipe Pesanan</span>
                        <div class="flex items-center space-x-2">
                            <span class="font-bold">Makan di tempat</span>
                            <div class="bg-green-500 text-white w-5 h-5 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h2 class="font-semibold mb-4 text-gray-800">Informasi Pelanggan</h2>
                        @php 
                            $cart = session('cart', []);
                            $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
                        @endphp
                        <div class="space-y-3">
                            <div class="bg-gray-100 p-3 rounded-full flex items-center space-x-3 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                <p>Nomor Meja : <span class="font-bold">{{ session('table_number', 'N/A') }}</span></p>
                            </div>
                            <div class="bg-gray-100 p-3 rounded-full flex items-center space-x-3 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2m0-10a9 9 0 110 18 9 9 0 010-18z" /></svg>
                                <p>Total : <span class="font-bold">Rp. {{ number_format($total, 0, ',', '.') }}</span></p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-100">

                    <div>
                        <h2 class="font-semibold mb-4 text-gray-800">Metode Pembayaran</h2>
                        <form id="payment-form" action="{{ route('order.store') }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <label for="qris" class="border-2 border-gray-200 p-4 rounded-xl flex items-center justify-between cursor-pointer transition-all duration-200 transform hover:scale-[1.03] has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 has-[:checked]:scale-[1.02]">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-1.036.84-1.875 1.875-1.875h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 013.75 9.375v-4.5zM3.75 14.625c0-1.036.84-1.875 1.875-1.875h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 013.75 19.125v-4.5zM13.5 4.875c0-1.036.84-1.875 1.875-1.875h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 0113.5 9.375v-4.5z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 15.75h4.5a1.875 1.875 0 011.875 1.875v3.375c0 .517-.42.938-.937.938h-4.5" /></svg>
                                    <span class="font-semibold text-gray-700">QR Code</span>
                                </div>
                                <input x-model="paymentMethod" type="radio" id="qris" name="payment_method" value="qris" class="peer hidden">
                                <div class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center peer-checked:border-orange-500">
                                    <div class="w-3 h-3 bg-orange-500 rounded-full scale-0 peer-checked:scale-100 transition-transform"></div>
                                </div>
                            </label>

                            <label for="cashier" class="border-2 border-gray-200 p-4 rounded-xl flex items-center justify-between cursor-pointer transition-all duration-200 transform hover:scale-[1.03] has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 has-[:checked]:scale-[1.02]">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 mr-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75v10.5A2.25 2.25 0 004.5 19.5z" /></svg>
                                    <span class="font-semibold text-gray-700">Bayar Dikasir</span>
                                </div>
                                <input x-model="paymentMethod" type="radio" id="cashier" name="payment_method" value="cashier" class="peer hidden">
                                <div class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center peer-checked:border-orange-500">
                                    <div class="w-3 h-3 bg-orange-500 rounded-full scale-0 peer-checked:scale-100 transition-transform"></div>
                                </div>
                            </label>
                        </form>
                    </div>
                </main>

                <footer class="p-6">
                     <button 
                        type="submit" 
                        form="payment-form"
                        :disabled="paymentMethod === ''"
                        :class="{ 'opacity-50 cursor-not-allowed': paymentMethod === '' }"
                        class="w-full bg-orange-500 text-white font-bold py-4 px-6 rounded-full shadow-lg hover:bg-orange-600 transition-all duration-300 flex items-center justify-center disabled:hover:bg-orange-500">
                        <span>Bayar Sekarang</span>
                    </button>
                </footer>
            </div>
        </div>

    </div>

</body>
</html>