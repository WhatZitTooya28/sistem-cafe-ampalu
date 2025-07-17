<?php
namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('kasir.dashboard');
    }

        /**
     * Memproses nama pelanggan take away dan menyimpannya di session.
     */
    public function startTakeAway(Request $request)
    {
        $request->validate([
            'customer_name_popup' => 'required|string|max:255',
        ]);

        // Hapus session order lama jika ada
        $request->session()->forget(['cart', 'table_number']);

        // Simpan nama pelanggan baru ke session
        $request->session()->put('customer_name', $request->customer_name_popup);

        // Arahkan ke halaman menu take away
        return redirect()->route('kasir.menu.take_away');
    }

    /**
     * Menampilkan halaman menu untuk pesanan take away.
     */
    public function showTakeAwayMenu()
    {
        // Baris ini mengambil semua menu dan mengelompokkannya berdasarkan kategori
        $groupedMenus = \App\Models\Menu::all()->groupBy('category');

        // Baris ini mengirimkan variabel $groupedMenus ke view
        return view('kasir.menu_takeaway', compact('groupedMenus'));
    }
}
