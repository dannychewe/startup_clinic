@extends('layouts.frontend')
@section('meta_title', 'Contact Startup Clinic — Let’s Talk About Your Business Growth')
@section('meta_description', 'Get in touch with Startup Clinic Zambia for consulting, strategy, branding, digital transformation, software development, and business growth support.')
@section('meta_keywords', 'contact Startup Clinic, business consulting Zambia, digital agency Zambia, software development, branding, strategy')
@section('og_type', 'website')
@section('og_image', asset('assets/img/og/startup-clinic.jpg'))

@section('twitter_title', 'Contact Startup Clinic — Business & Startup Growth Experts')
@section('twitter_description', 'Reach out to Startup Clinic Zambia to discuss your project, business challenges or growth goals.')

@section('content')

<!-- banner -->
<div class="mil-inner-banner mil-p-0-120">
    <div class="mil-banner-content mil-center mil-up">
        <div class="container">
            <ul class="mil-breadcrumbs mil-center mil-mb-60">
                <li><a href="{{ route('home') }}">Homepage</a></li>
                <li><a href="{{ route('contact.index') }}">Contact</a></li>
            </ul>
            <h1 class="mil-mb-60">Get in touch!</h1>
            <a href="#contact" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                <span>Send message</span>
            </a>
        </div>
    </div>
</div>
<!-- banner end -->

<!-- map -->
<div class="mil-map-frame mil-up">
    <div class="mil-map">
        
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3846.603181642477!2d28.297897199999998!3d-15.397962499999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2ac7d88b7b722683%3A0x9ce13fc383098122!2sStartup%20Clinic%20Zambia!5e0!3m2!1sen!2szm!4v1764336967196!5m2!1sen!2szm" 
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>
<!-- map end -->

<!-- contact form -->
<section id="contact">
    <div class="container mil-p-120-90">

        <h3 class="mil-center mil-up mil-mb-120">Let's <span class="mil-thin">Talk</span></h3>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="mil-center" style="color:#28a745; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- ERROR MESSAGE -->
        @if($errors->any())
            <div class="mil-center" style="color:#ff5e5e; margin-bottom:20px;">
                {{ $errors->first() }}
            </div>
        @endif


        <form class="row align-items-center"
              method="POST"
              action="{{ route('contact.submit') }}">

            @csrf
            
            <!-- Honeypot field -->
            <input type="text" name="website" style="display:none !important">

            <div class="col-lg-6 mil-up">
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="What's your name"
                       required>
            </div>

            <div class="col-lg-6 mil-up">
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Your Email"
                       required>
            </div>

            <div class="col-lg-12 mil-up">
                <input type="text"
                       name="subject"
                       value="{{ old('subject') }}"
                       placeholder="Subject"
                       required>
            </div>

            <div class="col-lg-12 mil-up">
                <textarea
                    name="message"
                    placeholder="Tell us about your project"
                    required>{{ old('message') }}</textarea>
            </div>

            <div class="col-lg-12 mil-up">
                <input type="text"
                       name="phone"
                       value="{{ old('phone') }}"
                       placeholder="Phone (optional)">
            </div>

            <div class="col-lg-8">
                <p class="mil-up mil-mb-30">
                    <span class="mil-accent">*</span>
                    We promise not to disclose your personal information to third parties.
                </p>
            </div>

            <div class="col-lg-4">
                <div class="mil-adaptive-right mil-up mil-mb-30">
                    <button type="submit" class="mil-button mil-arrow-place">
                        <span>Send message</span>
                    </button>
                </div>
            </div>
        </form>

    </div>
</section>
<!-- contact form end -->

@endsection
