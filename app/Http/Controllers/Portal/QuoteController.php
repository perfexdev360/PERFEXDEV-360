<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\QuoteRequest;
use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the user's quotes.
     */
    public function index(Request $request)
    {
        $quotes = $request->user()
            ->quotes()
            ->latest()
            ->paginate(10);

        if ($request->wantsJson()) {
            return response()->json($quotes);
        }

        return view('portal.quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new quote.
     */
    public function create(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json([]);
        }

        return view('portal.quotes.create');
    }

    /**
     * Store a newly created quote for the authenticated user.
     */
    public function store(QuoteRequest $request)
    {
        $validated = $request->validate([
            'valid_until' => ['nullable', 'date'],
        ]);

        $quote = $request->user()->quotes()->create([
            'number' => 'Q' . now()->format('YmdHis') . Str::random(4),
            'status' => 'draft',
            'valid_until' => $validated['valid_until'] ?? null,
        ]);


        if ($request->wantsJson()) {
            return response()->json($quote, 201);
        }

        return redirect()->route('portal.quotes.show', $quote)
            ->with('status', 'Quote created.');
    }

    /**
     * Display the specified quote.
     */
    public function show(Quote $quote, Request $request)
    {
        abort_if($quote->user_id !== $request->user()->id, 403);

        $quote->load('items');


        if ($request->wantsJson()) {
            return response()->json($quote);
        }

        return view('portal.quotes.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified quote.
     */
    public function edit(Quote $quote, Request $request)
    {
        abort_if($quote->user_id !== $request->user()->id, 403);


        return view('portal.quotes.edit', compact('quote'));
    }

    /**
     * Update the specified quote.
     */
    public function update(QuoteRequest $request, Quote $quote)
    {
        abort_if($quote->user_id !== $request->user()->id, 403);

        $validated = $request->validate([
            'valid_until' => ['nullable', 'date'],
        ]);

        $quote->update($validated);

        if ($request->wantsJson()) {
            return response()->json($quote);
        }

        return redirect()->route('portal.quotes.show', $quote)

            ->with('status', 'Quote updated.');
    }

    /**
     * Remove the specified quote from storage.
     */
    public function destroy(Request $request, Quote $quote)
    {
        abort_if($quote->user_id !== $request->user()->id, 403);

        $quote->delete();

        if ($request->wantsJson()) {
            return response()->json([], 204);
        }

        return redirect()->route('portal.quotes.index')

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
