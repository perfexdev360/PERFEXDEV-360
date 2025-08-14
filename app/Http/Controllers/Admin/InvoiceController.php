<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InvoiceRequest;
use App\Models\Invoice;
use App\Repositories\InvoiceRepository;

class InvoiceController extends Controller
{
    public function __construct(protected InvoiceRepository $repository)
    {
        $this->authorizeResource(Invoice::class, 'invoice');
    }

    public function index()
    {
        return response()->json($this->repository->all());
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(InvoiceRequest $request)
    {
        $invoice = $this->repository->create($request->validated());
        return response()->json($invoice, 201);
    }

    public function show(Invoice $invoice)
    {
        return response()->json($this->repository->find($invoice));
    }

    public function edit(Invoice $invoice)
    {
        return response()->json($this->repository->find($invoice));
    }

    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $invoice = $this->repository->update($invoice, $request->validated());
        return response()->json($invoice);
    }

    public function destroy(Invoice $invoice)
    {
        $this->repository->delete($invoice);
        return response()->json(null, 204);
    }
}
