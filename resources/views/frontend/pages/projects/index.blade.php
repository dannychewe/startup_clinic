@extends('layouts.frontend')
@php
    $page = request()->get('page', 1);

    $seoTitle = $page > 1
        ? "Projects — Portfolio Work (Page {$page}) | Startup Clinic"
        : "Startup Clinic Portfolio — Business, Branding, Websites & Consulting Projects";

    $seoDesc = "Explore Startup Clinic’s portfolio of branding, strategy, consulting, software, and marketing projects executed for SMEs, startups, corporates, and entrepreneurs.";

    $seoKeys = "startup clinic projects, portfolio, branding work, software development zambia, consulting portfolio, marketing agency zambia";

    $canonical = $page > 1
        ? request()->url() . '?page=' . $page
        : request()->url();

    $ogImg = asset('assets/img/og/startup-clinic.jpg'); // Your default OG image
@endphp

@section('meta_title', $seoTitle)
@section('meta_description', $seoDesc)
@section('meta_keywords', $seoKeys)

@section('og_title', $seoTitle)
@section('og_description', $seoDesc)
@section('og_image', $ogImg)
@section('og_type', 'website')

@section('canonical', $canonical)

{{-- Pagination prev/next --}}
@section('pagination_links')
    @if($projects->currentPage() > 1)
        <link rel="prev" href="{{ $projects->url($projects->currentPage() - 1) }}">
    @endif

    @if($projects->hasMorePages())
        <link rel="next" href="{{ $projects->url($projects->currentPage() + 1) }}">
    @endif
@endsection



@push('structured_data')
@php
    // ITEMLIST SCHEMA FOR PROJECTS
    $itemList = [
        '@context' => 'https://schema.org',
        '@type'    => 'ItemList',
        'name'     => 'Startup Clinic Project Portfolio',
        'itemListOrder' => 'Ascending',
        'numberOfItems' => $projects->count(),
        'itemListElement' => [],
    ];

    foreach ($projects as $index => $project) {
        $projectImg = $project->featured_image
            ? asset('storage/'.$project->featured_image)
            : asset('assets/img/og/startup-clinic.jpg');

        $itemList['itemListElement'][] = [
            '@type' => 'ListItem',
            'position' => ($projects->firstItem() ?? 1) + $index,
            'url' => route('projects.show', $project->slug),
            'item' => [
                '@type' => 'CreativeWork',
                'name' => $project->title,
                'image' => [$projectImg],
                'dateCreated' => optional($project->start_date)->toIso8601String(),
                'about' => $project->service->name ?? 'Project work',
            ]
        ];
    }

    // BREADCRUMB SCHEMA
    $breadcrumbs = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type'=>'ListItem',
                'position'=>1,
                'name'=>'Home',
                'item'=>url('/')
            ],
            [
                '@type'=>'ListItem',
                'position'=>2,
                'name'=>'Projects',
                'item'=>route('projects.index')
            ],
        ],
    ];

    if ($projects->currentPage() > 1) {
        $breadcrumbs['itemListElement'][] = [
            '@type'=>'ListItem',
            'position'=>3,
            'name'=>'Page '.$projects->currentPage(),
            'item'=>request()->fullUrl()
        ];
    }
@endphp

<script type="application/ld+json">{!! json_encode($itemList, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbs, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}</script>
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
            </ul>

            <h1 class="mil-mb-60">
                Designing a <br>
                Better <span class="mil-thin">World Today</span>
            </h1>

            <a href="#portfolio" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                <span>Our works</span>
            </a>

        </div>
    </div>
</div>
<!-- banner end -->


<!-- portfolio -->
<section id="portfolio">
    <div class="container mil-portfolio mil-p-120-60">

        <div class="mil-lines-place"></div>
        <div class="mil-lines-place mil-lines-long"></div>

        <div class="row justify-content-between align-items-center">

            @forelse ($projects as $project)
                {{-- Determine left or right layout based on loop index --}}
                @php
                    $isLeft = $loop->iteration % 2 !== 0; 
                @endphp

                <div class="col-lg-{{ $isLeft ? '5' : '6' }}">

                    <a href="{{ route('projects.show', $project->slug) }}"
                       class="mil-portfolio-item mil-more mil-mb-60
                              {{ $isLeft ? '' : 'mil-parallax' }}"
                       @if(!$isLeft) data-value-1="60" data-value-2="-60" @endif>

                        <div class="mil-cover-frame {{ $isLeft ? 'mil-vert' : 'mil-hori' }} mil-up">
                            <div class="mil-cover">
                                <img src="{{ asset('storage/' . $project->featured_image) }}"
                                     alt="{{ $project->title }}">
                            </div>
                        </div>

                        <div class="mil-descr">
                            <div class="mil-labels mil-up mil-mb-15">
                                <div class="mil-label mil-upper mil-accent">
                                    {{ $project->service->name ?? 'Service' }}
                                </div>

                                <div class="mil-label mil-upper">
                                    {{ optional($project->start_date)->format('M d Y') ?? '---' }}
                                </div>
                            </div>

                            <h4 class="mil-up">
                                {{ $project->title }}
                            </h4>
                        </div>

                    </a>

                </div>

            @empty

                <div class="col-lg-12 mil-center mil-up mil-mb-60">
                    <h3>No projects yet</h3>
                    <p class="mil-light-soft">Our work portfolio is still being prepared.</p>
                </div>

            @endforelse

            <!-- pagination -->
            <div class="col-lg-12">
                <div class="mil-pagination">
                    {!! $projects->links('pagination::bootstrap-4') !!}
                </div>
            </div>

        </div>

    </div>
</section>
<!-- portfolio end -->


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
                <br> We're <span class="mil-thin">here to help</span>
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
