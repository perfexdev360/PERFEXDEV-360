@extends('layouts.frontend')

@section('content')
    <h1 class="text-4xl font-bold mb-8">Services</h1>
    <div class="grid md:grid-cols-3 gap-6">
        @foreach($services as $service)
            <x-service-card :service="$service" />
        @endforeach
    </div>
@endsection
