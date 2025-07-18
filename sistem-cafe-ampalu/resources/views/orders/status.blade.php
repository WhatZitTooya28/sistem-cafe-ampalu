<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50">
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
        </div>

        <main class="text-center py-16">
            <div class="inline-flex items-center text-xl font-bold border-b-2 pb-2 mb-8">
                <svg class="w-8 h-8 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
                Status Orders
            </div>

            @if($order)
                <div class="space-y-4">
                    <div class="animate-spin rounded-full h-24 w-24 border-b-4 border-t-4 border-teal-500 mx-auto"></div>
                    <p class="text-2xl font-bold text-gray-800">
                        {{ ucwords(str_replace('_', ' ', $order->status)) }}
                    </p>
                </div>
            @else
                <p class="text-lg text-gray-500">Tidak ada pesanan aktif saat ini.</p>
            @endif
            
            <a href="{{ route('menu.index') }}" class="mt-12 inline-flex items-center border border-gray-300 rounded-lg p-2 hover:bg-gray-100">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span class="ml-2 font-semibold">KEMBALI</span>
            </a>
        </main>
    </div>
</body>
</html>