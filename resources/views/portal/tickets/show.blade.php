@extends('layouts.portal')

@section('portal-content')
<div class="p-4 space-y-4">
    <h1 class="text-2xl font-bold">{{ $ticket->subject }}</h1>

    @if($ticket->order_id)
        <div>Order #{{ $ticket->order_id }}</div>
    @endif

    <div class="prose">
        {{ $ticket->body }}
    </div>

    <div class="mt-6">
        <h2 class="font-semibold mb-2">Replies</h2>
        <div class="space-y-4">
            @foreach($ticket->replies as $reply)
                <div class="border p-2">
                    <p class="mb-1 text-sm text-gray-600">{{ $reply->created_at->format('Y-m-d H:i') }}</p>
                    <p>{{ $reply->body }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

