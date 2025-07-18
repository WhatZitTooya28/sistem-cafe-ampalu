<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class TakeawayCartController extends Controller
{
    /**
     * Kunci sesi yang digunakan untuk keranjang kasir.
     */
    private $cartSessionKey = 'admin_cart';

    /**
     * Menampilkan halaman keranjang untuk kasir.
     */
    public function index()
    {
        $cart = session()->get($this->cartSessionKey, []);
        return view('kasir.cart_takeaway', compact('cart')); // Pastikan view-nya benar
    }

    /**
     * Menambah atau memperbarui item di keranjang kasir.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = session()->get($this->cartSessionKey, []);
        $menuId = $request->id;
        $quantity = $request->quantity;

        if ($quantity > 0) {
            // Jika item sudah ada, update kuantitasnya
            // Jika belum, tambahkan sebagai item baru
            $menu = Menu::find($menuId);
            $cart[$menuId] = [
                "name" => $menu->name,
                "quantity" => (int)$quantity,
                "price" => $menu->price,
                "image" => $menu->image,
                "notes" => $request->input('notes', $cart[$menuId]['notes'] ?? '') // Simpan catatan jika ada
            ];
        } else {
            // Hapus item jika kuantitas 0
            if (isset($cart[$menuId])) {
                unset($cart[$menuId]);
            }
        }

        session()->put($this->cartSessionKey, $cart);

        // Hitung ulang total untuk respons JSON
        $newTotal = 0;
        foreach ($cart as $details) {
            $newTotal += $details['price'] * $details['quantity'];
        }

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil diperbarui!',
            'newTotal' => number_format($newTotal, 0, ',', '.'),
            'cartEmpty' => count($cart) === 0
        ]);
    }

    /**
     * Mengosongkan keranjang kasir.
     */
    public function clear()
    {
        session()->forget($this->cartSessionKey);
        return redirect()->back()->with('success', 'Keranjang kasir berhasil dikosongkan.');
    }
}