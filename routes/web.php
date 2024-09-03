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
Route::get('/sertifikat/print/{id}', [SertifikatController::class, 'printCertificate']);


