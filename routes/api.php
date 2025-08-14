<?php

use Illuminate\Support\Facades\Route;

Route::post('/activate', function () {
    return response()->json(['status' => 'activated']);
});

Route::post('/update', function () {
    return response()->json(['status' => 'updated']);
});

