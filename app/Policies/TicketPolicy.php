<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    /**
     * Determine whether the user can view any tickets.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'client'], true);
    }

    /**
     * Determine whether the user can view a ticket.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        return $user->role === 'admin'
            || $ticket->user_id === $user->id
            || ($ticket->project && $ticket->project->user_id === $user->id);
    }

    /**
     * Determine whether the user can create tickets.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'client'], true);
    }

    /**
     * Determine whether the user can update the ticket.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        return $user->role === 'admin'
            || $ticket->user_id === $user->id
            || ($ticket->project && $ticket->project->user_id === $user->id);
    }

    /**
     * Determine whether the user can delete the ticket.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        return $user->role === 'admin'
            || $ticket->user_id === $user->id
            || ($ticket->project && $ticket->project->user_id === $user->id);
    }
}
