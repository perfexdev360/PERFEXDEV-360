{{-- resources/views/contact/index.blade.php --}}
@extends('layouts.frontend')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-16">
        <h1 class="text-5xl font-black text-gray-800 mb-6">Get In Touch</h1>
        <p class="text-xl text-gray-600">
            Ready to start your project? We'd love to hear from you.
        </p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Let's Connect</h2>
            <p class="text-gray-600 mb-8">
                Have a project in mind? Whether you need web development, mobile apps, or consulting services,
                we're here to help bring your vision to life.
            </p>

            <div class="space-y-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold">Email</div>
                        <div class="text-gray-600">hello@perfexdev360.com</div>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold">Phone</div>
                        <div class="text-gray-600">+1 (555) 123-4567</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="feature-card p-8 rounded-2xl shadow-lg">
            <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors"
                           value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors"
                           value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subject</label>
                    <input type="text" id="subject" name="subject" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors"
                           value="{{ old('subject') }}">
                    @error('subject')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                    <textarea id="message" name="message" rows="5" required
                              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full cta-button text-white py-4 rounded-lg font-semibold text-lg">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
