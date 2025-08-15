<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        $orders = auth()->user()
            ->orders()
            ->with('license.product')
            ->latest()
            ->get();

        return view('portal.purchases.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        $order->load(['license.product', 'invoices']);

        return view('portal.purchases.show', compact('order'));
    }
}
