<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LeadController;


Route::patch('/admin/leads/{lead}/stage', [LeadController::class, 'moveStage']);
use App\Http\Controllers\Webhook\StripeWebhookController;
use App\Http\Controllers\Webhook\PayPalWebhookController;





use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ServiceController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/webhooks/stripe', [StripeWebhookController::class, 'handle']);
Route::post('/webhooks/paypal', [PayPalWebhookController::class, 'handle']);
