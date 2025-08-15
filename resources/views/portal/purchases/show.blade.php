@extends('layouts.portal')

@section('portal-content')
<div class="p-4 space-y-6">
    <div>
        <h1 class="text-2xl font-bold mb-2">Order #{{ $order->id }}</h1>
        <p class="text-sm text-gray-500">Placed {{ $order->created_at->toDayDateTimeString() }}</p>
    </div>

    <div>
        <h2 class="text-xl font-semibold mb-2">Product</h2>
        <p>{{ optional($order->license->product)->name }}</p>
    </div>

    <div>
        <h2 class="text-xl font-semibold mb-2">Invoices</h2>
        <ul class="list-disc pl-4">
            @forelse($order->invoices as $invoice)
                <li><span class="font-mono">{{ $invoice->number ?? 'N/A' }}</span> - {{ $invoice->status ?? 'Pending' }}</li>
            @empty
                <li>No invoices associated.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
