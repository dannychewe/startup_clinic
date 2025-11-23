@extends('layouts.frontend')
@php
    // Auto-generate SEO fields:
    $title = $item->name . " — Who We Serve | Startup Clinic";
    $description = Str::limit(strip_tags($item->description), 150);
    $keywords = strtolower($item->name) . ", startup clinic, business consulting, who we serve, Zambia";

    $canonical = url()->current();

    $image = $item->image
        ? asset('storage/' . $item->image)
        : asset('assets/img/og/startup-clinic.jpg');
@endphp

@section('meta_title', $title)
@section('meta_description', $description)
@section('meta_keywords', $keywords)
@section('canonical', $canonical)

@section('og_title', $title)
@section('og_description', $description)
@section('og_image', $image)
@section('og_type', 'article')

@section('twitter_title', $title)
@section('twitter_description', $description)
@section('twitter_image', $image)

@push('structured_data')
@php
    // Main schema for the page
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "Article",
        "headline" => $title,
        "description" => $description,
        "image" => [$image],
        "url" => $canonical,
        "dateModified" => optional($item->updated_at)->toIso8601String(),
        "publisher" => [
            "@type" => "Organization",
            "name" => "Startup Clinic Zambia",
            "logo" => [
                "@type" => "ImageObject",
                "url" => asset('assets/img/logo.svg'),
            ],
        ],
        "mainEntity" => [
            "@type" => "Audience",
            "audienceType" => $item->name,
        ]
    ];

    // Breadcrumb schema
    $breadcrumbs = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Home",
                "item" => url('/')
            ],
            [
                "@type" => "ListItem",
                "position" => 2,
                "name" => "Who We Serve",
                "item" => route('who-we-serve.index')
            ],
            [
                "@type" => "ListItem",
                "position" => 3,
                "name" => $item->name,
                "item" => $canonical
            ],
        ]
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')

<!-- banner -->
<div class="mil-inner-banner">
    <div class="mil-banner-content mil-center mil-up">
        <div class="container">
            <ul class="mil-breadcrumbs mil-center mil-mb-60">
                <li><a href="{{ route('home') }}">Homepage</a></li>
                <li><a href="{{ route('who-we-serve.index') }}">Who We Serve</a></li>
                <li><a href="{{ route('who-we-serve.show', $item->slug) }}">Details</a></li>
            </ul>

            <h2>
                {{ $item->name }}
            </h2>
        </div>
    </div>
</div>
<!-- banner end -->


<!-- content -->
<section id="blog">
    <div class="container mil-p-120-90">
        <div class="row justify-content-center">
            
            <div class="col-lg-12">

                @if($item->image)
                    <div class="mil-image-frame mil-horizontal mil-up">
                        <img src="{{ asset('storage/'.$item->image) }}"
                             alt="{{ $item->name }}"
                             class="mil-scale"
                             data-value-1=".90"
                             data-value-2="1.15">
                    </div>
                @endif

                <div class="mil-info mil-up mil-mb-90">
                    <div>Category: &nbsp;<span class="mil-dark">Who We Serve</span></div>
                    <div>Updated: &nbsp;<span class="mil-dark">{{ $item->updated_at->format('M d, Y') }}</span></div>
                    <div>Type: &nbsp;<span class="mil-dark">{{ $item->name }}</span></div>
                </div>

            </div>

            <div class="col-lg-8">

                <!-- render rich HTML safely -->
                {!! $item->description !!}

            </div>

        </div>
    </div>
</section>
<!-- content end -->


<!-- similar (other groups) -->
<section class="mil-soft-bg">
    <div class="container mil-p-120-60">
        <div class="row align-items-center mil-mb-30">
            <div class="col-lg-6 mil-mb-30">
                <h3 class="mil-up">Other Groups We Serve:</h3>
            </div>
            <div class="col-lg-6 mil-mb-30">
                <div class="mil-adaptive-right mil-up">
                    <a href="{{ route('who-we-serve.index') }}" class="mil-link mil-dark mil-arrow-place">
                        <span>View all</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">

            @foreach($items as $other)
                @if($other->id !== $item->id)
                    <div class="col-lg-6">

                        <a href="{{ route('who-we-serve.show', $other->slug) }}" class="mil-blog-card mil-mb-60">
                            <div class="mil-cover-frame mil-up">
                                <img src="{{ asset('storage/'.$other->image) }}"
                                     alt="{{ $other->name }}">
                            </div>

                            <div class="mil-post-descr">
                                <div class="mil-labels mil-up mil-mb-30">
                                    <div class="mil-label mil-upper mil-accent">Group</div>
                                    <div class="mil-label mil-upper">{{ $other->updated_at->format('M d Y') }}</div>
                                </div>

                                <h4 class="mil-up mil-mb-30">{{ $other->name }}</h4>

                                <p class="mil-post-text mil-up mil-mb-30">
                                    {{ Str::words(strip_tags($other->description), 25, '...') }}
                                </p>

                                <div class="mil-link mil-dark mil-arrow-place mil-up">
                                    <span>Read more</span>
                                </div>
                            </div>

                        </a>

                    </div>
                @endif
            @endforeach

        </div>
    </div>
</section>
<!-- similar end -->

@endsection
