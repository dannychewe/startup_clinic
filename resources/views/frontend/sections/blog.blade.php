<!-- blog -->
<section>
    <div class="container mil-p-120-60">

        <!-- Header Row -->
        <div class="row align-items-center mil-mb-30">
            <div class="col-lg-6 mil-mb-30">
                <h3 class="mil-up">Popular Publications:</h3>
            </div>
            <div class="col-lg-6 mil-mb-30">
                <div class="mil-adaptive-right mil-up">
                    <a href="{{ route('blog.index') }}" class="mil-link mil-dark mil-arrow-place">
                        <span>View all</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Blog Posts -->
        <div class="row">

            @if($blogs->count() > 0)

                @foreach($blogs as $blog)

                    @php
                        $image = $blog->featured_image
                            ? asset('storage/' . $blog->featured_image)
                            : asset('assets/img/blog/default.jpg');
                    @endphp

                    <div class="col-lg-6">

                        <a href="{{ route('blog.show', $blog->slug) }}" class="mil-blog-card mil-mb-60">

                            <!-- image -->
                            <div class="mil-cover-frame mil-up">
                                <img src="{{ $image }}" alt="cover">
                            </div>

                            <!-- description -->
                            <div class="mil-post-descr">

                                <div class="mil-labels mil-up mil-mb-30">
                                    <div class="mil-label mil-upper mil-accent">
                                        {{ $blog->category->name ?? 'Uncategorized' }}
                                    </div>

                                    <div class="mil-label mil-upper">
                                        {{ $blog->published_at ? $blog->published_at->format('M d Y') : '' }}
                                    </div>
                                </div>

                                <h4 class="mil-up mil-mb-30">
                                    {{ $blog->title }}
                                </h4>

                                <p class="mil-post-text mil-up mil-mb-30">
                                    {{ $blog->excerpt ?? Str::limit(strip_tags($blog->body), 150) }}
                                </p>

                                <div class="mil-link mil-dark mil-arrow-place mil-up">
                                    <span>Read more</span>
                                </div>

                            </div>

                        </a>

                    </div>

                @endforeach

            @else

                <!-- Fallback -->
                <div class="col-12 text-center">
                    <h5 class="mil-muted mil-up">No blog posts yet</h5>
                    <p class="mil-light-soft mil-up">
                        We are preparing helpful content for founders and businesses.  
                        New publications will appear here soon!
                    </p>
                </div>

            @endif

        </div>
    </div>
</section>
<!-- blog end -->
