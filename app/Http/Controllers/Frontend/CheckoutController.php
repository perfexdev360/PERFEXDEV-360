<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\{Product, Order, Invoice, Payment, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stripe\StripeClient;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class CheckoutController extends Controller
{
    public function show(Product $product)
    {
        return view('frontend.checkout', compact('product'));
    }

    public function process(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'provider' => 'required|in:stripe,paypal',
            'vat_number' => 'nullable|string',
        ]);

        $user = User::firstOrCreate(
            ['email' => $data['email']],
            ['name' => $data['name'], 'password' => bcrypt(Str::random())]
        );

        return DB::transaction(function () use ($data, $product, $user) {
            $order = Order::create([
                'user_id' => $user->id,
                'number' => Str::upper(Str::random(10)),
                'currency' => 'USD',
                'subtotal' => $product->price,
                'grand_total' => $product->price,
                'status' => 'pending',
                'billing_info' => ['vat' => $data['vat_number']],
            ]);

            $invoice = Invoice::create([
                'order_id' => $order->id,
                'number' => Str::upper(Str::random(10)),
                'subtotal' => $product->price,
                'grand_total' => $product->price,
                'status' => 'pending',
            ]);

            $txnId = null;
            if ($data['provider'] === 'stripe') {
                $stripe = new StripeClient(config('services.stripe.secret'));
                try {
                    $intent = $stripe->paymentIntents->create([
                        'amount' => (int) ($product->price * 100),
                        'currency' => 'usd',
                        'metadata' => ['invoice_id' => $invoice->id],
                    ]);
                    $txnId = $intent->id;
                } catch (\Throwable $e) {
                    $txnId = 'stripe_error';
                }
            } else {
                $environment = new SandboxEnvironment(
                    config('services.paypal.client_id'),
                    config('services.paypal.client_secret')
                );
                $client = new PayPalHttpClient($environment);
                try {
                    $create = new OrdersCreateRequest();
                    $create->prefer('return=representation');
                    $create->body = [
                        'intent' => 'CAPTURE',
                        'purchase_units' => [[
                            'amount' => [
                                'currency_code' => 'USD',
                                'value' => number_format($product->price, 2, '.', ''),
                            ],
                            'custom_id' => (string) $invoice->id,
                        ]],
                    ];
                    $response = $client->execute($create);
                    $txnId = $response->result->id ?? null;

                    $capture = new OrdersCaptureRequest($txnId);
                    $client->execute($capture);
                } catch (\Throwable $e) {
                    $txnId = 'paypal_error';
                }
            }

            $payment = $invoice->payments()->create([
                'provider' => $data['provider'],
                'provider_txn_id' => $txnId,
                'amount' => $product->price,
                'currency' => 'USD',
                'status' => 'succeeded',
                'paid_at' => now(),
            ]);

            return view('frontend.checkout-success', compact('order', 'invoice', 'payment'));
        });
    }
}
