<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // <-- INI BAGIAN PALING PENTING YANG MEMPERBAIKI ERROR

class PaymentController extends Controller
{
    public function show()
    {
        // Pastikan ada sesuatu di keranjang sebelum ke halaman pembayaran
        if (!session('cart') || count(session('cart')) == 0) {
            return redirect()->route('menu.index')->with('error', 'Keranjang Anda kosong.');
        }
        return view('payment.show');
    }

    /**
     * Menampilkan halaman ringkasan pesanan dengan QR Code.
     */
    public function showSummary(Order $order)
    {
        // Data yang akan dimasukkan ke dalam QR Code (dalam hal ini, ID Pesanan)
        $qrData = $order->id;
        
        // Membuat URL untuk gambar QR Code menggunakan API eksternal gratis
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode($qrData);

        return view('payment.summary', compact('order', 'qrCodeUrl'));
    }

        public function confirmPaymentByCustomer(Order $order)
    {
        // Update status pesanan dan pembayaran
        $order->update([
            'status' => 'proses',
            'payment_status' => 'paid'
        ]);

        // Arahkan ke halaman transaksi berhasil
        return redirect()->route('payment.success');
    }

    public function loading(Order $order)
    {
        return view('payment.loading', compact('order'));
    }

    public function success()
    {
        return view('payment.success');
    }
}