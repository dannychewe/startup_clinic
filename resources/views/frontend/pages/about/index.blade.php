@extends('layouts.frontend')
@section('meta_title', 'About Startup Clinic — Who We Are & How We Help')
@section('meta_description', 'Learn about Startup Clinic Zambia: our story, mission, vision, values, and the way we support founders and businesses with consulting, branding, digital products, and growth systems.')
@section('meta_keywords', 'about Startup Clinic, startup consulting team, business clinic Zambia, mission and vision, founders')
@section('og_type', 'website')

@if($about && $about->featured_image)
    @section('og_image', asset('storage/'.$about->featured_image))
@else
    @section('og_image', asset('assets/img/og/startup-clinic.jpg'))
@endif

@section('content')

<!-- banner -->
<div class="mil-inner-banner">
    <div class="mil-banner-content mil-center mil-up">
        <div class="container">

            <ul class="mil-breadcrumbs mil-center mil-mb-60">
                <li><a href="{{ route('home') }}">Homepage</a></li>
                <li><a href="{{ route('about.index') }}">About Us</a></li>
            </ul>

            <h2>
                About <span class="mil-thin">The Startup</span><br>
                <span class="mil-thin">Clinic</span>
            </h2>

        </div>
    </div>
</div>
<!-- banner end -->


<!-- about content -->
<section id="about">
    <div class="container mil-p-120-90">
        <div class="row justify-content-center">

            <!-- Featured Image -->
            <div class="col-lg-12">

                @if($about && $about->featured_image)
                    <div class="mil-image-frame mil-horizontal mil-up">
                        <img src="{{ asset('storage/'.$about->featured_image) }}"
                             alt="About Startup Clinic"
                             class="mil-scale"
                             data-value-1=".90"
                             data-value-2="1.15">
                    </div>
                @endif

                <div class="mil-info mil-up mil-mb-90">
                    <div>About Us</div>
                    <div>Updated: &nbsp;<span class="mil-dark">{{ $about ? $about->updated_at->format('M d, Y') : '' }}</span></div>
                    <div>Founder: &nbsp;<span class="mil-dark">Startup Clinic</span></div>
                </div>

            </div>

            <!-- ABOUT TEXT CONTENT -->
            <div class="col-lg-8">

                @if($about && $about->founder_message)
                    <div class="mil-text-xl mil-dark mil-up mil-mb-60">
                        {!! $about->founder_message !!}
                    </div>
                @endif

                @if($about && $about->story)
                    <h5 class="mil-up mil-mb-30">Our Story</h5>
                    <div class="mil-up mil-mb-60">{!! $about->story !!}</div>
                @endif

                @if($about && $about->mission)
                    <h5 class="mil-up mil-mb-30">Our Mission</h5>
                    <div class="mil-up mil-mb-60">{!! $about->mission !!}</div>
                @endif

                @if($about && $about->vision)
                    <h5 class="mil-up mil-mb-30">Our Vision</h5>
                    <div class="mil-up mil-mb-60">{!! $about->vision !!}</div>
                @endif

                @if($about && $about->philosophy)
                    <h5 class="mil-up mil-mb-30">Our Philosophy</h5>
                    <div class="mil-up mil-mb-60">{!! $about->philosophy !!}</div>
                @endif

                <!-- Values -->
                @if($about && is_array($about->values))
                    <h5 class="mil-up mil-mb-30">Our Core Values</h5>

                    <div class="row">
                        @foreach($about->values as $val)
                            <div class="col-lg-6">
                                <div class="mil-horizontal mil-up mil-mb-30">
                                    <div class="mil-dark" style="padding:30px; border-radius:10px;">
                                        {!! is_array($val) ? implode(', ', $val) : $val !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

        </div>
    </div>
</section>
<!-- about end -->

@endsection
