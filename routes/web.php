<?php

// BACKEND
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\PenggunaController;

// FRONTEND
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Auth::routes();

// BACKEND ROUTE
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('training', TrainingController::class);
    Route::resource('sertifikat', SertifikatController::class);
    Route::get('/sertifikat/{id}/preview', [SertifikatController::class, 'printCertificate'])->name('sertifikat.preview')->defaults('isPreview', true);
    Route::get('/sertifikat/{id}/print', [SertifikatController::class, 'printCertificate'])->name('sertifikat.print');
    Route::post('/sertifikat/{id}/status', [SertifikatController::class, 'status'])->name('sertifikat.status');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
});

// FRONTEND ROUTE
Route::get('/pelatihan/{id}', [PelatihanController::class, 'pelatihan']);
Route::get('/more', [App\Http\Controllers\MoreController::class, 'index'])->name('more');
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::post('/check-certificate', [WelcomeController::class, 'checkCertificate'])->name('checkCertificate');
Route::get('/more', [App\Http\Controllers\MoreController::class, 'index'])->name('more');
Route::get('/pelatihan/{id}', [PelatihanController::class, 'pelatihan']);

