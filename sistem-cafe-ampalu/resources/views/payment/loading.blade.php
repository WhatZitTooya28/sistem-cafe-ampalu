<!DOCTYPE html>
<html lang="id">
<head>
    <title>Menunggu Pembayaran...</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- (PENTING) Muat library untuk komunikasi real-time --}}
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script> {{-- Ini akan kita buat nanti --}}
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
        <h2 class="mt-6 text-xl font-medium text-gray-900">Menunggu Persetujuan Kasir</h2>
        <p class="mt-2 text-sm text-gray-600">Mohon tunggu sebentar, pesanan Anda sedang dikonfirmasi.</p>
    </div>

    <script type="module">
        // Konfigurasi Laravel Echo untuk mendengarkan broadcast
        // Pastikan Anda sudah menjalankan `npm install laravel-echo pusher-js`
        // Dan mengkonfigurasi `resources/js/bootstrap.js`

        // Kode ini akan "mendengarkan" di channel khusus untuk pesanan ini
        window.Echo.private('orders.{{ $order->id }}')
            .listen('OrderApproved', (e) => {
                console.log('Pesanan Disetujui!', e);
                // Jika pesanan disetujui, arahkan ke halaman sukses
                window.location.href = "{{ route('payment.success') }}";
            });
    </script>
</body>
</html>