<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ActivationController;
use App\Http\Controllers\Api\DownloadController;
use App\Http\Controllers\Api\RotationController;
use App\Http\Controllers\Api\UpdateController;
use App\Http\Controllers\Api\OrderReviewController;

Route::middleware('throttle:10,1')->post('/licenses/activate', ActivationController::class);
Route::middleware('throttle:10,1')->post('/licenses/rotate', RotationController::class);
Route::middleware('throttle:10,1')->get('/updates', UpdateController::class);
Route::middleware('throttle:10,1')->get('/download/{release}', DownloadController::class)->name('releases.download');

Route::middleware('auth')->group(function () {
    Route::post('/orders/{order}/review', [OrderReviewController::class, 'store']);
    Route::put('/orders/{order}/review', [OrderReviewController::class, 'update']);
});
