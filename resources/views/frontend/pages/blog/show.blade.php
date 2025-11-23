@extends('layouts.frontend')

@php
    // Dynamic SEO from DB
    $seoTitle = $blog->seo_title ?: $blog->title . ' — Startup Clinic Blog';
    $seoDesc  = $blog->seo_description ?: Str::limit(strip_tags($blog->excerpt), 160);
    $seoKeys  = $blog->seo_keywords ?: 'startup clinic blog, business consulting, growth, branding, entrepreneurship, Zambia';

    $img = $blog->featured_image 
        ? asset('storage/'.$blog->featured_image)
        : asset('assets/img/og/startup-clinic.jpg');

    $canonical = url()->current();
@endphp

@section('meta_title', $seoTitle)
@section('meta_description', $seoDesc)
@section('meta_keywords', $seoKeys)

@section('og_title', $seoTitle)
@section('og_description', $seoDesc)
@section('og_image', $img)
@section('og_type', 'article')

@section('canonical', $canonical)



@push('structured_data')
@php
    $jsonBlog = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $blog->title,
        'image' => [$img],
        'articleSection' => $blog->category->name ?? 'General',
        'description' => $seoDesc,
        'datePublished' => optional($blog->published_at)->toIso8601String(),
        'dateModified'  => optional($blog->updated_at)->toIso8601String(),
        'author' => [
            '@type' => 'Person',
            'name' => $blog->author->name ?? 'Startup Clinic Team'
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Startup Clinic Zambia',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('assets/img/logo.svg'),
            ],
        ],
        'mainEntityOfPage' => $canonical,
    ];

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
                'name'=>'Blog',
                'item'=>route('blog.index')
            ],
            [
                '@type'=>'ListItem',
                'position'=>3,
                'name'=>$blog->title,
                'item'=>$canonical
            ],
        ],
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($jsonBlog, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
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
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li><a href="{{ route('blog.show', $blog->slug) }}">Publication</a></li>
            </ul>

            <h2>
                {{ $blog->title }}
            </h2>

        </div>
    </div>
</div>
<!-- banner end -->


<!-- publication -->
<section id="blog">
    <div class="container mil-p-120-90">
        <div class="row justify-content-center">

            <div class="col-lg-12">

                <div class="mil-image-frame mil-horizontal mil-up">
                    <img src="{{ asset('storage/' . $blog->featured_image) }}"
                         alt="{{ $blog->title }}"
                         class="mil-scale"
                         data-value-1=".90"
                         data-value-2="1.15">
                </div>

                <div class="mil-info mil-up mil-mb-90">
                    <div>
                        Category: &nbsp;
                        <span class="mil-dark">{{ $blog->category->name ?? 'General' }}</span>
                    </div>

                    <div>
                        Date: &nbsp;
                        <span class="mil-dark">{{ $blog->published_at->format('F Y') }}</span>
                    </div>

                    <div>
                        Author: &nbsp;
                        <span class="mil-dark">{{ $blog->author->name ?? 'Admin' }}</span>
                    </div>
                </div>

            </div>

            <div class="col-lg-8">

                {!! $blog->body !!}

            </div>

        </div>
    </div>
</section>
<!-- publication end -->


<!-- similar -->
<section class="mil-soft-bg">
    <div class="container mil-p-120-60">

        <div class="row align-items-center mil-mb-30">
            <div class="col-lg-6 mil-mb-30">
                <h3 class="mil-up">Similar Publications:</h3>
            </div>
            <div class="col-lg-6 mil-mb-30">
                <div class="mil-adaptive-right mil-up">
                    <a href="{{ route('blog.index') }}" class="mil-link mil-dark mil-arrow-place">
                        <span>View all</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">

            @forelse($similar as $item)
                <div class="col-lg-6">

                    <a href="{{ route('blog.show', $item->slug) }}" class="mil-blog-card mil-mb-60">

                        <div class="mil-cover-frame mil-up">
                            <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}">
                        </div>

                        <div class="mil-post-descr">
                            <div class="mil-labels mil-up mil-mb-30">
                                <div class="mil-label mil-upper mil-accent">{{ $item->category->name }}</div>
                                <div class="mil-label mil-upper">{{ $item->published_at->format('M d Y') }}</div>
                            </div>

                            <h4 class="mil-up mil-mb-30">{{ $item->title }}</h4>

                            <p class="mil-post-text mil-up mil-mb-30">
                                {{ Str::words($item->excerpt, 30, '...') }}
                            </p>

                            <div class="mil-link mil-dark mil-arrow-place mil-up">
                                <span>Read more</span>
                            </div>
                        </div>

                    </a>

                </div>
            @empty
                <p class="mil-center mil-up">No similar posts available.</p>
            @endforelse

        </div>

    </div>
</section>
<!-- similar end -->

@endsection
