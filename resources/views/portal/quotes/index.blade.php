@extends('layouts.portal')

@section('portal-content')
<h1 class="text-2xl font-semibold mb-4">Quotes</h1>

<table class="min-w-full bg-white dark:bg-gray-900 rounded shadow">
    <thead class="bg-gray-100 dark:bg-gray-800 text-left">
        <tr>
            <th class="px-4 py-2">Number</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Total</th>
            <th class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($quotes as $quote)
            <tr class="border-t border-gray-200 dark:border-gray-700">
                <td class="px-4 py-2">{{ $quote->number }}</td>
                <td class="px-4 py-2 capitalize">{{ $quote->status }}</td>
                <td class="px-4 py-2">{{ $quote->grand_total }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('portal.quotes.show', $quote) }}" class="text-blue-600 hover:underline">View</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-4 text-center text-gray-500">No quotes found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $quotes->links() }}
</div>
@endsection
