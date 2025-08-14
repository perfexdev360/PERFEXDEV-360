@extends('layouts.app')

@section('content')
<nav class="flex space-x-4 mb-4 bg-gray-100 dark:bg-gray-800 p-2 rounded">
    <a href="#" class="px-2 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Home</a>
    <a href="#" class="px-2 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Projects</a>
    <a href="#" class="px-2 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Support</a>
</nav>
<div>
    @yield('portal-content')
</div>
@endsection
