<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; // <-- Penting!
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderApproved implements ShouldBroadcast // <-- Implementasi ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    /**
     * Buat instance event baru.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Dapatkan channel tempat event ini akan di-broadcast.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // Event ini akan dikirim ke channel privat yang unik untuk setiap pesanan.
        // Contoh: 'orders.1', 'orders.2', dst.
        return [new PrivateChannel('orders.' . $this->order->id)];
    }
}