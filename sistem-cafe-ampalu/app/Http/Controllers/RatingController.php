<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Support\Facades\Session; 

class RatingController extends Controller
{
    /**
     * (DIPERBARUI) Mencari pesanan terakhir yang bisa di-rating (status proses/selesai)
     * dan mengarahkannya ke halaman rating.
     */
    public function rateLatestOrder()
    {
        $tableNumber = session('table_number');
        $customerName = session('customer_name');

        if (!$tableNumber && !$customerName) {
            return redirect()->route('home')->with('error', 'Sesi Anda tidak ditemukan.');
        }

        $query = Order::whereIn('status', ['proses', 'siap_diambil', 'selesai']);

        if ($tableNumber) {
            $query->where('table_number', $tableNumber);
        } elseif ($customerName) {
            $query->where('customer_name', $customerName);
        }

        $latestOrderToRate = $query->latest()->first();

        if ($latestOrderToRate) {
            return redirect()->route('order.rating.create', $latestOrderToRate->id);
        }

        return redirect()->route('menu.index')->with('info', 'Tidak ada pesanan yang bisa diberi rating saat ini.');
    }
    
    public function create(Order $order)
    {
        $order->load('orderItems.menu');
        return view('rating.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        $request->validate([
            'ratings.*.rating' => 'required|integer|min:1|max:5',
            'ratings.*.review' => 'nullable|string',
        ]);

        foreach ($request->ratings as $orderItemId => $ratingData) {
            if (isset($ratingData['rating']) && $ratingData['rating'] > 0) {
                Rating::updateOrCreate(
                    ['order_item_id' => $orderItemId],
                    ['rating' => $ratingData['rating'], 'review' => $ratingData['review']]
                );
            }
        }

        return redirect()->route('order.history')->with('success', 'Terima kasih atas ulasan Anda!');
    }
}