@extends('layouts.frontend')

@section('meta_title', 'Startup Clinic — We Diagnose. We Build. You Grow.')
@section('meta_description', 'Startup Clinic helps founders, SMEs, and organisations in Zambia diagnose business gaps, build better systems, and grow using consulting, branding, software development, web design, and digital marketing.')
@section('meta_keywords', 'Startup Clinic, startup consulting Zambia, business growth, digital transformation, branding, web design, software development, marketing strategy, SME support')
@section('og_type', 'website')
@section('og_image', asset('assets/img/og/startup-clinic.jpg'))

@section('twitter_title', 'Startup Clinic — Business & Startup Growth Experts')
@section('twitter_description', 'We diagnose business gaps, build stronger systems, and help founders and SMEs grow sustainably across Zambia.')

@section('content')

    {{-- HERO SECTION --}}
    @include('frontend.sections.hero')

    {{-- ABOUT SECTION --}}
    @include('frontend.sections.about')

    {{-- SERVICES SECTION --}}
    @include('frontend.sections.services')

    {{-- WHO WE SERVE SECTION --}}
    @include('frontend.sections.serve')


    {{-- TESTIMONIALS / REVIEWS --}}
    @include('frontend.sections.reviews')

    {{-- PARTNERS --}}
    @include('frontend.sections.partners')

    {{-- TEAM SECTION --}}
    @include('frontend.sections.team')

    {{-- BLOG SECTION --}}
    @include('frontend.sections.blog')

@endsection
