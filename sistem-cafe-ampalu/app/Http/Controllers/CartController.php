<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class CartController extends Controller
{
    public function index(Request $request) {
        $cart = $request->session()->get('cart', []);
        return view('cart', ['cartItems' => $cart]);
    }

    public function add(Request $request, Menu $menu) {
        $quantity = $request->input('quantity', 1);
        $notes = $request->input('notes', '');
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['quantity'] += $quantity;
        } else {
            $cart[$menu->id] = [
                "name" => $menu->name,
                "quantity" => (int)$quantity,
                "price" => $menu->price,
                "image" => $menu->image,
                "notes" => $notes
            ];
        }
        $request->session()->put('cart', $cart);

        // UBAH BAGIAN INI
        // Mengarahkan ke halaman daftar menu (menu.index), bukan kembali (back).
        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    // Fungsi untuk memperbarui jumlah item (Sudah Benar)
    // redirect()->back() cocok di sini karena biasanya update dilakukan di halaman cart.
public function update(Request $request)
{
    $request->validate(['id' => 'required', 'quantity' => 'required|integer|min:0']);

    $cart = session()->get('cart', []);
    $id = $request->id;
    $quantity = $request->quantity;

    if ($quantity > 0) {
        // Update kuantitas jika lebih dari 0
        if(isset($cart[$id])) {
            $cart[$id]["quantity"] = $quantity;
        }
    } else {
        // Hapus item jika kuantitas 0 atau kurang
        if(isset($cart[$id])) {
            unset($cart[$id]);
        }
    }
    
    session()->put('cart', $cart);

    // Hitung ulang total harga keseluruhan
    $newTotal = 0;
    foreach (session('cart') as $details) {
        $newTotal += $details['price'] * $details['quantity'];
    }

    // Kembalikan respons dalam format JSON
    return response()->json([
        'success' => true,
        'message' => 'Keranjang berhasil diperbarui!',
        'newTotal' => number_format($newTotal, 0, ',', '.'),
        'itemSubtotal' => isset($cart[$id]) ? number_format($cart[$id]['price'] * $cart[$id]['quantity'], 0, ',', '.') : 0,
        'cartEmpty' => count(session('cart')) === 0
    ]);
}

    // Fungsi untuk menghapus item dari keranjang (Sudah Benar)
    // redirect()->back() juga cocok di sini.
    public function remove(Request $request)
    {
        $request->validate(['id' => 'required']);

        $cart = session()->get('cart');
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Menu berhasil dihapus dari keranjang!');
    }
}