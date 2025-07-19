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
        $customerName = Session::get('customer_name'); // Untuk take away

        if (empty($cart) || (!$tableNumber && !$customerName)) {
            return redirect()->route('menu.index')->with('error', 'Gagal memproses pesanan.');
        }

        $paymentMethod = $request->input('payment_method');
        if (!$paymentMethod) {
            return redirect()->back()->with('error', 'Silakan pilih metode pembayaran.');
        }

        DB::beginTransaction();
        try {
            $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

            $orderStatus = 'menunggu_pembayaran'; // Status awal untuk semua pesanan

            $order = Order::create([
                'table_number' => $tableNumber,
                'customer_name' => $customerName, // Akan null jika makan di tempat
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

            Session::forget(['cart']);
            DB::commit();

            // LOGIKA PENGALIHAN YANG DIPERBAIKI
            if ($paymentMethod == 'qris') {
                return redirect()->route('payment.qris', ['order' => $order->id]);
            } else { // Ini berlaku untuk 'cashier' atau metode lainnya
                return redirect()->route('order.summary', ['order' => $order->id]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal membuat pesanan: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat memproses pesanan.');
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
        $tableNumber = session('table_number');
        $customerName = session('customer_name');

        if (!$tableNumber && !$customerName) {
            return redirect()->route('home')->with('error', 'Sesi Anda tidak ditemukan. Silakan mulai lagi.');
        }

        $query = Order::with('orderItems.menu');

        if ($tableNumber) {
            $query->where('table_number', $tableNumber);
        } elseif ($customerName) {
            $query->where('customer_name', $customerName);
        }
        
        $orders = $query->latest()->get();

        return view('orders.history', compact('orders'));
    }

    /**
     * (DIPERBARUI) Menampilkan status pesanan yang sedang aktif untuk pelanggan.
     * Sekarang bisa menangani Nomor Meja dan Nama Pelanggan.
     */
    public function status()
    {
        $tableNumber = session('table_number');
        $customerName = session('customer_name');

        if (!$tableNumber && !$customerName) {
            return redirect()->route('home')->with('error', 'Sesi Anda tidak ditemukan. Silakan mulai lagi.');
        }

        $query = Order::whereIn('status', ['menunggu_pembayaran', 'proses', 'siap_diambil']);

        if ($tableNumber) {
            $query->where('table_number', $tableNumber);
        } elseif ($customerName) {
            $query->where('customer_name', $customerName);
        }

        $order = $query->latest()->first();

        return view('orders.status', compact('order'));
    }

}