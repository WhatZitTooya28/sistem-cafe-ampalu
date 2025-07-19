<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>QR Code Pesanan #{{ request()->route('order')->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex items-center justify-center min-h-screen">
    <div class="w-[300px] h-[300px]">
        {!! $qrCodeSvg !!}
    </div>
</body>
</html>