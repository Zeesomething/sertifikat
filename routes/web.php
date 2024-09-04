<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\TrainingController;
Route::resource('training', TrainingController::class);

use App\Http\Controllers\SertifikatController;
Route::resource('sertifikat', SertifikatController::class);
Route::get('/sertifikat/{id}/preview', [SertifikatController::class, 'printCertificate'])->name('sertifikat.preview')->defaults('isPreview', true);
Route::get('/sertifikat/{id}/print', [SertifikatController::class, 'printCertificate'])->name('sertifikat.print');



