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
    // ... (method store untuk pelanggan tetap sama) ...

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
}