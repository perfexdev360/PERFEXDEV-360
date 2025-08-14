<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\InvoicePaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class PayPalWebhookController extends Controller
{
    /**
     * Handle incoming PayPal webhook.
     */
    public function handle(Request $request)
    {
        if (! $this->verifySignature($request)) {
            Log::warning('PayPal webhook signature verification failed.');

            return response()->json(['status' => 'invalid signature'], 400);
        }

        $payload = json_decode($request->getContent(), true);
        $invoiceId = data_get($payload, 'resource.invoice_id') ?? data_get($payload, 'resource.custom_id');
        $txnId = data_get($payload, 'resource.id');
        $amount = data_get($payload, 'resource.amount.value');
        $currency = strtoupper(data_get($payload, 'resource.amount.currency_code') ?? data_get($payload, 'resource.amount.currency'));

        if (! $invoiceId || ! $invoice = Invoice::find($invoiceId)) {
            Log::warning('Invoice not found for PayPal webhook.', ['invoice_id' => $invoiceId]);

            return response()->json(['status' => 'invoice not found'], 404);
        }

        $invoice->status = 'paid';
        $invoice->save();

        $payment = new Payment();
        $payment->invoice_id = $invoice->id;
        $payment->provider = 'paypal';
        $payment->provider_txn_id = $txnId;
        $payment->amount = $amount;
        $payment->currency = $currency;
        $payment->status = 'succeeded';
        $payment->meta = json_encode($payload);
        $payment->paid_at = now();
        $payment->save();

        $order = Order::find($invoice->order_id);
        if ($order && $order->user_id) {
            $user = User::find($order->user_id);
            if ($user) {
                Notification::send($user, new InvoicePaid($invoice));
            }
        }

        Log::info('PayPal webhook processed.', ['invoice_id' => $invoice->id, 'txn' => $txnId]);

        return response()->json(['status' => 'ok']);
    }

    /**
     * Verify PayPal webhook signature.
     */
    protected function verifySignature(Request $request): bool
    {
        $secret = config('services.paypal.webhook_secret');
        $signature = $request->header('PayPal-Transmission-Sig');

        if (! $secret || ! $signature) {
            return false;
        }

        $expected = hash_hmac('sha256', $request->getContent(), $secret);

        return hash_equals($expected, $signature);
    }
}
