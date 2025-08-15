<?php

use App\Models\{Quote, QuoteItem, Invoice, User, Order};
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use function Pest\Laravel\postJson;

it('creates invoice on quote approval and marks it paid via webhook', function () {
    Config::set('services.stripe.webhook_secret', 'test_secret');
    Notification::fake();

    $quote = Quote::factory()->create();
    QuoteItem::factory()->for($quote)->create([
        'qty' => 1,
        'unit_price' => 100,
        'discount' => 0,
        'tax_rate' => 0,
    ]);

    $user = User::factory()->create(['role' => 'client']);
    actingAs($user);

    post(route('portal.quotes.approve', $quote), [
        'legal_name' => 'Jane Doe',
        'accept_terms' => '1',
    ])->assertSessionHasNoErrors();

    $invoice = Invoice::first();
    expect($invoice)->not->toBeNull();

    $payload = [
        'data' => [
            'object' => [
                'id' => 'txn_1',
                'amount_paid' => 10000,
                'currency' => 'usd',
                'metadata' => ['invoice_id' => $invoice->id],
            ],
        ],
    ];
    $body = json_encode($payload);
    $signature = hash_hmac('sha256', $body, 'test_secret');

    postJson('/webhooks/stripe', $payload, ['Stripe-Signature' => $signature])
        ->assertOk();

    expect($invoice->fresh()->status)->toBe('paid');
    Notification::assertSentTo($user, InvoicePaid::class);
});
