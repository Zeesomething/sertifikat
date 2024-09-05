<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\TrainingController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('training', TrainingController::class);

    Route::resource('sertifikat', SertifikatController::class);
    Route::get('/sertifikat/{id}/preview', [SertifikatController::class, 'printCertificate'])->name('sertifikat.preview')->defaults('isPreview', true);
    Route::get('/sertifikat/{id}/print', [SertifikatController::class, 'printCertificate'])->name('sertifikat.print');
    Route::post('/sertifikat/{id}/status', [SertifikatController::class, 'status'])->name('sertifikat.status');
});

    Route::get('/check-certificate', [SertifikatController::class, 'checkCertificate'])->name('checkCertificate');




