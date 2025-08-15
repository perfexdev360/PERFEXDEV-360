@props([
    'canonical' => url()->current(),
    'robots' => 'index, follow',
    'organization' => null,
    'website' => null,
    'breadcrumb' => null,
    'faq' => null,
    'product' => null,
    'blogPosting' => null,
])

<link rel="canonical" href="{{ $canonical }}">
<meta name="robots" content="{{ $robots }}">

@php
$blocks = [$organization, $website, $breadcrumb, $faq, $product, $blogPosting];
@endphp

@foreach ($blocks as $block)
    @if ($block)
        <script type="application/ld+json">
            {!! json_encode($block, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    @endif
@endforeach
