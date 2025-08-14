<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ActivationController;
use App\Http\Controllers\Api\UpdateController;
use App\Http\Controllers\Api\DownloadController;

Route::post('/activate', ActivationController::class);
Route::get('/update', UpdateController::class);
Route::get('/download/{version}', DownloadController::class)->name('download');


