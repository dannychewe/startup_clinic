@php
  $orgDescription = trim($__env->yieldContent('meta_description')) ?: 
    'Startup Clinic Zambia helps founders, SMEs, and organisations diagnose business gaps, build stronger systems, and grow sustainably with consulting, branding, web development, software, and digital marketing.';

  $orgJson = [
    '@context' => 'https://schema.org',
    // multiple types to reflect everything you do
    '@type' => [
        'Organization',
        'LocalBusiness',
        'ProfessionalService',
        'ConsultingFirm',
        'MarketingAgency',
        'ITConsulting',
        'WebDevelopment',
        'BusinessService',
    ],
    'name' => 'Startup Clinic Zambia Limited',
    'alternateName' => 'Startup Clinic',
    'url' => url('/'),
    'logo' => asset('assets/img/logo.svg'),
    'description' => $orgDescription,

    'slogan' => 'We Diagnose. We Build. You Grow.',

    'address' => [
        '@type' => 'PostalAddress',
        // You can refine these if you want (city / street)
        'addressCountry' => 'ZM',
        'addressRegion' => 'Zambia',
    ],

    'telephone' => '+260972991664',
    'email' => 'info@startupclinic.co.zm',

    'areaServed' => [
        'Zambia',
        'Southern Africa',
        'Africa',
    ],

    'sameAs' => array_values(array_filter([
        trim($__env->yieldContent('org_linkedin')),   // set on layout or page when ready
        // more can be added later: facebook, instagram, x, youtube
    ])),

    'contactPoint' => [[
        '@type' => 'ContactPoint',
        'contactType' => 'Customer Support',
        'telephone' => '+260972991664',
        'email' => 'info@startupclinic.co.zm',
        'areaServed' => 'ZM',
        'availableLanguage' => ['English'],
    ]],
  ];

  // Website + searchbox (nice for Google sitelinks)
  $websiteJson = [
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => 'Startup Clinic Zambia',
    'url'  => url('/'),
    'potentialAction' => [
      '@type' => 'SearchAction',
      'target' => url('/blog').'?q={search_term_string}',
      'query-input' => 'required name=search_term_string',
    ],
  ];
@endphp

<script type="application/ld+json">
{!! json_encode($orgJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($websiteJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

@stack('structured_data')
