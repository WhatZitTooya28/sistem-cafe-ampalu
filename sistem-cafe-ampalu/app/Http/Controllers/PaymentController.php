<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

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

    public function loading(Order $order)
    {
        return view('payment.loading', compact('order'));
    }

    public function success()
    {
        return view('payment.success');
    }
}