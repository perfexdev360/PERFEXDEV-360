<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Invoice;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Config;

it('handles paypal invoice paid webhook', function () {
    Config::set('services.paypal.webhook_secret', 'paypal_secret');
    Notification::fake();

    $user = User::factory()->create();

    $order = Order::unguarded(fn () => Order::create([
        'user_id' => $user->id,
        'number' => 'ORD-200',
        'currency' => 'USD',
        'status' => 'pending',
    ]));

    $invoice = Invoice::unguarded(fn () => Invoice::create([
        'order_id' => $order->id,
        'number' => 'INV-200',
        'currency' => 'USD',
    ]));

    $payload = [
        'resource' => [
            'id' => 'txn_2',
            'amount' => [
                'value' => '10.00',
                'currency_code' => 'USD',
            ],
            'invoice_id' => $invoice->id,
        ],
    ];

    $body = json_encode($payload);
    $signature = hash_hmac('sha256', $body, 'paypal_secret');

    $this->postJson('/webhooks/paypal', $payload, ['PayPal-Transmission-Sig' => $signature])
        ->assertOk();

    expect($invoice->fresh()->status)->toBe('paid');
    Notification::assertSentTo($user, InvoicePaid::class);
});
