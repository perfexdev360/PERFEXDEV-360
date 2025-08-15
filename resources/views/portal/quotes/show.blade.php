@extends('layouts.portal')

@section('portal-content')
<h1 class="text-2xl font-semibold mb-4">Quote {{ $quote->number }}</h1>

<div class="mb-4">
    <p><strong>Status:</strong> <span class="capitalize">{{ $quote->status }}</span></p>
    <p><strong>Valid Until:</strong> {{ optional($quote->valid_until)->toFormattedDateString() }}</p>
    <p><strong>Total:</strong> {{ $quote->grand_total }}</p>
</div>

<h2 class="text-xl font-semibold mb-2">Items</h2>
<table class="min-w-full bg-white dark:bg-gray-900 rounded shadow">
    <thead class="bg-gray-100 dark:bg-gray-800 text-left">
        <tr>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Qty</th>
            <th class="px-4 py-2">Unit Price</th>
            <th class="px-4 py-2">Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse($quote->items as $item)
            <tr class="border-t border-gray-200 dark:border-gray-700">
                <td class="px-4 py-2">{{ $item->title }}</td>
                <td class="px-4 py-2">{{ $item->qty }}</td>
                <td class="px-4 py-2">{{ $item->unit_price }}</td>
                <td class="px-4 py-2">{{ $item->qty * $item->unit_price }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-4 text-center text-gray-500">No items.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
