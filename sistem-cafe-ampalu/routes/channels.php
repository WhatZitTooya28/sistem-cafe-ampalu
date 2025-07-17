<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan semua rute channel broadcasting event
| yang didukung oleh aplikasi Anda.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// (BARU) Tambahkan channel ini
// Channel ini akan mengotorisasi pendengar untuk channel 'orders.{orderId}'
Broadcast::channel('orders.{orderId}', function ($user, $orderId) {
    // Dalam aplikasi nyata, Anda akan memvalidasi apakah pengguna
    // ini berhak mendengarkan update untuk orderId tersebut.
    // Untuk sekarang, kita izinkan semua.
    return true; 
});
