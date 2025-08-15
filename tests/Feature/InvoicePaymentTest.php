<?php

use App\Mail\PaymentReceipt;
use App\Models\{Invoice, User};
use Illuminate\Support\Facades\Mail;
use function Pest\Laravel\post;
use function Pest\Laravel\actingAs;

it('records a payment and emails a receipt', function () {
    Mail::fake();

    $invoice = Invoice::factory()->create([
        'grand_total' => 100,
        'status' => 'pending',
    ]);

    actingAs(User::factory()->create(['role' => 'client']));

    post(route('portal.invoices.pay', $invoice), [
        'amount' => 100,
    ])->assertSessionHasNoErrors();

    expect($invoice->fresh()->status)->toBe('paid');
    Mail::assertSent(PaymentReceipt::class);
});

