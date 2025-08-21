<?php

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\TaxLine;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('associates items and tax lines with an order', function () {
    $order = Order::factory()->create();
    $product = Product::factory()->create();

    $item = OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'qty' => 1,
        'unit_price' => 100,
        'tax_amount' => 10,
        'discount_amount' => 0,
        'total' => 110,
    ]);

    $taxLine = new TaxLine();
    $taxLine->order_id = $order->id;
    $taxLine->name = 'VAT';
    $taxLine->amount = 10;
    $taxLine->save();

    expect($order->items)->toHaveCount(1)
        ->and($order->items->first()->is($item))->toBeTrue()
        ->and($order->taxLines)->toHaveCount(1)
        ->and($order->taxLines->first()->is($taxLine))->toBeTrue();
});

it('order item belongs to order and product', function () {
    $order = Order::factory()->create();
    $product = Product::factory()->create();

    $item = OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'qty' => 2,
        'unit_price' => 50,
        'tax_amount' => 0,
        'discount_amount' => 0,
        'total' => 100,
    ]);

    expect($item->order->is($order))->toBeTrue()
        ->and($item->product->is($product))->toBeTrue();
});

