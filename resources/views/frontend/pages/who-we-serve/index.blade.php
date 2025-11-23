@extends('layouts.frontend')


@php
    $title = "Who We Serve — Startup Clinic Zambia";
    $description = "We support founders, SMEs, enterprises, investors, NGOs, and organizations through consulting, branding, digital transformation, and growth services.";
    $keywords = "startup clinic who we serve, client types, founders, SMEs, consulting, Zambia, digital transformation";

    $canonical = url()->current();
    $image = asset('assets/img/og/startup-clinic.jpg');
@endphp

@section('meta_title', $title)
@section('meta_description', $description)
@section('meta_keywords', $keywords)
@section('canonical', $canonical)

@section('og_title', $title)
@section('og_description', $description)
@section('og_image', $image)
@section('og_type', 'website')

@section('twitter_title', $title)
@section('twitter_description', $description)
@section('twitter_image', $image)

@push('structured_data')
@php
    $json = [
        "@context" => "https://schema.org",
        "@type" => "ItemList",
        "name" => "Who We Serve",
        "description" => $description,
        "url" => $canonical,
        "itemListElement" => []
    ];

    foreach($items as $i => $item) {
        $json['itemListElement'][] = [
            "@type" => "ListItem",
            "position" => $i + 1,
            "url" => route('who-we-serve.show', $item->slug),
            "name" => $item->name
        ];
    }
@endphp

<script type="application/ld+json">
{!! json_encode($json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
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
                        <li><a href="{{ route('who-we-serve.index') }}">Who We Serve</a></li>
                    </ul>

                    <h1 class="mil-muted mil-mb-60">
                        Who <span class="mil-thin">We</span><br>
                        <span class="mil-thin">Serve</span>
                    </h1>

                    <a href="#wss-list" class="mil-link mil-accent mil-arrow-place mil-down-arrow">
                        <span>Our audience</span>
                    </a>

                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->

    <!-- services -->
    <section id="services">
        <div class="mi-invert-fix">
            <div class="container mil-p-120-60">
                <div class="row">
                    <div class="col-lg-5">

                        <div class="mil-lines-place mil-light"></div>

                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            @forelse($items as $item)
                            <div class="col-md-6 col-lg-6">

                                <a href="{{ route('who-we-serve.show', $item->slug) }}"
                                   class="mil-service-card-lg mil-more mil-accent-cursor {{ $loop->odd ? 'mil-offset' : '' }}">

                                    <h4 class="mil-muted mil-up mil-mb-30">
                                        {!! nl2br(e($item->name)) !!}
                                    </h4>

                                    <p class="mil-descr mil-light-soft mil-up mil-mb-30">
                                        {{ Str::words(strip_tags($item->description), 14, '...') }}
                                    </p>

                                    <ul class="mil-service-list mil-light mil-mb-30">
                                        <li class="mil-up">Learn more</li>
                                    </ul>

                                    <div class="mil-link mil-accent mil-arrow-place mil-up">
                                        <span>Read more</span>
                                    </div>
                                </a>

                            </div>
                        @empty
                            <div class="col-lg-12 mil-center">
                                <p class="mil-light-soft mil-up" style="padding: 60px 0;">
                                    Our audience segments are being updated. Check back soon!
                                </p>
                            </div>
                        @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- services end -->

<!-- call to action -->
<section class="mil-soft-bg">
    <div class="container mil-p-120-120">
        <div class="row">
            <div class="col-lg-10">
                <span class="mil-suptitle mil-suptitle-right mil-suptitle-dark mil-up">
                    Looking to make your mark? We'll help guide your journey.
                </span>
            </div>
        </div>
        <div class="mil-center">
            <h2 class="mil-up mil-mb-60">
                Let’s make an <span class="mil-thin">impact</span><br>
                together. Ready <span class="mil-thin">when you are</span>
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
