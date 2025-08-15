@extends('layouts.portal')

@section('portal-content')
<div class="p-4 space-y-4">
    <h1 class="text-2xl font-bold">Invoice #{{ $invoice->number }}</h1>
    <p>Status: {{ ucfirst($invoice->status ?? 'pending') }}</p>
    <p>Total: {{ number_format($invoice->grand_total, 2) }} USD</p>

    @if(session('status'))
        <div class="text-green-600">{{ session('status') }}</div>
    @endif

    @if(($invoice->status ?? '') !== 'paid')
        <form method="POST" action="{{ route('portal.invoices.pay', $invoice) }}" class="mt-4">
            @csrf
            <input type="hidden" name="amount" value="{{ $invoice->grand_total }}">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Pay Now</button>
        </form>
    @else
        <a href="{{ route('portal.invoices.receipt', $invoice) }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded">Download Receipt</a>
    @endif
</div>
@endsection

