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
<body class="bg-gray-50">
    <div class="max-w-lg mx-auto p-4">
        <header class="flex items-center p-4">
            <a href="{{ route('menu.index') }}" class="inline-flex items-center border border-gray-300 rounded-lg px-3 py-2 hover:bg-gray-100">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span class="font-semibold">KEMBALI KE MENU</span>
            </a>
        </header>

        <main class="mt-4 space-y-6">
            @forelse($orders as $order)
                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="font-semibold text-gray-700">Nomor Meja : <span class="font-bold text-gray-900">{{ $order->table_number }}</span></p>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        
                        {{-- Label Status Dinamis --}}
                        @php
                            $statusText = ucwords(str_replace('_', ' ', $order->status));
                            $bgColor = 'bg-gray-200';
                            $textColor = 'text-gray-800';
                            if ($order->status == 'selesai') {
                                $bgColor = 'bg-green-100';
                                $textColor = 'text-green-800';
                            } elseif ($order->status == 'proses' || $order->status == 'siap_diambil') {
                                $bgColor = 'bg-blue-100';
                                $textColor = 'text-blue-800';
                            } elseif ($order->status == 'menunggu_pembayaran') {
                                $bgColor = 'bg-yellow-100';
                                $textColor = 'text-yellow-800';
                            }
                        @endphp
                        <span class="font-bold text-xs px-3 py-1 rounded-full {{ $bgColor }} {{ $textColor }}">
                            {{ $statusText }}
                        </span>
                    </div>
                    
                    <div class="space-y-3">
                        @foreach($order->orderItems as $item)
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $item->menu->name }}</p>
                                    <p class="text-sm text-gray-500">Catatan : {{ $item->notes ?: '-' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-700">{{ $item->quantity }}x</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="border-t mt-4 pt-4 flex justify-between items-center font-bold text-gray-800">
                        <p>Total : <span class="text-orange-600">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                        {{-- Hanya tampilkan tombol rating jika sudah selesai --}}
                        @if($order->status == 'selesai')
                            <a href="{{ route('order.rating.create', $order->id) }}" class="border-2 border-yellow-500 text-yellow-600 font-semibold px-4 py-1 rounded-lg hover:bg-yellow-500 hover:text-white text-sm">Beri Rating</a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white p-10 rounded-2xl shadow-lg text-center">
                    <p class="text-gray-500">Anda belum pernah membuat pesanan.</p>
                </div>
            @endforelse
        </main>
    </div>
</body>
</html>