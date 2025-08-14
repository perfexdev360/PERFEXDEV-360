@extends('layouts.frontend')

@section('content')
<div class="text-center mb-16">
    <h2 class="text-4xl md:text-6xl font-black text-gray-800 mb-6">
        Welcome to <span class="hero-text">{{ config('app.name') }}</span>
    </h2>
    <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed mb-12">
        We specialize in creating exceptional digital experiences that drive results.
        From web development to mobile apps, we bring your vision to life with precision and creativity.
    </p>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
    <div class="text-center p-6">
        <div class="text-4xl font-bold hero-text mb-2">150+</div>
        <div class="text-gray-600">Projects Completed</div>
    </div>
    <div class="text-center p-6">
        <div class="text-4xl font-bold hero-text mb-2">98%</div>
        <div class="text-gray-600">Client Satisfaction</div>
    </div>
    <div class="text-center p-6">
        <div class="text-4xl font-bold hero-text mb-2">24/7</div>
        <div class="text-gray-600">Support Available</div>
    </div>
    <div class="text-center p-6">
        <div class="text-4xl font-bold hero-text mb-2">5+</div>
        <div class="text-gray-600">Years Experience</div>
    </div>
</div>

<div class="bg-white rounded-3xl p-12 shadow-2xl">
    <h3 class="text-3xl font-bold text-center mb-12">Our Latest Projects</h3>
    <div class="grid md:grid-cols-3 gap-8">
        <div class="group cursor-pointer">
            <div class="bg-gradient-to-br from-purple-400 to-blue-500 h-48 rounded-2xl mb-4 group-hover:scale-105 transition-transform"></div>
            <h4 class="font-semibold text-lg">E-Commerce Platform</h4>
            <p class="text-gray-600">Full-stack Laravel application</p>
        </div>
        <div class="group cursor-pointer">
            <div class="bg-gradient-to-br from-green-400 to-teal-500 h-48 rounded-2xl mb-4 group-hover:scale-105 transition-transform"></div>
            <h4 class="font-semibold text-lg">Mobile App</h4>
            <p class="text-gray-600">React Native with Laravel API</p>
        </div>
        <div class="group cursor-pointer">
            <div class="bg-gradient-to-br from-pink-400 to-red-500 h-48 rounded-2xl mb-4 group-hover:scale-105 transition-transform"></div>
            <h4 class="font-semibold text-lg">SaaS Dashboard</h4>
            <p class="text-gray-600">Vue.js with Laravel backend</p>
        </div>
    </div>
</div>
@endsection




