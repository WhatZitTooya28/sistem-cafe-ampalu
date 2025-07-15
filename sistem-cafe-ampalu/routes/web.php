<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\CartController;

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
});

// Rute untuk menambahkan item ke keranjang
Route::post('/cart/add/{menu}', [CartController::class, 'add'])->name('cart.add');
// Rute untuk menampilkan halaman keranjang
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// (BARU) Rute untuk menampilkan halaman detail menu
Route::get('/menu/{menu}', [MenuController::class, 'showDetail'])->name('menu.detail');
