<?php

use App\Http\Controllers\{
    HomeController,
    KategoriController,
    LaporanController,
    MejaController,
    PengeluaranController,
    PenjualanController,
    ProdukController,
    SettingController,
    UserController,
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false
]);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => ['role:admin']], function () {
        Route::post('user/destroyBatch', [UserController::class, 'destroyBatch'])->name('user.destroy.batch');
        Route::resource('user', UserController::class)->except('create', 'show');

        Route::post('kategori/destroyBatch', [KategoriController::class, 'destroyBatch'])->name('kategori.destroy.batch');
        Route::resource('kategori', KategoriController::class)->except('create', 'show');

        Route::post('produk/cetakBarcode', [ProdukController::class, 'cetakBarcode'])->name('produk.cetak.barcode');
        Route::get('produk/stokLimit', [ProdukController::class, 'stokLimit'])->name('produk.stok.limit');
        Route::post('produk/destroyBatch', [ProdukController::class, 'destroyBatch'])->name('produk.destroy.batch');
        Route::resource('produk', ProdukController::class)->except('create', 'show');

        Route::post('meja/destroyBatch', [MejaController::class, 'destroyBatch'])->name('meja.destroy.batch');
        Route::resource('meja', MejaController::class)->except('create', 'show');

        Route::post('pengeluaran/destroyBatch', [PengeluaranController::class, 'destroyBatch'])->name('pengeluaran.destroy.batch');
        Route::resource('pengeluaran', PengeluaranController::class)->except('create', 'show');

        Route::get('penjualan/transaksi', [PenjualanController::class, 'transaksi'])->name('penjualan.transaksi');
        Route::get('penjualan/{penjualan}/print', [PenjualanController::class, 'print'])->name('penjualan.print');
        Route::post('penjualan/destroyBatch', [PenjualanController::class, 'destroyBatch'])->name('penjualan.destroy.batch');
        Route::resource('penjualan', PenjualanController::class)->except('show');

        Route::get('/setting', [SettingController::class, 'index'])->name('setting.toko');
        Route::post('/setting', [SettingController::class, 'update'])->name('setting.toko.update');

        Route::get('/laporan/pendapatan', [LaporanController::class, 'index'])->name('laporan.pendapatan');
        Route::get('/laporan/terlaris', [LaporanController::class, 'terlaris'])->name('laporan.terlaris');
        Route::get('/laporan/perbulan', [LaporanController::class, 'bulan'])->name('laporan.perbulan');
    });
    // Route::group(['middleware' => ['role:kasir']], function () {

    // });

    Route::group(['middleware' => ['role:admin|kasir']], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::get('/profile', [SettingController::class, 'profile'])->name('setting.profile');
        Route::post('/profile', [SettingController::class, 'profileUpdate'])->name('setting.profileUpdate');

        Route::resource('produk', ProdukController::class)->only('index');
        Route::resource('meja', MejaController::class)->only('store', 'index');

        Route::get('/laporan/penjualanKasir', [LaporanController::class, 'penjualanKasir'])->name('laporan.penjualan.kasir');
        Route::get('/penjualan/printLast', [PenjualanController::class, 'penjualanPrintLast'])->name('penjualan.print.last');
        Route::get('/penjualan/pembayaran/{id}', [PenjualanController::class, 'pembayaran'])->name('penjualan.pembayaran');
        Route::resource('penjualan', PenjualanController::class)->only('update', 'create', 'store',);
    });
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
