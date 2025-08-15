<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ActivationController;
use App\Http\Controllers\Api\DownloadController;
use App\Http\Controllers\Api\RotationController;
use App\Http\Controllers\Api\UpdateController;
Route::middleware('throttle:10,1')->post('/licenses/activate', ActivationController::class);
Route::middleware('throttle:10,1')->post('/licenses/rotate', RotationController::class);
Route::middleware('throttle:10,1')->get('/updates', UpdateController::class);
Route::middleware('throttle:10,1')->get('/download/{release}', DownloadController::class)->name('download');
