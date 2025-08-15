<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function index(): View
    {
        return view('frontend.contact');
    }

    /**
     * Store a new contact lead.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Lead::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'notes' => $validated['message'],
            'source' => 'contact',
        ]);

        return back()->with('status', 'Thank you for contacting us!');
    }
}
