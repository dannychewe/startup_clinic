<!-- reviews -->
<section class="mil-soft-bg">
    <div class="container mil-p-120-120">

        <!-- Section intro text -->
        <div class="row">
            <div class="col-lg-10">
                <span class="mil-suptitle mil-suptitle-right mil-suptitle-dark mil-up">
                    Customer reviews are a valuable source of information for both businesses and consumers.
                </span>
            </div>
        </div>

        <h2 class="mil-center mil-up mil-mb-60">
            Customer <span class="mil-thin">Voices:</span> <br>
            Hear What <span class="mil-thin">They Say!</span>
        </h2>

        <div class="mil-revi-pagination mil-up mil-mb-60"></div>

        <div class="row mil-relative justify-content-center">
            <div class="col-lg-8">

                <!-- prev/next nav -->
                <div class="mil-slider-nav mil-soft mil-reviews-nav mil-up">
                    <div class="mil-slider-arrow mil-prev mil-revi-prev mil-arrow-place"></div>
                    <div class="mil-slider-arrow mil-revi-next mil-arrow-place"></div>
                </div>

                <!-- quote icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="mil-quote-icon mil-up">
                    <path d="M 13.5 10 A 8.5 8.5 0 0 0 13.5 27 A 8.5 8.5 0 0 0 18.291016 25.519531 C 17.422273 29.222843 15.877848 31.803343 14.357422 33.589844 C 12.068414 36.279429 9.9433594 37.107422 9.9433594 37.107422 A 1.50015 1.50015 0 1 0 11.056641 39.892578 C 11.056641 39.892578 13.931586 38.720571 16.642578 35.535156 C 19.35357 32.349741 22 27.072581 22 19 A 1.50015 1.50015 0 0 0 21.984375 18.78125 A 8.5 8.5 0 0 0 13.5 10 z M 34.5 10 A 8.5 8.5 0 0 0 34.5 27 A 8.5 8.5 0 0 0 39.291016 25.519531 C 38.422273 29.222843 36.877848 31.803343 35.357422 33.589844 C 33.068414 36.279429 30.943359 37.107422 30.943359 37.107422 A 1.50015 1.50015 0 1 0 32.056641 39.892578 C 32.056641 39.892578 34.931586 38.720571 37.642578 35.535156 C 40.35357 32.349741 43 27.072581 43 19 A 1.50015 1.50015 0 0 0 42.984375 18.78125 A 8.5 8.5 0 0 0 34.5 10 z"></path>
                </svg>

                <!-- slider -->
                <div class="swiper-container mil-reviews-slider">
                    <div class="swiper-wrapper">

                        @if($testimonials->count() > 0)

                            @foreach($testimonials as $review)

                                @php
                                    $photo = $review->photo 
                                        ? asset('storage/' . $review->photo)
                                        : asset('assets/img/faces/default.jpg');
                                @endphp

                                <div class="swiper-slide">
                                    <div class="mil-review-frame mil-center"
                                         data-swiper-parallax="-200"
                                         data-swiper-parallax-opacity="0">

                                        <div class="mil-up mil-mb-20">
                                            <img src="{{ $photo }}" alt="{{ $review->author_name }}" 
                                                 style="width:70px;height:70px;border-radius:50%;object-fit:cover;">
                                        </div>

                                        <h5 class="mil-up mil-mb-10">{{ $review->author_name }}</h5>

                                        <p class="mil-mb-5 mil-upper mil-up mil-mb-30">
                                            {{ $review->author_role }}
                                            @if($review->company)
                                                — {{ $review->company }}
                                            @endif
                                        </p>

                                        <p class="mil-text-xl mil-up">
                                            {{ $review->message }}
                                        </p>

                                    </div>
                                </div>

                            @endforeach

                        @else

                            <!-- fallback -->
                            <div class="swiper-slide">
                                <div class="mil-review-frame mil-center">
                                    <h5 class="mil-up mil-mb-10">No Reviews Yet</h5>
                                    <p class="mil-text-xl mil-up">
                                        We are currently collecting feedback from our clients.  
                                        New testimonials will appear here soon!
                                    </p>
                                </div>
                            </div>

                        @endif

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
<!-- reviews end -->
