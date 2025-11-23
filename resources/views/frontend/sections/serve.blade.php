<!-- who we serve -->
<section class="mil-dark-bg">
    <div class="mi-invert-fix">

        <div class="container mil-p-120-120">

            <div class="mil-center">
                <h2 class="mil-muted mil-up mil-mb-30">
                    Who <span class="mil-thin">We Serve</span>
                </h2>
                <p class="mil-light-soft mil-up mil-mb-120">
                    We support founders, startups, SMEs and organizations building structured and scalable businesses.
                </p>
            </div>

            @if($whoWeServe->count() > 0)

                @foreach($whoWeServe as $item)

                    <!-- The card remains EXACTLY as the template -->
                    <a href="{{ route('who-we-serve.show', $item->slug) }}" 
                       class="mil-price-card mil-choose mil-accent-cursor mil-up mil-mb-60">

                        <div class="row align-items-center">

                            <div class="col-lg-4">
                                <h5 class="mil-muted mil-mb-30">
                                    {{ $item->name }}
                                </h5>
                            </div>

                            <div class="col-lg-4">
                                <p class="mil-light-soft mil-mb-30">
                                    {{ Str::words(strip_tags($item->description), 18, '...') }}
                                </p>
                            </div>

                            <div class="col-lg-2">
                                <div class="mil-adaptive-right mil-mb-30">
                                    <!-- arrow stays the same (NOT wrapped in a link) -->
                                    <div class="mil-button mil-icon-button-sm mil-arrow-place"></div>
                                </div>
                            </div>

                        </div>

                    </a>

                @endforeach

            @else

                <div class="mil-center mil-up mil-mb-120">
                    <h4 class="mil-muted">Coming Soon</h4>
                    <p class="mil-light-soft">Our audience categories will appear here soon.</p>
                </div>

            @endif

            <div class="mil-center">
                <a href="{{ route('contact.index') }}" class="mil-button mil-arrow-place">
                    <span>Get Started</span>
                </a>
            </div>

        </div>
    </div>
</section>
<!-- who we serve end -->
