@extends('layouts.portal')

@section('portal-content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Orders</h1>
    <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
        <thead>
            <tr class="text-left">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Product</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr class="border-t border-gray-200 dark:border-gray-700">
                    <td class="px-4 py-2">#{{ $order->id }}</td>
                    <td class="px-4 py-2">{{ optional($order->license->product)->name }}</td>
                    <td class="px-4 py-2">{{ $order->created_at->toDateString() }}</td>
                    <td class="px-4 py-2"><a href="{{ route('purchases.show', $order) }}" class="text-blue-600 hover:underline">View</a></td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-4 text-center">No orders found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
