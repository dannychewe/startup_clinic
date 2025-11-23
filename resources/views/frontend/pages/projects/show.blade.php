@extends('layouts.frontend')
@php
    $title = $project->seo_title ?: $project->title . " — Project by Startup Clinic";
    $description = $project->seo_description ?: Str::limit(strip_tags($project->summary ?? $project->description), 150);
    $keywords = $project->seo_keywords ?: "startup projects, branding, software development, marketing, startup clinic portfolio, Zambia digital agency";

    $canonical = url()->current();

    $image = $project->featured_image
                ? asset('storage/'.$project->featured_image)
                : asset('assets/img/og/startup-clinic.jpg');

    $published = optional($project->start_date)->toIso8601String();
    $modified  = optional($project->updated_at)->toIso8601String();
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
    $projectJson = [
        "@context" => "https://schema.org",
        "@type" => "CreativeWork",
        "name" => $project->title,
        "headline" => $project->title,
        "description" => $description,
        "url" => $canonical,
        "datePublished" => $published,
        "dateModified" => $modified,
        "image" => [$image],
        "author" => [
            "@type" => "Organization",
            "name" => "Startup Clinic Zambia",
            "url" => url('/'),
        ],
        "creator" => [
            "@type" => "Organization",
            "name" => "Startup Clinic Zambia"
        ],
        "about" => [
            "@type" => "Service",
            "name" => $project->service->name ?? "Service"
        ],
    ];

    $breadcrumbs = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => url('/')
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Projects',
                'item' => route('projects.index')
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $project->title,
                'item' => $canonical
            ],
        ],
    ];
@endphp

<script type="application/ld+json">{!! json_encode($projectJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush



@section('content')

<!-- banner -->
<div class="mil-inner-banner">
    <div class="mil-banner-content mil-up">
        <div class="mil-animation-frame">
            <div class="mil-animation mil-position-4 mil-dark mil-scale"
                 data-value-1="6" data-value-2="1.4"></div>
        </div>

        <div class="container">
            <ul class="mil-breadcrumbs mil-mb-60">
                <li><a href="{{ route('home') }}">Homepage</a></li>
                <li><a href="{{ route('projects.index') }}">Projects</a></li>
                <li><a href="{{ route('projects.show', $project->slug) }}">Project</a></li>
            </ul>

            <h1 class="mil-mb-60">
                {{ $project->title }} 
                @if($project->subService)
                    <span class="mil-thin">{{ $project->subService->name }}</span>
                @endif
            </h1>

            <a href="#project" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                <span>Read more</span>
            </a>
        </div>
    </div>
</div>
<!-- banner end -->


<!-- project -->
<section id="project">
    <div class="container mil-p-120-120">

        {{-- PROJECT GALLERY / SWIPER --}}
        <div class="swiper-container mil-1-slider mil-up">
            <div class="swiper-wrapper">

                {{-- If you have multiple gallery images in future --}}
                @if(is_array($project->deliverables) && count($project->deliverables))
                    @foreach($project->deliverables as $image)
                        <div class="swiper-slide">
                            <div class="mil-image-frame mil-horizontal mil-drag">
                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $project->title }}">
                                <a data-fancybox="gallery" data-no-swup
                                   href="{{ asset('storage/' . $image) }}" class="mil-zoom-btn">
                                    <img src="/img/icons/zoom.svg" alt="zoom">
                                </a>
                            </div>
                        </div>
                    @endforeach

                {{-- Otherwise: use only featured image --}}
                @else
                    <div class="swiper-slide">
                        <div class="mil-image-frame mil-horizontal mil-drag">
                            <img src="{{ asset('storage/' . $project->featured_image) }}"
                                 alt="{{ $project->title }}">
                            <a data-fancybox="gallery" data-no-swup
                               href="{{ asset('storage/' . $project->featured_image) }}"
                               class="mil-zoom-btn">
                                <img src="/img/icons/zoom.svg" alt="zoom">
                            </a>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        {{-- Project Info Row --}}
        <div class="mil-info mil-up">
            <div>Client: 
                &nbsp;<span class="mil-dark">
                    {{ $project->client->company_name ?? 'N/A' }}
                </span>
            </div>

            <div>Date: 
                &nbsp;<span class="mil-dark">
                    {{ optional($project->start_date)->format('M Y') ?? '---' }}
                </span>
            </div>

            <div>Service: 
                &nbsp;<span class="mil-dark">
                    {{ $project->service->name ?? 'N/A' }}
                </span>
            </div>
        </div>

        {{-- Description --}}
        <div class="row justify-content-between mil-p-120-90">
            <div class="col-lg-5">
                <h3 class="mil-up mil-mb-60">
                    {{ $project->summary ?? 'Project Details' }}
                </h3>
            </div>

            <div class="col-lg-6">
                <p class="mil-up mil-mb-30">
                    {!! nl2br(e($project->description)) !!}
                </p>
            </div>
        </div>

        {{-- NEXT / PREVIOUS NAVIGATION --}}
        <div class="mil-works-nav mil-up">

            @if($prev)
            <a href="{{ route('projects.show', $prev->slug) }}"
               class="mil-link mil-dark mil-arrow-place mil-icon-left">
                <span>Prev project</span>
            </a>
            @endif

            <a href="{{ route('projects.index') }}" class="mil-link mil-dark">
                <span>All projects</span>
            </a>

            @if($next)
            <a href="{{ route('projects.show', $next->slug) }}"
               class="mil-link mil-dark mil-arrow-place">
                <span>Next project</span>
            </a>
            @endif

        </div>

    </div>
</section>
<!-- project end -->


<!-- call to action -->
<section class="mil-soft-bg">
    <div class="container mil-p-120-120">
        <div class="row">
            <div class="col-lg-10">
                <span class="mil-suptitle mil-suptitle-right mil-suptitle-dark mil-up">
                    Looking to make your mark? We'll help you turn 
                    your project into a success story.
                </span>
            </div>
        </div>

        <div class="mil-center">
            <h2 class="mil-up mil-mb-60">
                Ready to bring your <span class="mil-thin">ideas to</span> life? 
                <br>We're <span class="mil-thin">here to help</span>
            </h2>

            <div class="mil-up">
                <a href="{{ route('contact.index') }}" class="mil-button mil-arrow-place">
                    <span>Contact us</span>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- call to action end -->

@endsection
