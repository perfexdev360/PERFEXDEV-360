<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Invoice;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Config;

it('handles stripe invoice paid webhook', function () {
    Config::set('services.stripe.webhook_secret', 'test_secret');
    Notification::fake();

    $user = User::factory()->create();

    $order = Order::unguarded(fn () => Order::create([
        'user_id' => $user->id,
        'number' => 'ORD-100',
        'currency' => 'USD',
        'status' => 'pending',
    ]));

    $invoice = Invoice::unguarded(fn () => Invoice::create([
        'order_id' => $order->id,
        'number' => 'INV-100',
        'currency' => 'USD',
    ]));

    $payload = [
        'data' => [
            'object' => [
                'id' => 'txn_1',
                'amount_paid' => 1000,
                'currency' => 'usd',
                'metadata' => [
                    'invoice_id' => $invoice->id,
                ],
            ],
        ],
    ];

    $body = json_encode($payload);
    $signature = hash_hmac('sha256', $body, 'test_secret');

    $this->postJson('/webhooks/stripe', $payload, ['Stripe-Signature' => $signature])
        ->assertOk();

    expect($invoice->fresh()->status)->toBe('paid');
    Notification::assertSentTo($user, InvoicePaid::class);
});
