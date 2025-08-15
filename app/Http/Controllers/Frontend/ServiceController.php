<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(): View
    {
        $services = Service::where('is_active', true)->get();

        return view('services.index', compact('services'));
    }

    /**
     * Display a specific service.
     */
    public function show(Service $service): View
    {
        $service->load(['options', 'faqs', 'caseStudies']);

        return view('services.show', compact('service'));
    }
}
