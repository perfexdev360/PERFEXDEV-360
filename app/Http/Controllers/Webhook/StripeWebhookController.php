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

class StripeWebhookController extends Controller
{
    /**
     * Handle incoming Stripe webhook.
     */
    public function handle(Request $request)
    {
        if (! $this->verifySignature($request)) {
            Log::warning('Stripe webhook signature verification failed.');

            return response()->json(['status' => 'invalid signature'], 400);
        }

        $payload = json_decode($request->getContent(), true);
        $invoiceId = data_get($payload, 'data.object.metadata.invoice_id');
        $txnId = data_get($payload, 'data.object.id');
        $amount = data_get($payload, 'data.object.amount_paid');
        $currency = strtoupper(data_get($payload, 'data.object.currency'));

        if (! $invoiceId || ! $invoice = Invoice::find($invoiceId)) {
            Log::warning('Invoice not found for Stripe webhook.', ['invoice_id' => $invoiceId]);

            return response()->json(['status' => 'invoice not found'], 404);
        }

        $invoice->status = 'paid';
        $invoice->save();

        $payment = new Payment();
        $payment->invoice_id = $invoice->id;
        $payment->provider = 'stripe';
        $payment->provider_txn_id = $txnId;
        $payment->amount = $amount ? $amount / 100 : 0;
        $payment->currency = $currency;
        $payment->status = 'succeeded';
        $payment->meta = $payload;
        $payment->paid_at = now();
        $payment->save();

        $order = Order::find($invoice->order_id);
        if ($order && $order->user_id) {
            $user = User::find($order->user_id);
            if ($user) {
                Notification::send($user, new InvoicePaid($invoice));
            }
        }

        Log::info('Stripe webhook processed.', ['invoice_id' => $invoice->id, 'txn' => $txnId]);

        return response()->json(['status' => 'ok']);
    }

    /**
     * Verify Stripe webhook signature.
     */
    protected function verifySignature(Request $request): bool
    {
        $secret = config('services.stripe.webhook_secret');
        $signature = $request->header('Stripe-Signature');

        if (! $secret || ! $signature) {
            return false;
        }

        $expected = hash_hmac('sha256', $request->getContent(), $secret);

        return hash_equals($expected, $signature);
    }
}
