{{-- resources/views/blog/index.blade.php --}}
@extends('layouts.frontend')

@section('content')
<div class="text-center mb-16">
    <h1 class="text-5xl font-black text-gray-800 mb-6">Our Blog</h1>
    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Stay updated with the latest trends, tutorials, and insights from our development team.
    </p>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($posts ?? [] as $post)
    <article class="feature-card rounded-2xl overflow-hidden shadow-lg group">
        <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-500 group-hover:scale-105 transition-transform"></div>
        <div class="p-6">
            <div class="flex items-center text-sm text-gray-500 mb-2">
                <time>{{ $post->created_at->format('M j, Y') }}</time>
                <span class="mx-2">•</span>
                <span>{{ $post->read_time ?? '5' }} min read</span>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-indigo-600 transition-colors">
                {{ $post->title }}
            </h3>
            <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt ?? $post->content, 120) }}</p>
            <a href="{{ route('blog.show', $post) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                Read More →
            </a>
        </div>
    </article>
    @empty
    <div class="col-span-full text-center py-16">
        <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-100 flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">No Blog Posts Yet</h3>
        <p class="text-gray-600">Come back soon for insightful articles and tutorials!</p>
    </div>
    @endforelse
</div>

@if(isset($posts) && $posts->hasPages())
<div class="mt-12">
    {{ $posts->links() }}
</div>
@endif
@endsection
