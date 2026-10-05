<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MooraController;

// Rute untuk halaman awal (Form Input)
Route::get('/', [MooraController::class, 'index']);

// Rute untuk memproses data (Hasil)
Route::post('/hitung', [MooraController::class, 'hitung'])->name('spk.hitung');