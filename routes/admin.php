<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CaseStudyController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\LeadController;

Route::get('/', function () {
    return 'Admin Dashboard';
});

Route::resources([
    'pages' => PageController::class,
    'sections' => SectionController::class,
    'blog-posts' => BlogPostController::class,
    'categories' => CategoryController::class,
    'tags' => TagController::class,
    'case-studies' => CaseStudyController::class,
    'testimonials' => TestimonialController::class,
    'team-members' => TeamMemberController::class,
    'media' => MediaController::class,
]);

Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
Route::post('leads/{lead}/move', [LeadController::class, 'moveStage'])->name('leads.move');

