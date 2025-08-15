@extends('layouts.app')

@section('content')
<nav class="flex space-x-4 mb-4 bg-gray-100 dark:bg-gray-800 p-2 rounded">
    <x-nav-item href="#" icon="🏠" label="Home" />
    <x-nav-item href="#" icon="📁" label="Projects" />
    <x-nav-item href="#" icon="🆘" label="Support" />
</nav>
<div>
    @yield('portal-content')
</div>
@endsection
