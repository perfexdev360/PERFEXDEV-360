<?php

use App\Models\{Quote, QuoteItem, Invoice, User};
use function Pest\Laravel\post;
use function Pest\Laravel\actingAs;

it('calculates totals from line items', function () {
    $quote = Quote::factory()->create([
        'subtotal' => 0,
        'discount_total' => 0,
        'tax_total' => 0,
        'grand_total' => 0,
    ]);

    QuoteItem::factory()->for($quote)->create([
        'qty' => 2,
        'unit_price' => 50,
        'discount' => 5,
        'tax_rate' => 10,
    ]);

    QuoteItem::factory()->for($quote)->create([
        'qty' => 1,
        'unit_price' => 100,
        'discount' => 0,
        'tax_rate' => 20,
    ]);

    $quote->refresh();

    expect($quote->subtotal)->toBe('200.00');
    expect($quote->discount_total)->toBe('5.00');
    expect($quote->tax_total)->toBe('29.50');
    expect($quote->grand_total)->toBe('224.50');
});

it('approves a quote via e-sign and creates an invoice', function () {
    $quote = Quote::factory()->create([
        'subtotal' => 0,
        'discount_total' => 0,
        'tax_total' => 0,
        'grand_total' => 0,
    ]);

    QuoteItem::factory()->for($quote)->create([
        'qty' => 1,
        'unit_price' => 100,
        'discount' => 0,
        'tax_rate' => 20,
    ]);

    $quote->refresh();

    actingAs(User::factory()->create(['role' => 'client']));

    $response = post(route('portal.quotes.approve', $quote), [
        'legal_name' => 'Jane Doe',
        'accept_terms' => '1',
    ]);

    $response->assertSessionHasNoErrors();

    $quote->refresh();
    expect($quote->status)->toBe('approved');
    expect($quote->meta['signature']['name'])->toBe('Jane Doe');
    expect($quote->meta['signature']['ip_hash'])
        ->toBe(hash('sha256', '127.0.0.1'));
    expect($quote->meta['signature']['signed_at'])->not->toBeNull();

    $invoice = Invoice::first();
    expect($invoice)->not->toBeNull();
    expect($invoice->number)->toBe('INV-' . $quote->number);
    expect($invoice->grand_total)->toBe($quote->grand_total);
});

it('rejects a quote via e-sign', function () {
    $quote = Quote::factory()->create();

    actingAs(User::factory()->create(['role' => 'client']));

    $response = post(route('portal.quotes.reject', $quote), [
        'legal_name' => 'John Doe',
        'accept_terms' => '1',
    ]);

    $response->assertSessionHasNoErrors();

    $quote->refresh();
    expect($quote->status)->toBe('rejected');
    expect($quote->meta['signature']['name'])->toBe('John Doe');
    expect($quote->meta['signature']['ip_hash'])
        ->toBe(hash('sha256', '127.0.0.1'));
    expect($quote->meta['signature']['signed_at'])->not->toBeNull();
    expect(Invoice::count())->toBe(0);
});

