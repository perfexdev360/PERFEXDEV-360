<?php

use App\Models\Product;
use function Pest\Laravel\get;

it('displays products list', function () {
    $product = Product::factory()->create(['name' => 'Test Product']);

    $response = get('/products');

    $response->assertStatus(200);
    $response->assertSee('Test Product');
});

it('shows product details', function () {
    $product = Product::factory()->create(['name' => 'Detail Product']);

    $response = get(route('products.show', $product->slug));

    $response->assertStatus(200);
    $response->assertSee('Detail Product');
});
