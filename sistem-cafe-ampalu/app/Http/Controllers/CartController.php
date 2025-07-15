<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        // Nanti kita akan membuat view untuk ini
        return view('cart', ['cartItems' => $cart]); 
    }

    /**
     * Menambahkan item ke dalam keranjang belanja.
     */
    public function add(Request $request, Menu $menu)
    {
        // Ambil quantity dan notes dari request form
        $quantity = $request->input('quantity', 1);
        $notes = $request->input('notes', '');

        $cart = $request->session()->get('cart', []);

        // Cek apakah menu sudah ada di keranjang
        if (isset($cart[$menu->id])) {
            // Jika sudah ada, tambahkan jumlahnya
            $cart[$menu->id]['quantity'] += $quantity;
        } else {
            // Jika belum ada, tambahkan sebagai item baru
            $cart[$menu->id] = [
                "name" => $menu->name,
                "quantity" => $quantity,
                "price" => $menu->price,
                "image" => $menu->image, // Kita simpan juga nama file gambarnya
                "notes" => $notes
            ];
        }

        // Simpan kembali array keranjang ke dalam session
        $request->session()->put('cart', $cart);

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }
}