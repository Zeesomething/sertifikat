<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TampilController;
use App\Http\Controllers\WelcomeController;



Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::post('/check-certificate', [WelcomeController::class, 'checkCertificate'])->name('checkCertificate');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('training', TrainingController::class);
    Route::resource('sertifikat', SertifikatController::class);
    Route::get('/sertifikat/{id}/preview', [SertifikatController::class, 'printCertificate'])->name('sertifikat.preview')->defaults('isPreview', true);
    Route::get('/sertifikat/{id}/print', [SertifikatController::class, 'printCertificate'])->name('sertifikat.print');
    Route::post('/sertifikat/{id}/status', [SertifikatController::class, 'status'])->name('sertifikat.status');
});

    




