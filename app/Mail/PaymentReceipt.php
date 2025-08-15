<?php

namespace App\Mail;

use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Payment $payment)
    {
    }

    public function build()
    {
        $pdf = Pdf::loadView('invoices.receipt', [
            'invoice' => $this->payment->invoice,
            'payment' => $this->payment,
        ]);

        return $this->subject('Payment Receipt')
            ->view('emails.payment-receipt', [
                'payment' => $this->payment,
            ])
            ->attachData($pdf->output(), 'invoice-'.$this->payment->invoice->number.'.pdf');
    }
}
