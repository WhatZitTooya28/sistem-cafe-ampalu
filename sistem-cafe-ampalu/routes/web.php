<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Kasir\DashboardController as KasirDashboardController;


/*
|--------------------------------------------------------------------------
| Rute untuk Pengguna Umum (Pelanggan)
|--------------------------------------------------------------------------
|
| Rute-rute ini dapat diakses oleh siapa saja tanpa perlu login.
|
*/
Route::get('/', [MenuController::class, 'showHome'])->name('home');
Route::get('/menu', [MenuController::class, 'showMenu'])->name('menu.index');
Route::post('/session/set-table', [OrderSessionController::class, 'setTable'])->name('session.setTable');


/*
|--------------------------------------------------------------------------
| Rute untuk Autentikasi (Login & Logout)
|--------------------------------------------------------------------------
|
| Rute untuk menampilkan halaman login dan memproses login/logout.
|
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Rute untuk Admin & Staf (Membutuhkan Login)
|--------------------------------------------------------------------------
|
| Rute-rute ini dilindungi oleh middleware 'auth'. Hanya pengguna yang
| sudah login yang bisa mengakses halaman-halaman ini.
|
*/

Route::middleware(['auth', 'role:admin,dapur'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('menu', AdminMenuController::class);
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/history', [AdminOrderController::class, 'history'])->name('orders.history');
    Route::post('/orders/{order}/complete', [AdminOrderController::class, 'complete'])->name('orders.complete');
});

Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', [KasirDashboardController::class, 'index'])->name('dashboard');
    Route::post('/take-away/start', [KasirDashboardController::class, 'startTakeAway'])->name('take_away.start');
    Route::get('/menu/take-away', [KasirDashboardController::class, 'showTakeAwayMenu'])->name('menu.take_away');

    // Tambahkan rute kasir lainnya di sini nanti
});

// Rute untuk menambahkan item ke keranjang
Route::post('/cart/add/{menu}', [CartController::class, 'add'])->name('cart.add');
// Rute untuk menampilkan halaman keranjang
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// (BARU) Rute untuk menampilkan halaman detail menu
Route::get('/menu/{menu}', [MenuController::class, 'showDetail'])->name('menu.detail');

// di dalam routes/web.php
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/checkout/payment', [PaymentController::class, 'show'])->name('payment.show');

Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/payment/loading/{order}', [PaymentController::class, 'loading'])->name('payment.loading');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');