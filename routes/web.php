<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DatastokController;
use App\Http\Controllers\KartustokController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CustomerController;

    Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    });

    Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/dashboard', function () {
        return view('test.dashboard');
        })->name('dashboard');
        });

    Route::get('/', function () {
    return redirect()->route('dashboard');});

    Route::get('/persediaan', function () {
        return view('test.persediaan');
        })->name('persediaan');

    Route::get('/penjualan', [PenjualanController::class, 'index'])
        ->name('penjualan');

    Route::get('/profile', [AuthController::class, 'profile'])
        ->name('profile');

    // Route::get('/stok', function () {return view('test.stok');})
    //     ->name('stok');

    Route::get('/stok', [StokController::class, 'index'])
        ->name('stok');

    Route::get('/datastok', [ProdukController::class, 'index'])
    ->name('datastok');

    // Route::get('/kartustok', [KartustokController::class,'prokart'])
    //     ->name('kartustok');

    Route::get('/kartustok', [KartuStokController::class,'kartu'])
        ->name('test.kartustok');

    Route::get('/mutasi', [MutasiController::class, 'index'])
        ->name('mutasi');

    Route::get('/tambahmutasi', [MutasiController::class, 'tambahmutasi'])
    ->name('tambahmutasi');

    Route::get('/riwayatmutasi', [MutasiController::class, 'tampil'])
        ->name('riwayatmutasi');

    route::get('/detailriwayatmutasi', [MutasiController::class,'detailmutasi'])
    ->name('detailriwayatmutasi');

    Route::resource('produk', ProdukController::class);

    Route::get('/insidekartustok/{id_produk}', [StokController::class, 'detail'])
    ->name('insidekartustok');

    Route::get('/produk/statistik', [ProdukController::class, 'statistik'])
    ->name('produk.statistik');

    route::get('/stoklama', [StokController::class, 'lama'])
    ->name('stoklama');

    Route::get('/laporanstok', [StokController::class,'laporstok'])
    ->name('laporanstok');

    Route::get('/stokopname', [StokController::class,'opname'])
    ->name('stokopname');

    Route::get('/barcodesku', [StokController::class,'barcode'])
    ->name('barcodesku');

    Route::get('/datastok', [StokController::class,'data'])
    ->name('datastok');
    
    Route::get('/pembelian', [StokController::class,'beli'])
    ->name('pembelian');

    Route::get('/user', [ProfilController::class,'store'])
    ->name('user.store');

    Route::post('/produk/search', [ProfilController::class, 'search'])
    ->name('produk.search');

    Route::get('/pengaturan', [CabangController::class, 'index'])
    ->name('pengaturan');

    Route::get('/cabang/next-id', [CabangController::class, 'nextId'])
    ->name('cabang.nextId');

    Route::post('/cabang', [CabangController::class, 'store'])
    ->name('cabang.store');

    Route::post('/akun', [UsersController::class,'store'])
    ->name('akun.store');

    Route::post('/kategori', [KategoriController::class,'store'])
    ->name('kategori.store');

    Route::post('/produk', [ProdukController::class,'store'])
    ->name('produk.store');

    Route::post('/supplier', [SupplierController::class,'store'])
    ->name('supplier.store');

    Route::post('/customer', [CustomerController::class,'store'])
    ->name('customer.store');

    Route::post('/tambahmutasi', [MutasiController::class,'store'])
    ->name('tambahmutasi.store');

    Route::post('pengaturan', [UsersController::class,'tampil'])
    ->name('test.pengaturan');

    Route::get('/mutasi', [MutasiController::class, 'index'])
    ->name('mutasi');

    Route::get('/mutasi/export', [MutasiController::class, 'export'])
    ->name('mutasi.export');

    Route::get('/mutasi/{mutasi}', [MutasiController::class, 'show'])->whereNumber('mutasi')
    ->name('mutasi.show');
    
    Route::get('/mutasi/{mutasi}/cetak', [MutasiController::class, 'cetak'])->whereNumber('mutasi')
    ->name('mutasi.cetak');

    Route::get('/laporanstok', [StokController::class, 'tampil'])
    ->name('laporanstok');

    Route::get('/laporanstok/export', [StokController::class, 'export'])
    ->name('laporanstok.export');

    Route::get('/kartustok', [KartuStokController::class, 'index'])
    ->name('test.kartustok');