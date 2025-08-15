@extends('layouts.portal')

@section('portal-content')
<h1 class="text-2xl font-semibold mb-4">Edit Quote {{ $quote->number }}</h1>

<form method="POST" action="{{ route('portal.quotes.update', $quote) }}" class="space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm font-medium text-gray-700">Valid Until</label>
        <input type="date" name="valid_until" value="{{ optional($quote->valid_until)->format('Y-m-d') }}" class="mt-1 block w-full border-gray-300 rounded" />
    </div>
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
</form>

@endsection
