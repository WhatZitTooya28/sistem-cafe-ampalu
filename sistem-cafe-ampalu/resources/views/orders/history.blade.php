<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-white">
    <div class="max-w-lg mx-auto p-4">
        <header class="flex items-center justify-between p-4">
            <a href="{{ route('menu.index') }}" class="inline-flex items-center border border-gray-300 rounded-lg px-3 py-2 hover:bg-gray-100">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span class="font-semibold">KEMBALI</span>
            </a>
            <div class="text-right">
                <span class="font-bold text-red-500">SELESAI</span> / <span class="text-gray-500">PROSES</span>
            </div>
        </header>

        <main class="mt-4 space-y-6">
            @forelse($orders as $order)
                <div class="border-b pb-4">
                    <div class="flex justify-between items-baseline mb-4">
                        <p class="font-semibold text-gray-700">Informasi Pelanggan :</p>
                        <p class="font-bold">Nomor Meja : {{ $order->table_number }}</p>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Pesanan</h3>
                    <div class="space-y-4">
                        @foreach($order->orderItems as $item)
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $item->menu->name }}</p>
                                    <p class="text-sm text-gray-500">Catatan : {{ $item->notes ?: '-' }}</p>
                                    <div class="flex space-x-1 mt-1 cursor-pointer">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 text-gray-300 hover:text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-800">{{ $item->quantity }}x</p>
                                    <p class="font-semibold text-yellow-600">Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t mt-4 pt-4 flex justify-between font-bold text-gray-800">
                        <div>
                            <p>Total : <span class="text-yellow-600">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                            <p>Total Produk : <span>{{ $order->orderItems->sum('quantity') }} x</span></p>
                        </div>
                        <a href="{{ route('menu.index') }}" class="border-2 border-green-500 text-green-500 font-semibold px-4 py-1 rounded-lg self-end hover:bg-green-500 hover:text-white">Beli lagi</a>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 py-10">Tidak ada riwayat pesanan.</p>
            @endforelse
        </main>
    </div>
</body>
</html>