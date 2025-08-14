@extends('layouts.frontend')

@section('content')
<h1 class="text-3xl font-bold mb-6">Contact Us</h1>
<form method="POST" action="{{ route('contact.store') }}" class="max-w-lg">
    @csrf
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1" for="name">Name</label>
        <input class="w-full border-gray-300 rounded" name="name" id="name" value="{{ old('name') }}" required>
        @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1" for="email">Email</label>
        <input type="email" class="w-full border-gray-300 rounded" name="email" id="email" value="{{ old('email') }}" required>
        @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1" for="phone">Phone</label>
        <input class="w-full border-gray-300 rounded" name="phone" id="phone" value="{{ old('phone') }}">
        @error('phone')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1" for="message">Message</label>
        <textarea class="w-full border-gray-300 rounded" name="message" id="message" rows="5" required>{{ old('message') }}</textarea>
        @error('message')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" type="submit">Send</button>
</form>
@endsection
