<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Rating Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50">
    <div class="max-w-lg mx-auto p-4">
        
        <header class="flex items-center justify-between p-4 bg-white rounded-t-2xl border-b">
            <a href="{{ route('menu.index') }}" class="p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h1 class="text-xl font-bold text-center text-gray-800">Rating</h1>
            <button class="p-2">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
            </button>
        </header>

        <main class="bg-white p-6 rounded-b-2xl">
            <div class="flex justify-between items-baseline mb-4 text-sm">
                <p class="font-semibold text-gray-600">Informasi Pelanggan :</p>
                <p class="font-bold">Nomor Meja : {{ $order->table_number }}</p>
            </div>
            <div class="flex justify-between items-baseline mb-6 text-sm">
                <p class="font-semibold text-gray-600">Pesanan :</p>
                <p class="font-bold">#{{ $order->id }}</p>
            </div>

            <form action="{{ route('order.rating.store', $order->id) }}" method="POST" class="space-y-6">
                @csrf
                @foreach($order->orderItems as $item)
                    <div x-data="{ rating: 0, hoverRating: 0 }">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 bg-black rounded-full"></span>
                            <p class="font-bold text-gray-800">{{ $item->menu->name }}</p>
                        </div>
                        <div class="mt-2 pl-4">
                            <p class="text-sm font-semibold text-gray-600">Nilai :</p>
                            <div class="flex items-center space-x-1 mt-1">
                                <template x-for="star in [1, 2, 3, 4, 5]" :key="star">
                                    <svg @click="rating = star" 
                                         @mouseenter="hoverRating = star" 
                                         @mouseleave="hoverRating = 0"
                                         :class="{'text-yellow-400': hoverRating >= star || rating >= star, 'text-gray-300': !(hoverRating >= star || rating >= star)}"
                                         class="w-7 h-7 cursor-pointer transition-colors" 
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </template>
                            </div>
                            <input type="hidden" :name="'ratings[' + {{ $item->id }} + '][rating]'" :value="rating">
                        </div>
                        <div class="mt-2 pl-4">
                            <p class="text-sm font-semibold text-gray-600">Ulasan :</p>
                            <textarea :name="'ratings[' + {{ $item->id }} + '][review]'" rows="2" placeholder="Tulis ulasan Anda di sini..." class="w-full mt-1 border border-gray-300 rounded-lg p-2 text-sm focus:ring-orange-500 focus:border-orange-500"></textarea>
                        </div>
                    </div>
                @endforeach

                <div class="text-center pt-4">
                    <button type="submit" class="w-full max-w-xs mx-auto bg-orange-500 text-white font-bold py-3 rounded-full hover:bg-orange-600 transition-colors">
                        Selesai
                    </button>
                </div>
            </form>
        </main>
    </div>
    <footer class="flex justify-center py-6">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
    </footer>
</body>
</html>