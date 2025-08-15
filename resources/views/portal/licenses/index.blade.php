@extends('layouts.portal')

@section('portal-content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Licenses</h1>
    <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
        <thead>
            <tr class="text-left">
                <th class="px-4 py-2">Product</th>
                <th class="px-4 py-2">License Key</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($licenses as $license)
                <tr class="border-t border-gray-200 dark:border-gray-700">
                    <td class="px-4 py-2">{{ $license->product->name }}</td>
                    <td class="px-4 py-2 font-mono text-sm">{{ $license->license_key }}</td>
                    <td class="px-4 py-2"><a href="{{ route('licenses.show', $license) }}" class="text-blue-600 hover:underline">Manage</a></td>
                </tr>
            @empty
                <tr><td colspan="3" class="px-4 py-4 text-center">No licenses found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
