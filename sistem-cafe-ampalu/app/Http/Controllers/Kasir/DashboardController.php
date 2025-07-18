<?php
namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order; // <-- Tambahkan ini
use Illuminate\Support\Facades\DB; // <-- Tambahkan ini
use Carbon\Carbon; // <-- Tambahkan ini

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman utama dashboard kasir beserta data grafik.
     */
    public function index()
    {
        // Mengambil total pendapatan per hari selama 7 hari terakhir
        $salesData = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as total')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Menyiapkan data untuk dikirim ke Chart.js
        // Contoh labels: ["11 Jul", "12 Jul", ...]
        $labels = $salesData->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('d M');
        });

        // Contoh data: [50000, 75000, ...]
        $data = $salesData->pluck('total');

        // Kirim data 'labels' dan 'data' ke view
        return view('kasir.index', compact('labels', 'data'));
    }

    /**
     * Menampilkan halaman penyambut (landing page) untuk kasir.
     */
    public function showLanding()
    {
        return view('kasir.dashboard');
    }

    /**
     * Memproses nama pelanggan take away dan menyimpannya di session.
     */
    public function startTakeAway(Request $request)
    {
        $request->validate(['customer_name_popup' => 'required|string|max:255']);
        $request->session()->forget(['admin_cart', 'customer_name']);
        $request->session()->put('customer_name', $request->customer_name_popup);
        return redirect()->route('kasir.menu.takeaway');
    }

    /**
     * Menampilkan halaman menu untuk pesanan take away.
     */
    public function showTakeAwayMenu()
    {
        $groupedMenus = Menu::all()->groupBy('category');
        return view('kasir.menu_takeaway', compact('groupedMenus'));
    }
}