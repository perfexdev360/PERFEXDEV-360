<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LeadController;

Route::get('/', function () {
    return view('welcome');
});

Route::patch('/admin/leads/{lead}/stage', [LeadController::class, 'moveStage']);
