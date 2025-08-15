@extends('layouts.frontend')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-5xl font-black text-gray-800 mb-4">{{ $product->name }}</h1>
    <p class="text-gray-600 mb-6">{{ $product->summary }}</p>
    <div class="prose max-w-none">
        {{ $product->description }}
    </div>
</div>
@endsection
