<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderReviewController extends Controller
{
    public function store(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string'],
        ]);

        abort_unless($order->status === 'paid' && $order->user_id === Auth::id(), 403);

        OrderReview::updateOrCreate(
            ['order_id' => $order->id, 'user_id' => Auth::id()],
            $data
        );

        return back()->with('status', 'Review submitted');
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string'],
        ]);

        abort_unless($order->status === 'paid' && $order->user_id === Auth::id(), 403);

        $review = $order->reviews()->where('user_id', Auth::id())->firstOrFail();
        $review->update($data);

        return back()->with('status', 'Review updated');
    }
}
