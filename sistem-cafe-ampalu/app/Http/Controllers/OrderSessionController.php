<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderSessionController extends Controller
{
    /**
     * Menyimpan nomor meja untuk pesanan 'Makan di Tempat'.
     */
    public function setTable(Request $request)
    {
        $request->validate(['table_number' => 'required|integer|min:1']);
        
        // (DIPERBAIKI) Hapus sesi 'customer_name' agar tidak tumpang tindih
        $request->session()->forget('customer_name');
        
        $request->session()->put('table_number', $request->table_number);
        
        return redirect()->route('menu.index');
    }

    /**
     * Menyimpan nama pelanggan untuk pesanan 'Bawa Pulang'.
     */
    public function setCustomerName(Request $request)
    {
        $request->validate(['customer_name' => 'required|string|max:255']);
        
        // (DIPERBAIKI) Hapus sesi 'table_number' agar tidak tumpang tindih
        $request->session()->forget('table_number');
        
        $request->session()->put('customer_name', $request->customer_name);

        return redirect()->route('menu.index');
    }
}