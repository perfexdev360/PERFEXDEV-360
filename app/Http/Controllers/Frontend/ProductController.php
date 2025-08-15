<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(): View
    {
        $products = Product::query()
            ->where('is_active', true)
            ->get();

        return view('frontend.products.index', compact('products'));
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): View
    {
        return view('frontend.products.show', compact('product'));
    }
}
