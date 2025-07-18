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
// Pastikan path controllernya benar
use App\Http\Controllers\Kasir\DashboardController as KasirDashboardController;
use App\Http\Controllers\Kasir\TakeawayCartController;

/*
|--------------------------------------------------------------------------
| Rute untuk Pengguna Umum (Pelanggan)
|--------------------------------------------------------------------------
*/
Route::get('/', [MenuController::class, 'showHome'])->name('home');
Route::get('/menu', [MenuController::class, 'showMenu'])->name('menu.index');
Route::post('/session/set-table', [OrderSessionController::class, 'setTable'])->name('session.setTable');
Route::get('/menu/{menu}', [MenuController::class, 'showDetail'])->name('menu.detail');

// Rute keranjang untuk Pelanggan
Route::post('/cart/add/{menu}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');


/*
|--------------------------------------------------------------------------
| Rute untuk Autentikasi
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Rute yang Membutuhkan Login
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Grup Rute untuk Admin, Dapur, & Kasir
    Route::middleware('role:admin,dapur,kasir')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('menu', AdminMenuController::class);
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/history', [AdminOrderController::class, 'history'])->name('orders.history');
        Route::post('/orders/{order}/complete', [AdminOrderController::class, 'complete'])->name('orders.complete');
    });

    // Grup Rute untuk Kasir
    Route::middleware('role:kasir')->prefix('kasir')->name('kasir.')->group(function () {
        Route::get('/home', [KasirDashboardController::class, 'index'])->name('index'); 
        Route::get('/dashboard', [KasirDashboardController::class, 'showLanding'])->name('dashboard'); 
        Route::post('/take-away/start', [KasirDashboardController::class, 'startTakeAway'])->name('take_away.start');
        Route::get('/menu-takeaway', [KasirDashboardController::class, 'showTakeAwayMenu'])->name('menu.takeaway');
        
        // ======================================================
        // ============== BAGIAN INI TELAH DIPERBAIKI ==============
        // ======================================================
        Route::get('/cart-takeaway', [TakeawayCartController::class, 'index'])->name('cart.takeaway.index');
        Route::post('/cart-takeaway/update', [TakeawayCartController::class, 'update'])->name('cart.takeaway.update');
    });
});


/*
|--------------------------------------------------------------------------
| Rute untuk Proses Pesanan & Pembayaran
|--------------------------------------------------------------------------
*/
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::post('/order/takeaway', [OrderController::class, 'storeTakeaway'])->name('order.store.takeaway');
Route::get('/checkout/payment', [PaymentController::class, 'show'])->name('payment.show');
Route::get('/payment/loading/{order}', [PaymentController::class, 'loading'])->name('payment.loading');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/kasir/order/success', [OrderController::class, 'successTakeaway'])->name('kasir.order.success');