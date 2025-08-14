<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display the services page.
     */
    public function index(): View
    {
        return view('frontend.services');
    }
}
