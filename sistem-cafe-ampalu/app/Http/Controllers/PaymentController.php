<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode; // Pastikan use statement ini benar


class PaymentController extends Controller
{
    /**
     * Menampilkan halaman pemilihan metode pembayaran.
     */
    public function show()
    {
        if (!session('cart') || count(session('cart')) == 0) {
            return redirect()->route('menu.index')->with('error', 'Keranjang Anda kosong.');
        }
        return view('payment.show');
    }

    /**
     * Menampilkan halaman ringkasan pesanan untuk metode "Bayar Dikasir".
     */
    public function showSummary(Order $order)
    {
        $qrData = $order->id;
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode($qrData);
        return view('payment.summary', compact('order', 'qrCodeUrl'));
    }

    /**
     * Mengkonfirmasi pembayaran dari sisi pelanggan untuk metode "Bayar Dikasir".
     */
        public function confirmPaymentByCustomer(Order $order)
    {
        $order->update(['status' => 'proses', 'payment_status' => 'paid']);
        
        // (DIPERBARUI) Simpan info pelanggan ke session
        $customerInfo = $order->customer_name ?: 'Meja ' . $order->table_number;
        Session::flash('customer_info_success', $customerInfo);

        return redirect()->route('payment.success');
    }

    public function confirmQrisPayment(Order $order)
    {
        $order->update(['status' => 'proses', 'payment_status' => 'paid']);

        // (DIPERBARUI) Simpan info pelanggan ke session
        $customerInfo = $order->customer_name ?: 'Meja ' . $order->table_number;
        Session::flash('customer_info_success', $customerInfo);

        return redirect()->route('payment.success');
    }
    /**
     * Menampilkan halaman pembayaran QRIS dengan timer.
     */
    public function showQris(Order $order)
    {
        $qrContent = "Cafe Ampalu;{$order->id};{$order->total_price}";
        $paymentExpiry = $order->created_at->addMinutes(10);
        return view('payment.qris', compact('order', 'qrContent', 'paymentExpiry'));
    }

    /**
     * (FINAL & ANTI-GAGAL) Menyiapkan dan menampilkan halaman struk untuk dicetak.
     * Menggunakan format SVG untuk menghindari error imagick.
     */
    public function printReceipt(Order $order)
    {
        $order->load('orderItems.menu');
        $qrContent = "Cafe Ampalu;{$order->id};{$order->total_price}";
        
        // Generate QR Code dalam format SVG (tidak butuh imagick/gd)
        $qrCodeSvg = QrCode::format('svg')->size(150)->margin(1)->generate($qrContent);

        return view('payment.receipt', compact('order', 'qrCodeSvg'));
    }


    /**
     * Menampilkan halaman loading (menunggu persetujuan).
     */
    public function loading(Order $order)
    {
        return view('payment.loading', compact('order'));
    }

    /**
     * Menampilkan halaman transaksi berhasil.
     */
    public function success()
    {
        return view('payment.success');
    }
}