<?php

namespace App\Models;

use App\Notifications\TicketCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'last_activity_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::created(function (Ticket $ticket) {
            Notification::route('mail', config('mail.from.address', 'support@example.com'))
                ->notify(new TicketCreated($ticket));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }
}
