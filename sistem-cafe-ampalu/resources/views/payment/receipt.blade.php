<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Code QR Pembayaran Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Courier New', Courier, monospace; }
        @media print {
            body { -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-gray-100 flex justify-center py-8"">
    <div class="w-full max-w-sm bg-white p-6 shadow-lg">
        <div class="text-center">
            <h1 class="text-2xl font-bold">CAFE AMPALU</h1>
            <p class="text-sm">Pekanbaru, Riau</p>
            <hr class="my-4 border-dashed">
        </div>
        
        <div class="text-center mt-6 ">
            <p class="font-semibold mb-2">Scan untuk Bayar</p>
            <div class="mx-auto w-[200px] h-[200px] flex justify-center">
                {!! $qrCodeSvg !!}
            </div>
        </div>

        <hr class="my-4 border-dashed">
        <div class="text-center mt-6 text-sm">
            <p>Terima kasih atas kunjungan Anda!</p>
        </div>
    </div>
</body>
</html>