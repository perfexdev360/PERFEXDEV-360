<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuoteRequest;
use App\Models\Quote;
use App\Repositories\QuoteRepository;

class QuoteController extends Controller
{
    public function __construct(protected QuoteRepository $repository)
    {
        $this->authorizeResource(Quote::class, 'quote');
    }

    public function index()
    {
        return response()->json($this->repository->all());
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(QuoteRequest $request)
    {
        $quote = $this->repository->create($request->validated());
        return response()->json($quote, 201);
    }

    public function show(Quote $quote)
    {
        return response()->json($this->repository->find($quote));
    }

    public function edit(Quote $quote)
    {
        return response()->json($this->repository->find($quote));
    }

    public function update(QuoteRequest $request, Quote $quote)
    {
        $quote = $this->repository->update($quote, $request->validated());
        return response()->json($quote);
    }

    public function destroy(Quote $quote)
    {
        $this->repository->delete($quote);
        return response()->json(null, 204);
    }
}
