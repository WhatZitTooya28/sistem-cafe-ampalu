<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne; // <-- Tambahkan ini

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'menu_id', 'quantity', 'price', 'notes'];

    public function menu(): BelongsTo {
        return $this->belongsTo(Menu::class);
    }

    // (BARU) Tambahkan relasi ini
    public function rating(): HasOne
    {
        return $this->hasOne(Rating::class);
    }
}