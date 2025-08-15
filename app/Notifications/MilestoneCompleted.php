<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MilestoneCompleted extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $message, public ?string $url = null)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Milestone Completed')
            ->view('emails.milestone_completed', [
                'message' => $this->message,
                'url' => $this->url,
            ]);
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => $this->message,
            'url' => $this->url,
        ];
    }
}

