<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-cyan-100">

    <div class="min-h-screen flex flex-col items-center justify-center p-4 text-center">
        
        <div class="relative">
            <img src="{{ asset('images/checkmark.png') }}" 
                 class="w-48 h-48 mx-auto" 
                 alt="Checkmark">
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mt-4">Pesanan Berhasil Diterima!</h1>
        <p class="text-gray-600 mt-2">
            Pesanan untuk <span class="font-bold">{{ session('last_customer_name') }}</span> telah diteruskan ke dapur.
        </p>

        <div class="mt-10">
            <a href="{{ route('kasir.dashboard') }}" class="bg-gray-800 text-white font-bold py-3 px-8 rounded-full hover:bg-gray-900 transition-all duration-300 shadow-lg transform hover:scale-105">
                Buat Pesanan Baru
            </a>
        </div>

        <div class="absolute bottom-6 text-center text-gray-400 text-sm">
            <span>POWERED BY</span>
            <span class="ml-2 text-lg font-black italic">F</span>
        </div>
    </div>

</body>
</html>