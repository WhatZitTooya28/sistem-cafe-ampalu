<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['table_number', 'customer_name', 'total_price', 'status', 'payment_method', 'payment_status'];

    public function orderItems(): HasMany {
        return $this->hasMany(OrderItem::class);
    }
}
