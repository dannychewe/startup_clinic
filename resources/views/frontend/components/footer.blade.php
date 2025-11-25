<!-- footer -->
<footer class="mil-dark-bg">
    <div class="mi-invert-fix">
        <div class="container mil-p-120-60">
            <div class="row justify-content-between">
                <div class="col-md-4 col-lg-4 mil-mb-60">

                    <div class="mil-muted mil-logo mil-up mil-mb-30">
                        <a href="{{ route('home') }}" class="mil-logo">
                            <img src="{{ asset('assets/img/footer-logo.svg') }}" alt="Startup Clinic Logo">
                        </a>
                    </div>

                    <p class="mil-light-soft mil-up mil-mb-30">Subscribe our newsletter:</p>

                    <form 
                        method="POST" 
                        action="{{ route('newsletter.subscribe') }}" 
                        class="mil-subscribe-form mil-up"
                    >
                        @csrf

                        <!-- Honeypot field (spam protection) -->
                        <input type="text" name="bot_field" style="display:none">

                        <input 
                            type="email" 
                            name="email" 
                            placeholder="Enter your email"
                            required
                        >

                        <button type="submit" class="mil-button mil-icon-button-sm mil-arrow-place"></button>
                    </form>

                    @if(session('success'))
                        <p class="text-success mt-2">{{ session('success') }}</p>
                    @endif

                    @error('email')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror


                </div>
                <div class="col-md-7 col-lg-6">
                    <div class="row justify-content-end">
                        <div class="col-md-6 col-lg-7">

                            <nav class="mil-footer-menu mil-mb-60">
                                <ul>
                                    <li class="mil-up mil-active">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="mil-up">
                                        <a href="{{ route('projects.index') }}">Portfolio</a>
                                    </li>
                                    <li class="mil-up">
                                        <a href="{{ route('services.index') }}">Services</a>
                                    </li>
                                    <li class="mil-up">
                                        <a href="{{ route('contact.index') }}">Contact</a>
                                    </li>
                                    <li class="mil-up">
                                        <a href="{{ route('blog.index') }}">Blog</a>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                       <div class="col-md-6 col-lg-5">
                            <ul class="mil-menu-list mil-up mil-mb-60">

                                @foreach($services as $service)
                                    <li>
                                        <a href="{{ route('services.show', $service->slug) }}" class="mil-light-soft">
                                            {{ $service->name }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>


                    </div>
                </div>
            </div>

            <div class="row justify-content-between flex-sm-row-reverse">
                <div class="col-md-7 col-lg-6">

                    <div class="row justify-content-between">

                    @php
                        $contactItems = $footerItems['contact'] ?? collect([]);

                        $location = $contactItems->firstWhere('label', 'location_name')->value
                            ?? 'Zambia';

                        $address = $contactItems->firstWhere('label', 'address')->value
                            ?? 'Address not set';

                        $phone = $contactItems->firstWhere('label', 'phone')->value
                            ?? '';

                        $email = $contactItems->firstWhere('label', 'email')->value
                            ?? ''; 
                    @endphp

                    <div class="col-md-6 col-lg-5 mil-mb-60">
                        <h6 class="mil-muted mil-up mil-mb-30">{{ $location }}</h6>

                        <p class="mil-light-soft mil-up">
                            {{ $address }}

                            @if($phone)
                                <br>
                                <span class="mil-no-wrap">{{ $phone }}</span>
                            @endif

                            @if($email)
                                <br>
                                <a href="mailto:{{ $email }}" class="mil-light-soft">
                                    {{ $email }}
                                </a>
                            @endif
                        </p>
                    </div>

                </div>



                </div>
                <div class="col-md-4 col-lg-6 mil-mb-60">

                    <div class="mil-vert-between">
                        <div class="mil-mb-30">
                            <ul class="mil-social-icons mil-up">

                                {{-- LinkedIn --}}
                                @if(isset($footerItems['social']))
                                    @php
                                        $linkedin = $footerItems['social']->firstWhere('label', 'linkedin');
                                        $facebook = $footerItems['social']->firstWhere('label', 'facebook');
                                        $instagram = $footerItems['social']->firstWhere('label', 'instagram');
                                    @endphp

                                    @if($linkedin)
                                        <li>
                                            <a href="{{ $linkedin->url }}" 
                                            target="_blank" 
                                            rel="noopener" data-no-swup
                                            class="social-icon">
                                                <i class="fab fa-linkedin"></i>
                                            </a>

                                        </li>
                                    @endif

                                    @if($facebook)
                                        <li>
                                            <a href="{{ $facebook->url }}" target="_blank" rel="noopener" data-no-swup  class="social-icon">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if($instagram)
                                        <li>
                                            <a href="{{ $instagram->url }}" target="_blank" rel="noopener" data-no-swup  class="social-icon">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                    @endif
                                @endif

                            </ul>

                        </div>
                        <p class="mil-light-soft mil-up">
                            © {{ date('Y') }} - Startup Clinic. All Rights Reserved.
                        </p>

                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->