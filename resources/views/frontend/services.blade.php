{{-- resources/views/services/index.blade.php --}}
@extends('layouts.frontend')

@section('content')
<div class="text-center mb-16">
    <h1 class="text-5xl font-black text-gray-800 mb-6">Our Services</h1>
    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Comprehensive solutions tailored to meet your unique business needs.
    </p>
</div>

<div class="space-y-12">
    @php
        $services = [
            [
                'title' => 'Web Development',
                'description' => 'Custom Laravel applications, responsive design, and modern web solutions.',
                'features' => ['Laravel Framework', 'Responsive Design', 'API Development', 'Database Design'],
                'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'
            ],
            [
                'title' => 'Mobile Development',
                'description' => 'Native and cross-platform mobile applications for iOS and Android.',
                'features' => ['React Native', 'Flutter', 'iOS Development', 'Android Development'],
                'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z'
            ],
            [
                'title' => 'Cloud Solutions',
                'description' => 'Scalable cloud infrastructure and deployment solutions.',
                'features' => ['AWS Deployment', 'Docker Containers', 'CI/CD Pipelines', 'Load Balancing'],
                'icon' => 'M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10'
            ]
        ];
    @endphp

    @foreach($services as $index => $service)
    <div class="flex flex-col lg:flex-row items-center gap-12 {{ $index % 2 == 1 ? 'lg:flex-row-reverse' : '' }}">
        <div class="lg:w-1/2">
            <div class="w-16 h-16 gradient-bg rounded-xl flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $service['icon'] }}"></path>
                </svg>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-4">{{ $service['title'] }}</h3>
            <p class="text-lg text-gray-600 mb-6">{{ $service['description'] }}</p>
            <ul class="space-y-2 mb-8">
                @foreach($service['features'] as $feature)
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $feature }}
                </li>
                @endforeach
            </ul>
            <button class="cta-button text-white px-8 py-4 rounded-full font-semibold">
                Get Started
            </button>
        </div>
        <div class="lg:w-1/2">
            <div class="bg-gradient-to-br from-indigo-100 to-purple-100 rounded-3xl p-12 h-64 flex items-center justify-center">
                <div class="text-6xl opacity-20">{{ $index + 1 }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
