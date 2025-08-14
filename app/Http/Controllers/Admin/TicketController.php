<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TicketRequest;
use App\Models\Ticket;
use App\Repositories\TicketRepository;

class TicketController extends Controller
{
    public function __construct(protected TicketRepository $repository)
    {
        $this->authorizeResource(Ticket::class, 'ticket');
    }

    public function index()
    {
        return response()->json($this->repository->all());
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(TicketRequest $request)
    {
        $ticket = $this->repository->create($request->validated());
        return response()->json($ticket, 201);
    }

    public function show(Ticket $ticket)
    {
        return response()->json($this->repository->find($ticket));
    }

    public function edit(Ticket $ticket)
    {
        return response()->json($this->repository->find($ticket));
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        $ticket = $this->repository->update($ticket, $request->validated());
        return response()->json($ticket);
    }

    public function destroy(Ticket $ticket)
    {
        $this->repository->delete($ticket);
        return response()->json(null, 204);
    }
}
