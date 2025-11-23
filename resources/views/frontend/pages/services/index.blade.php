@extends('layouts.frontend')
@php
    $seoTitle = "Our Services — Startup Clinic Zambia";
    $seoDesc  = "Explore Startup Clinic’s full range of services including business consulting, branding, digital strategy, website development, marketing, and startup support.";
    $seoKeys  = "startup clinic services, business consulting zambia, branding agency, marketing agency zambia, digital transformation, website development, strategy consulting";

    $canonical = url()->current();

    $ogImg = asset('assets/img/og/startup-clinic.jpg');
@endphp

@section('meta_title', $seoTitle)
@section('meta_description', $seoDesc)
@section('meta_keywords', $seoKeys)

@section('og_title', $seoTitle)
@section('og_description', $seoDesc)
@section('og_image', $ogImg)
@section('og_type', 'website')

@section('canonical', $canonical)



@push('structured_data')
@php
    // Generate Service List
    $serviceItems = [];
    foreach ($services as $s) {
        $serviceItems[] = [
            '@type' => 'Service',
            'name' => $s->name,
            'description' => $s->short_description ?: 'Business & digital service offered by Startup Clinic.',
            'url' => route('services.show', $s->slug),
        ];
    }

    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ServiceCatalog',
        'name' => 'Startup Clinic Services',
        'description' => $seoDesc,
        'provider' => [
            '@type' => 'Organization',
            'name' => 'Startup Clinic Zambia',
            'logo' => asset('assets/img/logo.svg'),
        ],
        'service' => $serviceItems,
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
                'name' => 'Services',
                'item' => route('services.index')
            ],
        ],
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
<div class="mil-dark-bg">
    <div class="mil-inner-banner">
        <div class="mi-invert-fix">
            <div class="mil-banner-content mil-up">
                <div class="mil-animation-frame">
                    <div class="mil-animation mil-position-4 mil-scale" data-value-1="6" data-value-2="1.4"></div>
                </div>
                <div class="container">
                    <ul class="mil-breadcrumbs mil-light mil-mb-60">
                        <li><a href="{{ route('home') }}">Homepage</a></li>
                        <li><a href="{{ route('services.index') }}">Services</a></li>
                    </ul>

                    <h1 class="mil-muted mil-mb-60">
                        This is <span class="mil-thin">what</span><br>
                        we do <span class="mil-thin">best</span>
                    </h1>

                    <a href="#services" class="mil-link mil-accent mil-arrow-place mil-down-arrow">
                        <span>Our services</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->

    <section id="services">
    <div class="mi-invert-fix">
        <div class="container mil-p-120-60">

            <div class="row">

                <div class="col-lg-5">
                    <div class="mil-lines-place mil-light"></div>
                </div>

                <div class="col-lg-7">
                    <div class="row">

                        @foreach ($services as $service)
                            <div class="col-md-6 col-lg-6">

                                <a href="{{ route('services.show', $service->slug) }}"
                                   class="mil-service-card-lg mil-more mil-accent-cursor @if($loop->even) mil-offset @endif">

                                    <h4 class="mil-muted mil-up mil-mb-30">
                                        {!! nl2br(e($service->name)) !!}
                                    </h4>

                                    <p class="mil-descr mil-light-soft mil-up mil-mb-30">
                                        {{ Str::words($service->short_description, 20, '...') }}
                                    </p>

                                    <ul class="mil-service-list mil-light mil-mb-30">
                                        @forelse($service->subServices as $sub)
                                            <li class="mil-up">{{ $sub->name }}</li>
                                        @empty
                                            <li class="mil-up">More details coming soon</li>
                                        @endforelse
                                    </ul>

                                    <div class="mil-link mil-accent mil-arrow-place mil-up">
                                        <span>Read more</span>
                                    </div>

                                </a>

                            </div>
                        @endforeach

                    </div>
                </div>

            </div>

        </div>
    </div>
</section>


<!-- call to action -->
<section class="mil-soft-bg">
    <div class="container mil-p-120-120">
        <div class="row">
            <div class="col-lg-10">

                <span class="mil-suptitle mil-suptitle-right mil-suptitle-dark mil-up">Looking to make your mark? We'll help you turn <br> your project into a success story.</span>

            </div>
        </div>
        <div class="mil-center">
            <h2 class="mil-up mil-mb-60">Let’s make an <span class="mil-thin">impact</span><br> together. Ready <span class="mil-thin">when you are</span></h2>
            <div class="mil-up"><a href="contact.html" class="mil-button mil-arrow-place"><span>Contact us</span></a></div>
        </div>
    </div>
</section>
<!-- call to action end -->

@endsection



