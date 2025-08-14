<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display the blog index page.
     */
    public function index(): View
    {
        return view('frontend.blog');
    }
}
