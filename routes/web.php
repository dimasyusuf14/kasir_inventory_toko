<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard Umum
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Akun Profile
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ✅ Admin Area
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/barang', ProductController::class);;
    Route::get('/laporan', [TransactionController::class, 'report'])->name('laporan');
    Route::get('/laporan/cetak', [TransactionController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/main', [DashboardController::class, 'index'])->name('main');
    Route::get('/history', [TransactionController::class, 'history'])->name('history ');
    Route::get('/transaction/struk/{id}', [TransactionController::class, 'print'])->name('transaction.print');
});

// ✅ Kasir Area
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction/struk/{id}', [TransactionController::class, 'print'])->name('transaction.print');
    Route::get('/riwayat', [TransactionController::class, 'history'])->name('riwayat');
    Route::get('/dashboard', [DashboardController::class, 'kasirDashboard'])->name('dashboard');
    Route::get('/main', [DashboardController::class, 'kasirDashboard'])->name('main');
    Route::get('/transaksi/{id}', [TransactionController::class, 'detail'])->name('transaction.detail');

    // Tambahkan ini untuk halaman kasir transaksi baru
    Route::get('/transactions', [KasirController::class, 'index'])->name('transactions');

    // AJAX tambah keranjang
});


Route::get('/transaction/struk/{id}', [TransactionController::class, 'print'])
    ->middleware(['auth', 'role:kasir', 'owns.transaction'])
    ->name('kasir.transaction.print');


require __DIR__ . '/auth.php';
