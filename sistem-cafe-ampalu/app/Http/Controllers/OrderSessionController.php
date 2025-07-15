<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderSessionController extends Controller
{
    public function setTable(Request $request)
    {
        // Validasi input, pastikan nomor meja diisi dan berupa angka
        $request->validate([
            'table_number' => 'required|integer|min:1',
        ]);

        // Simpan nomor meja ke dalam session
        $request->session()->put('table_number', $request->table_number);

        // Arahkan ke halaman menu
        return redirect()->route('menu.index');
    }
}