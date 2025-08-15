<?php

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketCreated;
use Illuminate\Support\Facades\Notification;

it('sends email when ticket is created', function () {
    Notification::fake();

    $user = User::factory()->create();

    Ticket::create([
        'user_id' => $user->id,
        'subject' => 'Support needed',
    ]);

    Notification::assertSentOnDemand(TicketCreated::class);
});
