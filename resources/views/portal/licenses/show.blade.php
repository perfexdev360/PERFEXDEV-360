@extends('layouts.portal')

@section('portal-content')
<div class="p-4 space-y-6">
    <div>
        <h1 class="text-2xl font-bold mb-2">License Details</h1>
        <p class="font-mono">{{ $license->license_key }}</p>
        <form action="{{ route('licenses.rotate', $license) }}" method="POST" class="mt-2">
            @csrf
            <button class="px-3 py-1 bg-blue-600 text-white rounded" type="submit">Rotate Key</button>
        </form>
    </div>

    <div>
        <h2 class="text-xl font-semibold mb-2">Available Releases</h2>
        <ul class="space-y-4">
            @foreach($releases as $release)
                @php($artifact = $release->fileArtifacts->first())
                <li class="p-4 border border-gray-200 dark:border-gray-700 rounded">
                    <div class="font-medium">Version {{ optional($release->version)->name ?? 'N/A' }}</div>
                    <div class="prose prose-sm dark:prose-invert mt-2">
                        @foreach((array)$release->notes as $note)
                            <p>{{ $note }}</p>
                        @endforeach
                    </div>
                    @if($artifact)
                        <p class="mt-2 text-sm">Checksum: <span class="font-mono">{{ $artifact->hash }}</span></p>
                        <a href="{{ URL::temporarySignedRoute('licenses.download', now()->addMinutes(5), ['license' => $license->id, 'release' => $release->id]) }}" class="inline-block mt-2 px-3 py-1 bg-green-600 text-white rounded">Download</a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <div>
        <h2 class="text-xl font-semibold mb-2">Activation History</h2>
        <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
            <thead>
                <tr class="text-left">
                    <th class="px-4 py-2">Event</th>
                    <th class="px-4 py-2">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($license->activationHistory as $event)
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="px-4 py-2">{{ ucfirst($event->event) }}</td>
                        <td class="px-4 py-2">{{ $event->created_at->toDateTimeString() }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="px-4 py-4 text-center">No events.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
