<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DaftargudangController;

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



Route::group(['middleware' => ['auth','ceklevel']], function (){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes();


Route::middleware(['auth','ceklevel'])->group(function () {
    Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan');
    Route::resource('daftarproduk', \App\Http\Controllers\DataprodukController::class );
    Route::resource('masterquotation', \App\Http\Controllers\QuotationController::class );
    Route::resource('daftarquotation', \App\Http\Controllers\DaftarquotationController::class );
    Route::resource('customer', \App\Http\Controllers\DaftarcustomerController::class);
    Route::post('/add_markup', [App\Http\Controllers\QuotationController::class, 'add_markup'])->name('add_markup');
    Route::post('/add_diskon', [App\Http\Controllers\QuotationController::class, 'add_diskon'])->name('add_diskon');
    Route::get('/po_customer', [App\Http\Controllers\POcustomerController::class, 'index'])->name('po_customer');
    Route::resource('managemenuser', App\Http\Controllers\UserController::class);
    Route::get('/print/{kode_quotation}', [App\Http\Controllers\PrintController::class, 'index'])->name('print');
    Route::get('/get_daftarproduk/{id}', [App\Http\Controllers\QuotationController::class, 'get_daftarproduk'])->name('get_daftarproduk');
    Route::get('/detail_quotation', [App\Http\Controllers\QuotationController::class, 'detail_quotation'])->name('detail_quotation');
});

// Route::middleware(['auth','ceklevel', 'user'])->group(function () {
//     Route::resource('masterquotation', \App\Http\Controllers\QuotationController::class );
//     Route::resource('daftarquotation', \App\Http\Controllers\DaftarquotationController::class );
//     Route::resource('customer', \App\Http\Controllers\DaftarcustomerController::class);
// });