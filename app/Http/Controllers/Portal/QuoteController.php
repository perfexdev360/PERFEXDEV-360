<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\QuoteRequest;
use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $quotes = $request->user()->quotes()->latest()->get();

        if ($request->wantsJson()) {
            return response()->json($quotes);
        }

        return view('portal.quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json([]);
        }

        return view('portal.quotes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuoteRequest $request)
    {
        $quote = $request->user()->quotes()->create($request->validated());

        if ($request->wantsJson()) {
            return response()->json($quote, 201);
        }

        return redirect()->route('quotes.show', $quote)
            ->with('status', 'Quote created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Quote $quote)
    {
        abort_if($quote->user_id !== $request->user()->id, 403);

        if ($request->wantsJson()) {
            return response()->json($quote);
        }

        return view('portal.quotes.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Quote $quote)
    {
        abort_if($quote->user_id !== $request->user()->id, 403);

        if ($request->wantsJson()) {
            return response()->json($quote);
        }

        return view('portal.quotes.edit', compact('quote'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuoteRequest $request, Quote $quote)
    {
        abort_if($quote->user_id !== $request->user()->id, 403);

        $quote->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json($quote);
        }

        return redirect()->route('quotes.show', $quote)
            ->with('status', 'Quote updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Quote $quote)
    {
        abort_if($quote->user_id !== $request->user()->id, 403);

        $quote->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('quotes.index')
            ->with('status', 'Quote deleted.');
    }

    public function approve(Request $request, Quote $quote): RedirectResponse
    {
        abort_if($quote->user_id !== $request->user()->id, 403);

        $validated = $request->validate([
            'legal_name' => ['required', 'string'],
            'accept_terms' => ['accepted'],
        ]);

        $quote->approve($validated['legal_name'], $request->ip());

        return back()->with('status', 'Quote approved.');
    }

    public function reject(Request $request, Quote $quote): RedirectResponse
    {
        abort_if($quote->user_id !== $request->user()->id, 403);

        $validated = $request->validate([
            'legal_name' => ['required', 'string'],
            'accept_terms' => ['accepted'],
        ]);

        $quote->reject($validated['legal_name'], $request->ip());

        return back()->with('status', 'Quote rejected.');
    }
}
