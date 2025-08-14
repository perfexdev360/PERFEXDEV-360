{{-- resources/views/products/index.blade.php --}}
@extends('layouts.frontend')

@section('content')
<div class="text-center mb-16">
    <h1 class="text-5xl font-black text-gray-800 mb-6">Our Products</h1>
    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Discover our range of innovative solutions designed to accelerate your business growth.
    </p>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($products ?? [] as $product)
    <div class="feature-card p-8 rounded-2xl shadow-lg group">
        <div class="w-16 h-16 gradient-bg rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $product->name }}</h3>
        <p class="text-gray-600 mb-6">{{ $product->description }}</p>
        <div class="flex justify-between items-center">
            <span class="text-2xl font-bold hero-text">${{ $product->price }}</span>
            <button class="cta-button text-white px-6 py-3 rounded-full font-semibold">
                Learn More
            </button>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-16">
        <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-100 flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">No Products Yet</h3>
        <p class="text-gray-600">Check back soon for exciting new products!</p>
    </div>
    @endforelse
</div>
@endsection

