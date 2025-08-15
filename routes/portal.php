<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\QuoteController;

Route::get('/', function () {
    return 'Client Portal';
});

Route::post('quotes/{quote}/approve', [QuoteController::class, 'approve'])
    ->name('quotes.approve');

