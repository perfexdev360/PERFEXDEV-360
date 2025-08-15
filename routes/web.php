<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\Tags\Sitemap as SitemapTag;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\CaseStudy;

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CaseStudyController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\MediaController;
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/sitemap.xml', function () {
    return Sitemap::create()
        ->add(SitemapTag::create('/sitemap-posts.xml'))
        ->add(SitemapTag::create('/sitemap-products.xml'))
        ->add(SitemapTag::create('/sitemap-cases.xml'))
        ->toResponse(request());
});

Route::get('/sitemap-posts.xml', function () {
    $sitemap = Sitemap::create();
    BlogPost::all()->each(fn ($post) => $sitemap->add(Url::create(url('/blog/'.$post->slug))));
    return $sitemap->toResponse(request());
});

Route::get('/sitemap-products.xml', function () {
    $sitemap = Sitemap::create();
    Product::all()->each(fn ($product) => $sitemap->add(Url::create(url('/products/'.$product->slug))));
    return $sitemap->toResponse(request());
});

Route::get('/sitemap-cases.xml', function () {
    $sitemap = Sitemap::create();
    CaseStudy::all()->each(fn ($case) => $sitemap->add(Url::create(url('/cases/'.$case->slug))));
    return $sitemap->toResponse(request());
});

Route::get('/robots.txt', function () {
    return response()->view('components.robots')->header('Content-Type', 'text/plain');
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

require __DIR__.'/auth.php';
