<!-- about -->
<section id="about">
    <div class="container mil-p-120-30">
        <div class="row justify-content-between align-items-center">

            <!-- LEFT CONTENT -->
            <div class="col-lg-6 col-xl-5">
                <div class="mil-mb-90">

                    <h2 class="mil-up mil-mb-60">
                        About <span class="mil-thin">Startup Clinic</span>
                    </h2>

                    <p class="mil-up mil-mb-30 mil-dark">
                        {!! $about->story ?? 'We help founders turn ideas into structured, scalable businesses through strategic consulting, branding, and technology.' !!}
                    </p>

                    <p class="mil-up mil-mb-60 mil-dark">
                        {!! $about->philosophy ?? 'Our approach blends deep understanding, practical execution, and long-term partnership to deliver measurable growth.' !!}
                    </p>

                    <!-- <div class="mil-about-quote">
                        <div class="mil-avatar mil-up">
                            <img src="{{ asset('assets/img/faces/founder.jpg') }}" alt="Founder">
                        </div>
                        <h6 class="mil-quote mil-up">
                            {!! $about->founder_message ?? 'Empowering African entrepreneurs to build strong, scalable, and future-ready businesses.' !!}
                        </h6>
                    </div> -->

                </div>
            </div>

            <!-- RIGHT DYNAMIC IMAGE -->
            <div class="col-lg-5">

                <div class="mil-about-photo mil-mb-90">
                    <div class="mil-lines-place"></div>

                    <div class="mil-up mil-img-frame" style="padding-bottom: 160%;">

                        @php
                            $aboutImage = $about->featured_image
                                ? asset('storage/'.$about->featured_image)
                                : asset('assets/img/photo/about.jpg');
                        @endphp

                        <img src="{{ $aboutImage }}"
                             alt="About Startup Clinic"
                             class="mil-scale"
                             data-value-1="1"
                             data-value-2="1.2">
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<!-- about end -->
