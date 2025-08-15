<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\LicenseController;
use App\Http\Controllers\Portal\PurchaseController;
use App\Http\Controllers\Portal\QuoteController;

Route::middleware(['auth', 'verified', 'twofactor'])->group(function () {
    Route::get('/', function () {
        return 'Client Portal';
    });

    Route::post('quotes/{quote}/approve', [QuoteController::class, 'approve'])
        ->name('quotes.approve');

    Route::resource('purchases', PurchaseController::class)->only(['index', 'show']);
    Route::resource('licenses', LicenseController::class)->only(['index', 'show']);
    Route::post('licenses/{license}/rotate', [LicenseController::class, 'rotate'])
        ->name('licenses.rotate');
    Route::get('licenses/{license}/download/{release}', [LicenseController::class, 'download'])
        ->name('licenses.download')
        ->middleware('signed');
});

