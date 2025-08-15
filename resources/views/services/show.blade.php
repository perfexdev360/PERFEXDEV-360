@extends('layouts.frontend')

@section('content')
    <h1 class="text-4xl font-bold mb-4">{{ $service->name }}</h1>
    @if($service->summary)
        <p class="text-gray-700 mb-6">{{ $service->summary }}</p>
    @endif
    @if($service->body)
        <div class="prose mb-6">{!! nl2br(e($service->body)) !!}</div>
    @endif

    <h2 class="text-2xl font-semibold mb-4">Request a Quote</h2>
    <form action="{{ route('rfq.store', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @foreach($service->options as $option)
            <div>
                <label class="block font-medium mb-1">{{ $option->name }}</label>
                @if($option->type === 'select')
                    <select name="options[{{ $option->slug }}]" class="border rounded w-full p-2">
                        @foreach($option->config['choices'] ?? [] as $choice)
                            <option value="{{ $choice }}">{{ ucfirst($choice) }}</option>
                        @endforeach
                    </select>
                @else
                    <input type="checkbox" name="options[{{ $option->slug }}]" value="1" {{ $option->is_default ? 'checked' : '' }}>
                @endif
            </div>
        @endforeach
        <div>
            <label class="block font-medium mb-1">Attachments</label>
            <input type="file" name="files[]" multiple class="border rounded w-full p-2" />
        </div>
        <div>
            <label class="block font-medium mb-1">Notes</label>
            <textarea name="notes" class="border rounded w-full p-2"></textarea>
        </div>
        <button type="submit" class="cta-button text-white px-6 py-2 rounded">Submit</button>
    </form>

    @if($service->faqs->count())
        <h2 class="text-2xl font-semibold mt-12 mb-4">FAQs</h2>
        <div class="space-y-4">
            @foreach($service->faqs as $faq)
                <div>
                    <h3 class="font-medium">{{ $faq->question }}</h3>
                    <p class="text-gray-700">{{ $faq->answer }}</p>
                </div>
            @endforeach
        </div>
    @endif

    @if($service->caseStudies->count())
        <h2 class="text-2xl font-semibold mt-12 mb-4">Case Studies</h2>
        <ul class="list-disc pl-5 space-y-1">
            @foreach($service->caseStudies as $case)
                <li>{{ $case->title }}</li>
            @endforeach
        </ul>
    @endif
@endsection
