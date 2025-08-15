@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl mb-4">Checkout - {{ \$product->name }}</h1>
    <form method="POST" action="{{ route('checkout.process', \$product) }}" class="space-y-4">
        @csrf
        <div>
            <label class="block">Name</label>
            <input type="text" name="name" class="border p-2 w-full" required>
        </div>
        <div>
            <label class="block">Email</label>
            <input type="email" name="email" class="border p-2 w-full" required>
        </div>
        <div>
            <label class="block">VAT/GST Number</label>
            <input type="text" name="vat_number" class="border p-2 w-full">
        </div>
        <div>
            <label class="block">Payment Method</label>
            <select name="provider" class="border p-2 w-full" required>
                <option value="stripe">Stripe</option>
                <option value="paypal">PayPal</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Pay {{ number_format(\$product->price,2) }}</button>
    </form>
</div>
@endsection
