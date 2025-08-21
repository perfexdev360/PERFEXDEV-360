@extends('layouts.portal')

@section('portal-content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Open Ticket</h1>

    <form method="POST" action="{{ route('portal.tickets.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1 font-medium" for="subject">Subject</label>
            <input id="subject" name="subject" type="text" class="w-full border p-2" required>
        </div>

        <div>
            <label class="block mb-1 font-medium" for="order_id">Order</label>
            <select id="order_id" name="order_id" class="w-full border p-2">
                <option value="">-- None --</option>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}">Order #{{ $order->id }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium" for="priority">Priority</label>
            <select id="priority" name="priority" class="w-full border p-2">
                <option value="low">Low</option>
                <option value="normal" selected>Normal</option>
                <option value="high">High</option>
                <option value="urgent">Urgent</option>
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium" for="body">Message</label>
            <textarea id="body" name="body" rows="6" class="w-full border p-2" required></textarea>
        </div>

        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
        </div>
    </form>
</div>
@endsection

