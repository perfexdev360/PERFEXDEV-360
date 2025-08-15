@php
    $phone = \App\Models\Setting::where('key', 'cta_phone')->value('value') ?? '03390123735';
@endphp
<a href="tel:{{ $phone }}" class="inline-flex items-center font-semibold text-blue-600 hover:underline">
    {{ $slot->isEmpty() ? 'Call or WhatsApp ' . $phone : $slot }}
</a>
