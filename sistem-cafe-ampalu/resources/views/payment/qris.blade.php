<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran QRIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50">

    <div class="max-w-md mx-auto">
        <header class="flex items-center p-4 bg-white border-b sticky top-0">
            <a href="{{ route('payment.show') }}" class="p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h1 class="text-xl font-bold text-center flex-grow">QRIS</h1>
        </header>

        <main class="p-6 text-center" x-data="timer('{{ $paymentExpiry->toIso8601String() }}')" x-init="startTimer()">
            <h2 class="text-lg font-semibold text-gray-800">Selesaikan Pembayaran dalam Waktu</h2>
            
            <p x-show="!expired" class="text-3xl font-bold text-red-500 my-2" x-text="countdown"></p>
            <p x-show="expired" class="text-2xl font-bold text-gray-500 my-2">Waktu Habis</p>

            <div class="my-8 relative inline-block">
                <div class="p-3 bg-white rounded-xl shadow-lg border">
                    {!! QrCode::size(230)->margin(1)->generate($qrContent) !!}
                </div>
                <div class="absolute -top-2 -left-2 w-12 h-12 border-t-4 border-l-4 border-red-500 rounded-tl-lg"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 border-b-4 border-r-4 border-red-500 rounded-br-lg"></div>
            </div>

            <p class="text-lg font-semibold text-gray-800">Total Pembayaran</p>
            <p class="text-3xl font-bold text-gray-900 mb-2">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-500 mb-8">
                Untuk pesanan {{ session('customer_name') ? 'atas nama '.session('customer_name') : 'di Meja '.$order->table_number }}
            </p>

            <div class="flex items-stretch space-x-4">
                <form action="{{ route('payment.confirmQris', $order->id) }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full bg-orange-500 text-white font-bold py-3 rounded-full hover:bg-orange-600 transition-colors flex items-center justify-center">
                        Cek Status Pembayaran
                    </button>
                </form>
                <a href="{{ route('payment.qris.print', $order->id) }}" target="_blank" class="border-2 border-orange-500 text-orange-500 p-3 rounded-full hover:bg-orange-50 transition-colors flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                </a>
            </div>
        </main>
        
        <footer class="flex justify-center py-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
        </footer>
    </div>

    <script>
        function timer(expiryString) {
            return {
                expiry: new Date(expiryString).getTime(),
                countdown: '10:00',
                expired: false,
                startTimer() {
                    let timerInterval = setInterval(() => {
                        let distance = this.expiry - new Date().getTime();
                        if (distance < 0) {
                            clearInterval(timerInterval);
                            this.countdown = '00:00';
                            this.expired = true;
                            window.location.href = "{{ route('payment.show') }}";
                            return;
                        }
                        let minutes = Math.floor(distance / (1000 * 60));
                        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        this.countdown = ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);
                    }, 1000);
                }
            }
        }
    </script>
</body>
</html>