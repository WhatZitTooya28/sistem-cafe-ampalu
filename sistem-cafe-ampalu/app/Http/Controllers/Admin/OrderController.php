<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::with('orderItems.menu')->where('status', 'proses')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }
    public function history() {
        $orders = Order::with('orderItems.menu')->where('status', 'selesai')->latest()->get();
        return view('admin.orders.history', compact('orders'));
    }
    public function complete(Order $order) {
        $order->update(['status' => 'selesai']);
        return back()->with('success', 'Pesanan #' . $order->id . ' telah diselesaikan.');
    }
}