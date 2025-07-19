<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-100">

    <div class="max-w-md mx-auto p-4">
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
            
            <header class="flex items-center p-4 border-b">
                <a href="{{ route('payment.show') }}" class="p-2">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <h1 class="text-xl font-bold text-center flex-grow text-gray-800">Ringkasan Pesanan</h1>
            </header>

            <main class="p-6 text-center" x-data="{ open: false }">
                <div class="bg-red-50 text-red-800 flex items-center justify-between py-2 px-4 rounded-full mb-6 border border-red-200">
                    <span class="text-sm font-semibold">Tipe Pesanan</span>
                    <div class="flex items-center space-x-2">
                        <span class="font-bold">{{ session('customer_name') ? 'Bawa Pulang' : 'Makan di Tempat' }}</span>
                        <div class="bg-green-500 text-white w-5 h-5 rounded-full flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div>
                    </div>
                </div>

                <div class="mb-4">
                    <img src="{{ $qrCodeUrl }}" alt="QR Code Pesanan" class="w-48 h-48 mx-auto rounded-lg">
                </div>
                
                <div class="bg-yellow-100 text-yellow-800 p-3 rounded-lg flex items-center justify-center space-x-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.21 3.03-1.742 3.03H4.42c-1.532 0-2.492-1.696-1.742-3.03l5.58-9.92zM10 13a1 1 0 110-2 1 1 0 010 2zm-1-8a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <span class="font-semibold">Tunjukkan QR pada Kasir</span>
                </div>

                <div class="border-t my-6"></div>
                
                <div class="bg-gray-50 p-4 rounded-lg text-left">
                     @php $totalProducts = $order->orderItems->sum('quantity'); @endphp
                     <div class="space-y-2">
                        <div class="flex justify-between items-baseline">
                            <span class="font-semibold text-gray-600">Informasi Pelanggan :</span>
                            @if(session('customer_name'))
                                <span class="font-bold text-gray-800">Nama : {{ session('customer_name') }}</span>
                            @else
                                <span class="font-bold text-gray-800">Nomor Meja : {{ $order->table_number }}</span>
                            @endif
                        </div>
                        <div class="flex justify-between items-baseline">
                            <span class="font-semibold text-gray-600">Total Produk :</span>
                            <span class="text-gray-800">{{ $totalProducts }}x</span>
                        </div>
                        <div class="flex justify-between items-baseline">
                            <span class="font-semibold text-gray-600">Total Belanja :</span>
                            <span class="font-bold text-orange-600">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                         <button @click="open = !open" class="text-blue-600 font-semibold underline text-sm">
                            <span x-show="!open">Lihat Detail</span>
                            <span x-show="open">Sembunyikan Detail</span>
                        </button>
                    </div>

                    <div x-show="open" x-transition class="mt-4 border-t pt-4 space-y-2">
                        @foreach($order->orderItems as $item)
                            <div class="flex justify-between text-sm">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $item->menu->name }}</p>
                                    <p class="text-gray-500">Catatan : {{ $item->notes ?: '-' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-800">{{ $item->quantity }}x</p>
                                    <p class="font-semibold text-gray-700">Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8">
                    <form action="{{ route('order.confirmPayment', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full block bg-orange-500 text-white font-bold py-3 rounded-full hover:bg-orange-600 transition-colors">Selesai</button>
                    </form>
                </div>
            </main>
        </div>
         <div class="text-center text-gray-400 text-sm py-6">
            <span>POWERED BY</span><span class="ml-2 text-lg font-black italic">F</span>
        </div>
    </div>
</body>
</html>