@php
function split_after_words($text, $count = 3) {
    $words = explode(' ', $text);
    if (count($words) <= $count) return $text;
    return implode(' ', array_slice($words, 0, $count))
         . '<br>'
         . implode(' ', array_slice($words, $count));
}
@endphp



<!-- banner -->
<section class="mil-banner mil-dark-bg">
    <div class="mi-invert-fix">
        
        <!-- animations -->
        <div class="mil-animation-frame">
            <div class="mil-animation mil-position-1 mil-scale" data-value-1="7" data-value-2="1.6"></div>
            <div class="mil-animation mil-position-2 mil-scale" data-value-1="4" data-value-2="1"></div>
            <div class="mil-animation mil-position-3 mil-scale" data-value-1="1.2" data-value-2=".1"></div>
        </div>

        <div class="mil-gradient"></div>

        <div class="container">
            <div class="mil-banner-content mil-up">

                <!-- Dynamic Heading -->
                <h1 class="mil-muted mil-mb-60">
                    {!! split_after_words($hero->title ?? 'Welcome to Startup Clinic') !!}
                </h1>


                <!-- Dynamic Subtitle -->
                <div class="row">
                    <div class="col-md-7 col-lg-5">
                        <p class="mil-light-soft mil-mb-60">
                            {!! $hero->subtitle ?? 'We diagnose, build, and help your business grow.' !!}
                        </p>
                    </div>
                </div>

                <!-- Buttons using route() -->
                <a href="{{ route('services.index') }}" class="mil-button mil-arrow-place mil-btn-space">
                    <span>What We Do</span>
                </a>

                <a href="{{ route('projects.index') }}" class="mil-link mil-muted mil-arrow-place">
                    <span>View Projects</span>
                </a>

                <!-- Circle Scroll Down -->
                <div class="mil-circle-text">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300" class="mil-ct-svg mil-rotate" data-value="360">
                        <defs>
                            <path id="circlePath" d="M 150, 150 m -60, 0 a 60,60 0 0,1 120,0 a 60,60 0 0,1 -120,0 " />
                        </defs>
                        <g>
                            <use xlink:href="#circlePath" fill="none" />
                            <text style="letter-spacing: 6.5px">
                                <textPath xlink:href="#circlePath">Scroll down - Scroll down - </textPath>
                            </text>
                        </g>
                    </svg>
                    <a href="#about" class="mil-button mil-arrow-place mil-icon-button mil-arrow-down"></a>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- banner end -->
