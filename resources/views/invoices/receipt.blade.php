<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ \$invoice->number }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
    </style>
</head>
<body>
    <h1>Invoice #{{ \$invoice->number }}</h1>
    <p>Amount: {{ number_format(\$invoice->grand_total, 2) }} USD</p>
    @if(\$vat = data_get(\$invoice->order->billing_info, 'vat'))
        <p>VAT/GST: {{ \$vat }}</p>
    @endif
    <p>Thank you for your business.</p>
</body>
</html>
