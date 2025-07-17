<?php

// Lokasi: app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; // <-- Penting untuk transaksi database

class OrderController extends Controller
{
    /**
     * Menyimpan pesanan baru ke database dari session keranjang.
     */
    public function store(Request $request)
    {
        // 1. Ambil data dari session
        $cart = Session::get('cart', []);
        $tableNumber = Session::get('table_number');
        $customerName = Session::get('customer_name'); // Untuk take away

        // 2. Validasi: Pastikan keranjang tidak kosong dan ada identitas pemesan
        if (empty($cart) || (!$tableNumber && !$customerName)) {
            // Jika tidak valid, kembalikan ke halaman menu dengan pesan error
            return redirect()->route('menu.index')->with('error', 'Gagal memproses pesanan. Silakan coba lagi.');
        }

        // Memulai transaksi database. Ini untuk memastikan semua data berhasil disimpan atau tidak sama sekali.
        DB::beginTransaction();

        try {
            // 3. Hitung total harga dari semua item di keranjang
            $totalPrice = 0;
            foreach ($cart as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }

            // 4. Tentukan metode pembayaran dan status pesanan awal
            $paymentMethod = $request->input('payment_method', 'cashier'); // Default ke kasir
            $orderStatus = 'menunggu_persetujuan'; // Status awal untuk alur persetujuan kasir

            // 5. Buat record baru di tabel 'orders'
            $order = Order::create([
                'table_number' => $tableNumber,
                'customer_name' => $customerName,
                'total_price' => $totalPrice,
                'status' => $orderStatus,
                'payment_method' => $paymentMethod,
                'payment_status' => 'pending', // Status pembayaran selalu 'pending' di awal
            ]);

            // 6. Buat record untuk setiap item di tabel 'order_items'
            foreach ($cart as $menuId => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menuId,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                    'notes' => $details['notes'] ?? null,
                ]);
            }

            // 7. Hapus data dari session setelah pesanan berhasil dibuat
            Session::forget(['cart', 'table_number', 'customer_name']);

            // Jika semua proses di atas berhasil, konfirmasi transaksi database
            DB::commit();

            // 8. Arahkan ke halaman "tunggu persetujuan" dengan membawa ID pesanan
            return redirect()->route('payment.loading', ['order' => $order->id]);

        } catch (\Exception $e) {
            // Jika terjadi error di tengah jalan, batalkan semua operasi database
            DB::rollBack();
            
            // Log error untuk developer (opsional tapi sangat direkomendasikan)
            // Log::error('Gagal membuat pesanan: ' . $e->getMessage());

            // Kembali ke halaman keranjang dengan pesan error
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi.');
        }
    }
}
