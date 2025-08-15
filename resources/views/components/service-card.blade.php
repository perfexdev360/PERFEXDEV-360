@props(['service'])

<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-2">
        <a href="{{ route('services.show', $service) }}" class="text-indigo-600 hover:underline">
            {{ $service->name }}
        </a>
    </h2>
    @if($service->summary)
        <p class="text-gray-700 mb-2">{{ $service->summary }}</p>
    @endif
    <div class="text-sm text-gray-500 space-y-1">
        @if($service->category)
            <p>Category: {{ $service->category }}</p>
        @endif
        @if($service->lead_time_days)
            <p>Lead time: {{ $service->lead_time_days }} days</p>
        @endif
        @if($service->min_price || $service->max_price)
            <p>Price:
                @if($service->min_price)
                    ${{ number_format($service->min_price, 2) }}
                @else
                    ?
                @endif
                –
                @if($service->max_price)
                    ${{ number_format($service->max_price, 2) }}
                @else
                    ?
                @endif
            </p>
        @endif
    </div>
</div>
