@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">AI Content Queue</h1>

    <table class="w-full table-auto">
        <thead>
            <tr class="text-left">
                <th class="px-2 py-1">Title</th>
                <th class="px-2 py-1">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr class="border-t">
                    <td class="px-2 py-1">{{ $post->title }}</td>
                    <td class="px-2 py-1 space-x-2">
                        <form method="POST" action="{{ route('ai-queue.approve', $post) }}" class="inline">
                            @csrf
                            <button class="text-green-600 hover:underline">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('ai-queue.reject', $post) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Reject</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="px-2 py-4 text-center text-gray-500">No drafts in queue.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
