@extends('layouts.portal')

@section('portal-content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Tickets</h1>

    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-2 text-left">Subject</th>
                <th class="px-4 py-2 text-left">Order</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
                <tr class="border-t">
                    <td class="px-4 py-2">
                        <a href="{{ route('portal.tickets.show', $ticket) }}" class="text-blue-600">{{ $ticket->subject }}</a>
                    </td>
                    <td class="px-4 py-2">
                        {{ $ticket->order_id ? 'Order #' . $ticket->order_id : '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="px-4 py-2 text-center text-gray-500">No tickets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

