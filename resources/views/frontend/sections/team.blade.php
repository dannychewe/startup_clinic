<!-- team -->
<section>
    <div class="container mil-p-120-30">
        <div class="row justify-content-between align-items-center">

            <!-- LEFT TEXT -->
            <div class="col-lg-5 col-xl-4">

                <div class="mil-mb-90">
                    <h2 class="mil-up mil-mb-60">Meet <br>Our Team</h2>

                    <p class="mil-up mil-mb-30">
                        We are a team of passionate individuals dedicated to building strong brands,
                        digital systems, and growth strategies for startups and businesses.
                    </p>

                    <p class="mil-up mil-mb-60">
                        Together, we deliver exceptional work that exceeds expectations.
                    </p>

                    <div class="mil-up">
                        <a href="{{ route('team.index') }}" class="mil-button mil-arrow-place mil-mb-60">
                            <span>Read more</span>
                        </a>
                    </div>

                    <h4 class="mil-up">
                        <span class="mil-thin">We</span> deliver <br>
                        <span class="mil-thin">exceptional</span> results.
                    </h4>
                </div>

            </div>

            <!-- RIGHT TEAM GRID -->
            <div class="col-lg-6">

                <div class="mil-team-list">
                    <div class="mil-lines-place"></div>

                    @if($teamMembers->count() > 0)

                        <div class="row mil-mb-60">

                            @foreach($teamMembers as $member)

                                @php
                                    $photo = $member->photo
                                        ? asset('storage/' . $member->photo)
                                        : asset('assets/img/faces/default.jpg');
                                @endphp

                                <div class="col-sm-6">

                                    <div class="mil-team-card mil-up mil-mb-30">
                                        <img src="{{ $photo }}" alt="{{ $member->name }}">
                                        <div class="mil-description">
                                            <div class="mil-secrc-text">

                                                <h5 class="mil-muted mil-mb-5">
                                                    <a href="#">
                                                        {{ $member->name }}
                                                    </a>
                                                </h5>

                                                <p class="mil-link mil-light-soft mil-mb-10">
                                                    {{ $member->title }}
                                                </p>

                                                <ul class="mil-social-icons mil-center">

                                                    @if($member->linkedin)
                                                    <li>
                                                        <a href="{{ $member->linkedin }}" target="_blank" class="social-icon">
                                                            <i class="fab fa-linkedin"></i>
                                                        </a>
                                                    </li>
                                                    @endif

                                                    @if($member->email)
                                                    <li>
                                                        <a href="mailto:{{ $member->email }}" target="_blank" class="social-icon">
                                                            <i class="fas fa-envelope"></i>
                                                        </a>
                                                    </li>
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <!-- Fallback Message -->
                        <div class="text-center mil-up py-5">
                            <h5 class="mil-muted">Our team is growing!</h5>
                            <p class="mil-light-soft">
                                We’re onboarding new team members. This section will be updated soon.
                            </p>
                        </div>

                    @endif

                </div>

            </div>

        </div>
    </div>
</section>
<!-- team end -->
