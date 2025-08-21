<?php

use App\Models\Order;
use App\Models\OrderReview;
use App\Models\User;
use function Pest\Laravel\actingAs;

it('allows authenticated users to submit a review', function () {
    $user = User::factory()->create();
    $order = Order::factory()->for($user)->create(['status' => 'paid']);

    actingAs($user);

    $this->postJson('/api/v1/orders/'.$order->id.'/review', [
        'rating' => 5,
        'comment' => 'Great!',
    ])->assertCreated();

    $this->assertDatabaseHas('order_reviews', [
        'order_id' => $order->id,
        'user_id' => $user->id,
        'rating' => 5,
    ]);

    expect($order->fresh()->average_rating)->toBe(5.0);
});

it('allows users to update their review', function () {
    $user = User::factory()->create();
    $order = Order::factory()->for($user)->create(['status' => 'paid']);
    $review = OrderReview::factory()->for($order)->for($user)->create(['rating' => 4]);

    actingAs($user);

    $this->putJson('/api/v1/orders/'.$order->id.'/review', [
        'rating' => 3,
        'comment' => 'Okay',
    ])->assertOk();

    $this->assertDatabaseHas('order_reviews', [
        'id' => $review->id,
        'rating' => 3,
        'comment' => 'Okay',
    ]);

    expect($order->fresh()->average_rating)->toBe(3.0);
});
