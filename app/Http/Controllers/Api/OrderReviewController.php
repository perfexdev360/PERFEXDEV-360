<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderReview;
use Illuminate\Http\Request;

class OrderReviewController extends Controller
{
    public function store(Request $request, Order $order)
    {
        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string'],
        ]);

        abort_unless($order->status === 'paid' && $order->user_id === $request->user()->id, 403);

        $review = OrderReview::updateOrCreate(
            ['order_id' => $order->id, 'user_id' => $request->user()->id],
            $data
        );

        return response()->json($review, 201);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string'],
        ]);

        abort_unless($order->status === 'paid' && $order->user_id === $request->user()->id, 403);

        $review = $order->reviews()->where('user_id', $request->user()->id)->firstOrFail();
        $review->update($data);

        return response()->json($review);
    }
}
