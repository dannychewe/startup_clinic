@extends('layouts.frontend')
@php
    // Use SEO fields if available, else fallback
    $seoTitle = $service->seo_title ?: ($service->name . " — Startup Clinic Zambia");
    $seoDesc  = $service->seo_description ?: Str::limit(strip_tags($service->short_description), 160);
    $seoKeys  = $service->seo_keywords ?: "startup clinic, consulting, branding, digital services, zambia startup support";

    $canonical = url()->current();

    // Feature image as OG image if exists
    $ogImg = $service->featured_image 
                ? asset('storage/'.$service->featured_image)
                : asset('assets/img/og/startup-clinic.jpg');
@endphp

@section('meta_title', $seoTitle)
@section('meta_description', $seoDesc)
@section('meta_keywords', $seoKeys)

@section('og_title', $seoTitle)
@section('og_description', $seoDesc)
@section('og_image', $ogImg)
@section('og_type', 'service')

@section('canonical', $canonical)


@push('structured_data')
@php
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type'    => 'Service',
        'name'     => $service->name,
        'description' => $seoDesc,
        'provider' => [
            '@type' => 'ProfessionalService',
            'name'  => 'Startup Clinic Zambia',
            'url'   => url('/'),
            'telephone' => '+260972991664',
            'email' => 'info@startupclinic.co.zm',
            'logo' => asset('assets/img/logo.svg'),
        ],
        'url' => url()->current(),
    ];

    // Add Sub-services as "offers"
    if ($service->subServices->count()) {
        $serviceSchema['hasOfferCatalog'] = [
            '@type' => 'OfferCatalog',
            'name'  => $service->name . ' — Sub-Services',
            'itemListElement' => $service->subServices->map(function($s) {
                return [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => $s->name,
                        'description' => strip_tags($s->description ?: ''),
                    ]
                ];
            })->toArray()
        ];
    }

    // Breadcrumb Schema
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
                'name' => 'Services',
                'item' => route('services.index')
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $service->name,
                'item' => url()->current()
            ]
        ]
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush


@section('content')

<!-- banner -->
<div class="mil-inner-banner">
    <div class="mil-animation-frame">
        <div class="mil-animation mil-position-4 mil-dark mil-scale"
             data-value-1="6" data-value-2="1.4"></div>
    </div>

    <div class="mil-banner-content mil-up">
        <div class="container">

            <ul class="mil-breadcrumbs mil-mb-60">
                <li><a href="{{ route('home') }}">Homepage</a></li>
                <li><a href="{{ route('services.index') }}">Services</a></li>
                <li><a href="{{ route('services.show', $service->slug) }}">{{ $service->name }}</a></li>
            </ul>

            {{-- Service Title (supports two-line split like template) --}}
            <h1 class="mil-mb-60">
                {!! nl2br(e($service->name)) !!}
            </h1>

            <a href="#service" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                <span>About service</span>
            </a>

        </div>
    </div>
</div>
<!-- banner end -->


<!-- service -->
<section id="service">
    <div class="container mil-p-120-90">
        <div class="row justify-content-between">

            <div class="col-lg-4 mil-relative mil-mb-90">

                <h4 class="mil-up mil-mb-30">
                    Our <span class="mil-thin">Approach</span><br>
                    to <span class="mil-thin">{{ $service->name }}</span>
                </h4>

                <p class="mil-up mil-mb-30">
                    {{ $service->short_description ?? 'This service helps businesses grow and scale effectively.' }}
                </p>

                <p class="mil-up mil-mb-30">
                    {!! $service->description  !!}
                </p>

                <div class="mil-up">
                    <a href="{{ route('projects.index') }}" class="mil-link mil-dark mil-arrow-place">
                        <span>View works</span>
                    </a>
                </div>

            </div>

            <div class="col-lg-6">

                {{-- Accordion Items = Subservices --}}
                @forelse($service->subServices as $sub)
                    <div class="mil-accordion-group mil-up">
                        <div class="mil-accordion-menu">
                            <p class="mil-accordion-head">{{ $sub->name }}</p>

                            <div class="mil-symbol mil-h3">
                                <div class="mil-plus">+</div>
                                <div class="mil-minus">-</div>
                            </div>
                        </div>

                        <div class="mil-accordion-content">
                            <p class="mil-mb-30">
                                {!!  $sub->description ?? 'More information coming soon.' !!}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="mil-up">More details coming soon.</p>
                @endforelse

            </div>

        </div>
    </div>
</section>
<!-- service end -->


<!-- other services -->
<section>
    <div class="container mil-p-120-90">

        <div class="row align-items-center mil-mb-30">
            <div class="col-lg-6 mil-mb-30">
                <h3 class="mil-up">Other services</h3>
            </div>

            <div class="col-lg-6 mil-mb-30">
                <div class="mil-adaptive-right mil-up">
                    <a href="{{ route('services.index') }}" class="mil-link mil-dark mil-arrow-place">
                        <span>View all</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">

            @foreach($services->where('id', '!=', $service->id)->take(3) as $other)
                <div class="col-lg-4">

                    <a href="{{ route('services.show', $other->slug) }}"
                       class="mil-service-card-lg mil-other-card mil-more mil-mb-30">

                        <h4 class="mil-up mil-mb-30">
                            {!! nl2br(e($other->name)) !!}
                        </h4>

                        <p class="mil-descr mil-up mil-mb-30">
                            {{ Str::words($other->short_description, 18, '...') }}
                        </p>

                        <ul class="mil-service-list mil-dark mil-mb-30">
                            @forelse($other->subServices->take(4) as $sub)
                                <li class="mil-up">{{ $sub->name }}</li>
                            @empty
                                <li class="mil-up">More info coming soon</li>
                            @endforelse
                        </ul>

                        <div class="mil-link mil-dark mil-arrow-place mil-up">
                            <span>Read more</span>
                        </div>

                    </a>

                </div>
            @endforeach

        </div>

    </div>
</section>
<!-- other services end -->

@endsection
