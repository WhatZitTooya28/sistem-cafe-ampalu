<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = Session::get('cart', []);
        $tableNumber = Session::get('table_number');

        if (empty($cart) || !$tableNumber) {
            return redirect()->route('menu.index')->with('error', 'Gagal memproses pesanan. Silakan coba lagi.');
        }

        $paymentMethod = $request->input('payment_method');

        // Jika tidak ada metode pembayaran yang dipilih, kembali dengan error
        if (!$paymentMethod) {
            return redirect()->back()->with('error', 'Silakan pilih metode pembayaran.');
        }

        DB::beginTransaction();
        try {
            $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

            // Tentukan status berdasarkan metode pembayaran
            $orderStatus = ($paymentMethod == 'cashier') ? 'menunggu_pembayaran' : 'menunggu_persetujuan';

            $order = Order::create([
                'table_number' => $tableNumber,
                'total_price' => $totalPrice,
                'status' => $orderStatus,
                'payment_method' => $paymentMethod,
                'payment_status' => 'pending',
            ]);

            foreach ($cart as $menuId => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menuId,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                    'notes' => $details['notes'] ?? null,
                ]);
            }

            Session::forget(['cart']); // Hanya hapus keranjang, nomor meja mungkin masih perlu

            DB::commit();

            // LOGIKA PENGALIHAN BARU
            if ($paymentMethod == 'cashier') {
                // Jika bayar di kasir, arahkan ke halaman ringkasan dengan QR Code
                return redirect()->route('order.summary', ['order' => $order->id]);
            } else {
                // Jika metode lain (misal: QRIS online), arahkan ke halaman loading
                return redirect()->route('payment.loading', ['order' => $order->id]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal membuat pesanan: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat memproses pesanan Anda.');
        }
    }


    /**
     * (DIPERBARUI) Menyimpan pesanan baru dari KASIR.
     */
    public function storeTakeaway(Request $request)
    {
        $cart = Session::get('admin_cart', []);
        $customerName = Session::get('customer_name');

        if (empty($cart) || !$customerName) {
            return redirect()->route('kasir.dashboard')->with('error', 'Keranjang kasir kosong atau nama pelanggan tidak ada.');
        }

        DB::beginTransaction();
        try {
            $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

            $order = Order::create([
                'table_number' => null,
                'customer_name' => $customerName,
                'total_price' => $totalPrice,
                'status' => 'proses',
                'payment_method' => 'cashier',
                'payment_status' => 'paid',
            ]);

            foreach ($cart as $menuId => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menuId,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                    'notes' => $details['notes'] ?? null,
                ]);
            }

            // ==========================================================
            // ============== PERUBAHAN DI BAGIAN INI ===================
            // ==========================================================
            // Simpan nama pelanggan ke flash session sebelum dihapus
            Session::flash('last_customer_name', $customerName);
            
            // Hapus sesi kasir setelah pesanan berhasil
            Session::forget(['admin_cart', 'customer_name']);

            DB::commit();

            return redirect()->route('kasir.order.success');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal membuat pesanan take away: ' . $e->getMessage());
            return redirect()->route('kasir.cart.takeaway.index')->with('error', 'Terjadi kesalahan saat memproses pesanan.');
        }
    }
    
    public function successTakeaway()
    {
        // Pastikan flash session ada, jika tidak, redirect ke dashboard
        if (!session('last_customer_name')) {
            return redirect()->route('kasir.dashboard');
        }
        return view('kasir.success');
    }

    public function history()
    {
        if (!session('table_number')) {
            return redirect()->route('home')->with('error', 'Silakan masukkan nomor meja terlebih dahulu.');
        }

        $orders = Order::with('orderItems.menu')
            ->where('table_number', session('table_number'))
            ->where('status', 'selesai') // Hanya ambil pesanan yang sudah selesai
            ->latest()
            ->get();

        return view('orders.history', compact('orders'));
    }

    /**
     * (BARU) Menampilkan status pesanan yang sedang aktif untuk pelanggan.
     */
    public function status()
    {
        if (!session('table_number')) {
            return redirect()->route('home')->with('error', 'Silakan masukkan nomor meja terlebih dahulu.');
        }

        $order = Order::where('table_number', session('table_number'))
            ->whereIn('status', ['menunggu_pembayaran', 'proses', 'siap_diambil']) // Ambil pesanan yang masih aktif
            ->latest()
            ->first();

        return view('orders.status', compact('order'));
    }
}