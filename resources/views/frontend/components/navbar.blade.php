<!-- menu -->
<div class="mil-menu-frame">
    <div class="mil-frame-top">
        <a href="{{ route('home') }}" class="mil-logo">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="Startup Clinic Logo">
        </a>

        <div class="mil-menu-btn">
            <span></span>
        </div>
    </div>

    <div class="container">
        <div class="mil-menu-content">
            <div class="row">
                <div class="col-xl-5">

                    <nav class="mil-main-menu" id="swupMenu">
                        <ul>

                            {{-- HOME --}}
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>

                            {{-- ABOUT US --}}
                            <li>
                                <a href="{{ route('about.index') }}">About Us</a>
                            </li>

                            {{-- SERVICES --}}
                            <li>
                                <a href="{{ route('services.index') }}">Services</a>
                                
                            </li>

                            {{-- WHO WE SERVE --}}
                            <li>
                                <a href="{{ route('who-we-serve.index') }}">Who We Serve</a>
                            </li>

                            {{-- PROJECTS --}}
                            <li>
                                <a href="{{ route('projects.index') }}">Projects</a>
                            </li>

                            {{-- BLOG --}}
                            <li>
                                <a href="{{ route('blog.index') }}">Blog</a>
                            </li>

                            <!-- {{-- TEAM --}}
                            <li>
                                <a href="{{ route('team.index') }}">Team</a>
                            </li>

                            {{-- TESTIMONIALS --}}
                            <li>
                                <a href="{{ route('testimonials.index') }}">Testimonials</a>
                            </li> -->

                            {{-- CONTACT --}}
                            <li>
                                <a href="{{ route('contact.index') }}">Contact</a>
                            </li>
                        </ul>
                    </nav>

                </div>
                <div class="col-xl-7">

                    <!-- Right side of menu (optional) -->
                    <div class="mil-menu-right-frame">
                        <div class="mil-menu-right">

                            <div class="row">
                                <div class="col-lg-8 mil-mb-60">
                                    <h6 class="mil-muted mil-mb-30">Featured Projects</h6>
                                    <ul class="mil-menu-list">
                                        @foreach($projects ?? [] as $project)
                                            <li>
                                                <a href="{{ route('projects.show', $project->slug) }}" class="mil-light-soft">
                                                    {{ $project->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-lg-4 mil-mb-60">
                                    <h6 class="mil-muted mil-mb-30">Quick Links</h6>
                                    <ul class="mil-menu-list">
                                        <li><a href="{{ route('clients.index') }}" class="mil-light-soft">Clients</a></li>
                                        <li><a href="{{ route('contact.index') }}" class="mil-light-soft">Contact</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mil-divider mil-mb-60"></div>

                            <!-- optional physiscal address block -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
