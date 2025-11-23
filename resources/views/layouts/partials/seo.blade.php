@php
  // ===========================
  // Default SEO values — Startup Clinic
  // ===========================

  $title = $title ?? (trim($__env->yieldContent('meta_title'))
        ?: 'Startup Clinic Zambia | Business, Startup & Digital Growth Consulting');

  $description = $description ?? (trim($__env->yieldContent('meta_description'))
        ?: 'Startup Clinic helps founders, SMEs, and organisations in Zambia diagnose business gaps, build better systems, and grow through consulting, branding, websites, software development, and digital marketing.');

  $keywords = $keywords ?? (trim($__env->yieldContent('meta_keywords'))
        ?: 'Startup Clinic, startup consulting Zambia, business consulting Zambia, digital agency Zambia, branding, website design, web development, software development, marketing strategy, SME growth Zambia');

  $author = $author ?? (trim($__env->yieldContent('meta_author'))
        ?: 'Startup Clinic Zambia Limited');

  $type = $type ?? (trim($__env->yieldContent('og_type')) ?: 'website');

  $image = $image ?? (trim($__env->yieldContent('og_image'))
        ?: asset('assets/img/og/startup-clinic.jpg'));

  // Canonical: keep ?page for paginated pages, otherwise current URL
  $canonical = $canonical ?? (trim($__env->yieldContent('canonical'))
        ?: (request()->has('page')
              ? url()->current().'?page='.request('page')
              : url()->current()));

  $twitterCard = $twitterCard ?? 'summary_large_image';
  $siteName    = $siteName    ?? 'Startup Clinic Zambia';
  $locale      = $locale      ?? 'en_ZM';

  // Robots: block local / staging, allow production
  $robots = $robots ?? (app()->environment(['local', 'development', 'staging'])
        ? 'noindex, nofollow'
        : 'index, follow');

  // Article extras (used by blog / case studies)
  $publishedTime = $publishedTime ?? null;
  $modifiedTime  = $modifiedTime  ?? null;
  $section       = $section       ?? null;
  $tags          = $tags          ?? [];
  $twitterSite   = $twitterSite   ?? null;
  $twitterCreator= $twitterCreator?? null;

@endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $author }}">
<link rel="canonical" href="{{ $canonical }}">

<!-- Open Graph -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="{{ $locale }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- Twitter -->
<meta name="twitter:card" content="{{ $twitterCard }}">
<meta name="twitter:title" content="{{ trim($__env->yieldContent('twitter_title')) ?: $title }}">
<meta name="twitter:description" content="{{ trim($__env->yieldContent('twitter_description')) ?: $description }}">
<meta name="twitter:image" content="{{ $image }}">

@if(!empty($twitterSite))
  <meta name="twitter:site" content="{{ $twitterSite }}">
@endif
@if(!empty($twitterCreator))
  <meta name="twitter:creator" content="{{ $twitterCreator }}">
@endif

<!-- Robots -->
<meta name="robots" content="{{ $robots }}">

<!-- Article meta (for blog posts, if type === article) -->
@if($type === 'article')
  @if(!empty($publishedTime))
    <meta property="article:published_time"
          content="{{ \Illuminate\Support\Carbon::parse($publishedTime)->toIso8601String() }}">
  @endif
  @if(!empty($modifiedTime))
    <meta property="article:modified_time"
          content="{{ \Illuminate\Support\Carbon::parse($modifiedTime)->toIso8601String() }}">
  @endif
  @if(!empty($section))
    <meta property="article:section" content="{{ $section }}">
  @endif
  @foreach($tags as $t)
    <meta property="article:tag" content="{{ $t }}">
  @endforeach
@endif

<!-- Theme / PWA -->
<meta name="theme-color" content="#016E5B">
<meta name="msapplication-TileColor" content="#016E5B">

@stack('meta')
