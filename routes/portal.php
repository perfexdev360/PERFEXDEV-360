<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\LicenseController;
use App\Http\Controllers\Portal\PurchaseController;
use App\Http\Controllers\Portal\QuoteController;
use App\Http\Controllers\Portal\InvoiceController;

Route::middleware(['auth', 'verified', 'twofactor'])->group(function () {
    Route::get('/', function () {
        return 'Client Portal';
    });

    Route::resource('quotes', QuoteController::class);
    Route::post('quotes/{quote}/approve', [QuoteController::class, 'approve'])
        ->name('quotes.approve');
    Route::post('quotes/{quote}/reject', [QuoteController::class, 'reject'])
        ->name('quotes.reject');

    Route::resource('invoices', InvoiceController::class)->only(['show']);
    Route::post('invoices/{invoice}/pay', [InvoiceController::class, 'pay'])
        ->name('invoices.pay');
    Route::get('invoices/{invoice}/receipt', [InvoiceController::class, 'receipt'])
        ->name('invoices.receipt');

    Route::resource('purchases', PurchaseController::class)->only(['index', 'show']);
    Route::resource('licenses', LicenseController::class)->only(['index', 'show']);
    Route::post('licenses/{license}/rotate', [LicenseController::class, 'rotate'])
        ->name('licenses.rotate');
    Route::get('licenses/{license}/download/{release}', [LicenseController::class, 'download'])
        ->name('licenses.download')
        ->middleware('signed');
});

