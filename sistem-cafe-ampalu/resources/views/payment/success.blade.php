<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-cyan-100">

    <div class="min-h-screen flex flex-col items-center justify-center p-4 text-center">
        
        <div class="relative animate-bounce">
            <img src="{{ asset('images/checkmark.png') }}" 
                 class="w-40 h-40 mx-auto" 
                 alt="Checkmark">
        </div>

    <h1 class="text-3xl font-bold text-gray-800 mt-4">Pembayaran Berhasil!</h1>
        
        <p class="text-gray-600 mt-2 max-w-md">
            Pesanan untuk <span class="font-bold">{{ session('customer_info_success', 'Anda') }}</span> telah kami terima dan akan segera diproses oleh dapur.
        </p>

        <div class="mt-10 w-full max-w-xs space-y-3">
            <a href="{{ route('order.status') }}" class="block w-full bg-gray-800 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-gray-900 transition-all duration-300 transform hover:scale-105">
                Lihat Status Pesanan Anda
            </a>
            <a href="{{ route('menu.index') }}" class="block w-full bg-white text-gray-700 font-bold py-3 px-6 rounded-full shadow-lg border hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                Kembali ke Menu
            </a>
            <a href="{{ route('home') }}" class="block w-full bg-white text-gray-700 font-bold py-3 px-6 rounded-full shadow-lg border hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                Selesai
            </a>
        </div>

        <div class="absolute bottom-6 flex justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
        </div>
    </div>

</body>
</html>