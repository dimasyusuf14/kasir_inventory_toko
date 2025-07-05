<?php

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
    // CRUD Barang
    Route::resource('/barang', ProductController::class);

    // Laporan Penjualan
    Route::get('/laporan', [TransactionController::class, 'report'])->name('laporan');
    Route::get('/laporan/cetak', [TransactionController::class, 'exportPdf'])->name('laporan.pdf');

    Route::get('/dashboard', [TransactionController::class, 'chart'])->name('dashboard');

});


// ✅ Kasir Area
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');

    // Cetak Struk transaction
    Route::get('/transaction/struk/{id}', [TransactionController::class, 'print'])->name('transaction.print');

    Route::get('/riwayat', [TransactionController::class, 'history'])->name('riwayat');
});

Route::get('/transaction/struk/{id}', [TransactionController::class, 'print'])
    ->middleware(['auth', 'role:kasir', 'owns.transaction'])
    ->name('kasir.transaction.print');


require __DIR__ . '/auth.php';
