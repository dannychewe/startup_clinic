<!-- partners -->
<div class="mil-soft-bg">
    <div class="container mil-p-0-120">

        @if($clients->count() > 0)

            <div class="swiper-container mil-infinite-show mil-up">
                <div class="swiper-wrapper">

                    @foreach($clients as $client)

                        @php
                            // Resolve logo path (supports storage upload or fallback)
                            $logo = $client->logo
                                ? asset('storage/' . $client->logo)
                                : asset('assets/img/partners/default.svg');

                            // Optional dynamic width based on industry or name
                            $width = "100px";
                        @endphp

                        <div class="swiper-slide">
                            <a href="{{ $client->website ?: '#.' }}" 
                               class="mil-partner-frame" 
                               style="width: {{ $width }};">
                                <img src="{{ $logo }}" alt="{{ $client->company_name ?? $client->name }}">
                            </a>
                        </div>

                    @endforeach

                </div>
            </div>

        @else

            <!-- Fallback Message -->
            <div class="text-center mil-up py-5">
                <h5 class="mil-muted">
                    Our portfolio is in progress.
                </h5>
                <p class="mil-light-soft">
                    We are currently onboarding new brands — stay tuned for updates!
                </p>
            </div>

        @endif

    </div>
</div>
<!-- partners end -->
