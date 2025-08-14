<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::view('/contact', 'contact')->name('contact.show');
Route::post('/contact', function () {
    return back()->with('status', 'Message sent!');
})->name('contact.submit');

