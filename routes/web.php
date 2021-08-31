<?php

use App\Http\Controllers\Account\PenggunaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\LanguageController;

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

Route::get('/', [StaterkitController::class, 'home'])->name('home');
Auth::routes();
Route::middleware(['auth'])->group(function () {
  Route::get('home', [StaterkitController::class, 'home'])->name('home');
//  Route::get('home', \App\Http\Livewire\Dashboard::class)->name('home');

// Route Components
  Route::prefix('akun')->group(function (){
//    Route::get('pengguna', \App\Http\Livewire\UserTable::class)->name('pengguna');
    Route::get('pengguna', [PenggunaController::class,'index'])->name('pengguna');
    Route::get('pengguna/tambah', [PenggunaController::class,'create'])->name('pengguna.create');
//    Route::resource('pengguna', \App\Http\Controllers\Account\PenggunaController::class);
  });
  Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
  Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name('layout-full');
  Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
  Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
  Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');

// locale Route
  Route::get('lang/{locale}', [LanguageController::class, 'swap']);
});


