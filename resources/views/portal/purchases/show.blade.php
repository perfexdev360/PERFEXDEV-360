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

    @if($order->status === 'paid')
        <div>
            <h2 class="text-xl font-semibold mb-2">Your Review</h2>
            @php($review = $order->reviews->firstWhere('user_id', auth()->id()))
            <form method="POST" action="{{ $review ? route('portal.purchases.review.update', $order) : route('portal.purchases.review.store', $order) }}" class="space-y-4">
                @csrf
                @if($review)
                    @method('PUT')
                @endif
                <div>
                    <label class="block mb-1">Rating</label>
                    <select name="rating" class="border rounded p-2">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @selected(old('rating', $review->rating ?? '') == $i)>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block mb-1">Comment</label>
                    <textarea name="comment" class="border rounded w-full p-2">{{ old('comment', $review->comment ?? '') }}</textarea>
                </div>
                <button class="px-4 py-2 bg-blue-600 text-white rounded">
                    {{ $review ? 'Update Review' : 'Submit Review' }}
                </button>
            </form>
        </div>
    @endif
</div>
@endsection
