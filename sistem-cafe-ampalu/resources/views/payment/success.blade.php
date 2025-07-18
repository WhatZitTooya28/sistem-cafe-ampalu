<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="max-w-md mx-auto p-4">
        <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
            <div class="relative mb-6">
                <img src="https://static.vecteezy.com/system/resources/previews/010/851/541/original/3d-check-mark-icon-on-transparent-background-free-png.png" class="w-32 h-32 mx-auto" alt="Checkmark">
            </div>
            <h1 class="text-xl font-bold text-gray-800 mb-6">TRANSAKSI ANDA DI PROSES</h1>
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