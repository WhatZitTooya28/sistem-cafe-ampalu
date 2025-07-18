<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('ratings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_item_id')->constrained()->onDelete('cascade');
        $table->unsignedTinyInteger('rating'); // Nilai 1-5
        $table->text('review')->nullable();   // Ulasan/catatan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
