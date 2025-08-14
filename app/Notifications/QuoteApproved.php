<?php

namespace App\Notifications;

use App\Models\Quote;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class QuoteApproved extends Notification
{
    use Queueable;

    public function __construct(
        protected Quote $quote,
        protected Invoice $invoice
    ) {
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Quote Approved')
            ->line('Your quote #' . $this->quote->number . ' has been approved.')
            ->action('View Invoice', url('/invoices/' . $this->invoice->id));
    }
}
