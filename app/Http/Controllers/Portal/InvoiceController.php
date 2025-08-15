<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Services\FlowService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display the specified invoice.
     */
    public function show(Invoice $invoice)
    {
        return view('portal.invoices.show', compact('invoice'));
    }

    /**
     * Record a payment for the invoice.
     */
    public function pay(Request $request, Invoice $invoice, FlowService $flow): RedirectResponse
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
        ]);

        $flow->recordPayment($invoice, (float) $validated['amount']);

        return back()->with('status', 'Invoice paid.');
    }

    /**
     * Download a receipt PDF for the invoice.
     */
    public function receipt(Invoice $invoice)
    {
        $pdf = Pdf::loadView('invoices.receipt', [
            'invoice' => $invoice,
        ]);

        return $pdf->download('invoice-' . $invoice->number . '.pdf');
    }
}

