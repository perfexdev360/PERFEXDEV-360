<?php

use App\Models\Order;
use App\Models\Ticket;
use App\Models\User;
use App\Http\Controllers\Portal\TicketController;
use App\Http\Requests\Portal\TicketRequest;
use Illuminate\Support\Str;

it('opens a ticket for an order and stores the message', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create(['user_id' => $user->id]);
    config(['app.key' => Str::random(32)]);

    $request = TicketRequest::create('/portal/tickets', 'POST', [
        'subject' => 'Order issue',
        'priority' => 'normal',
        'body' => 'Need help with order',
        'order_id' => $order->id,
    ]);
    $request->setUserResolver(fn () => $user);
    $request->setContainer(app());
    $request->validateResolved();

    $controller = app(TicketController::class);
    $controller->store($request);

    $ticket = Ticket::first();

    expect($ticket->order_id)->toBe($order->id);
    expect($ticket->body)->toBe('Need help with order');
    expect($ticket->replies()->first()->body)->toBe('Need help with order');
});

