<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\SatuanController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
Route::get('/inventaris/create', [InventarisController::class, 'create'])->name('inventaris.create');
Route::post('/inventaris', [InventarisController::class, 'store'])->name('inventaris.store');

Route::get('/', [LokasiController::class, 'index'])->name('lokasi.index');
Route::post('/lokasi', [LokasiController::class, 'store'])->name('lokasi.store');
Route::get('/lokasi/select', [LokasiController::class, 'select'])->name('lokasi.select');

Route::get('/aset', [AsetController::class, 'index'])->name('aset.index');
Route::post('/aset', [AsetController::class, 'store'])->name('aset.store');
Route::get('/aset/select', [AsetController::class, 'select'])->name('aset.select');

Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan.index');
Route::post('/satuan', [SatuanController::class, 'store'])->name('satuan.store');
Route::get('/satuan/select', [SatuanController::class, 'select'])->name('satuan.select');

