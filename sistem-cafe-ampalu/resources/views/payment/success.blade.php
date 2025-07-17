<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-sm bg-white p-8 rounded-2xl shadow-lg text-center">

            <div class="mb-6">
                <svg class="w-24 h-24 mx-auto text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>

            <h1 class="text-lg font-bold text-gray-800 mb-6">TRANSAKSI ANDA DI PROSES</h1>

            <div class="space-y-3">
                <a href="#" class="block w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition-colors">
                    LIHAT STATUS PESANAN ANDA
                </a>
                <a href="{{ route('menu.index') }}" class="block w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition-colors">
                    KEMBALI
                </a>
                <a href="{{ route('home') }}" class="block w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition-colors">
                    SELESAI
                </a>
            </div>

            <div class="text-center mt-8">
                <p class="text-xs text-gray-400 font-semibold">POWERED BY F</p>
            </div>
        </div>
    </div>
</body>
</html>