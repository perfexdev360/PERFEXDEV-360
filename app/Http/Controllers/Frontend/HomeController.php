<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application home page.
     */
    public function index(): View
    {
        return view('frontend.home');
    }
}
