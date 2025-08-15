<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository extends BaseRepository
{
    protected array $with = [];

    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }
}
