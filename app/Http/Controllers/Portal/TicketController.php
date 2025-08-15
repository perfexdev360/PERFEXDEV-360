<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tickets = $request->user()->tickets()->latest()->get();

        if ($request->wantsJson()) {
            return response()->json($tickets);
        }

        return view('portal.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json([]);
        }

        return view('portal.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        $ticket = $request->user()->tickets()->create($request->validated());

        if ($request->wantsJson()) {
            return response()->json($ticket, 201);
        }

        return redirect()->route('tickets.show', $ticket)
            ->with('status', 'Ticket created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Ticket $ticket)
    {
        abort_if($ticket->user_id !== $request->user()->id, 403);

        $ticket->load('replies');

        if ($request->wantsJson()) {
            return response()->json($ticket);
        }

        return view('portal.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Ticket $ticket)
    {
        abort_if($ticket->user_id !== $request->user()->id, 403);

        if ($request->wantsJson()) {
            return response()->json($ticket);
        }

        return view('portal.tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        abort_if($ticket->user_id !== $request->user()->id, 403);

        $ticket->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json($ticket);
        }

        return redirect()->route('tickets.show', $ticket)
            ->with('status', 'Ticket updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Ticket $ticket)
    {
        abort_if($ticket->user_id !== $request->user()->id, 403);

        $ticket->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('tickets.index')
            ->with('status', 'Ticket deleted.');
    }
}
