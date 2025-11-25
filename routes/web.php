<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
// Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\WhoWeServeController;
use App\Http\Controllers\Frontend\TeamController;
use App\Http\Controllers\Frontend\TestimonialController;
use App\Http\Controllers\Frontend\ClientController;
use App\Http\Controllers\Frontend\NewsletterController;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Page;
use App\Models\Service;
use App\Models\SubService;
use App\Models\Project;
use App\Models\Blog;
use App\Models\WhoWeServe;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| All Startup Clinic frontend routes
|--------------------------------------------------------------------------
*/

// HOME PAGE
Route::get('/', [HomeController::class, 'index'])->name('home');


// CMS PAGES (dynamic pages created in Filament)
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');


// SERVICES
Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/{slug}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('/{serviceSlug}/{subSlug}', [ServiceController::class, 'subService'])->name('services.sub');
});


// PROJECTS
Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/{slug}', [ProjectController::class, 'show'])->name('projects.show');
});


// BLOG
Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('blog.show');
});


// ABOUT PAGE
Route::get('/about', [AboutController::class, 'index'])->name('about.index');


// WHO WE SERVE
Route::get('/who-we-serve', [WhoWeServeController::class, 'index'])
    ->name('who-we-serve.index');

Route::get('/who-we-serve/{slug}', [WhoWeServeController::class, 'show'])
    ->name('who-we-serve.show');

// TEAM
Route::get('/team', [TeamController::class, 'index'])->name('team.index');


// TESTIMONIALS
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');


// CLIENTS
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');


// CONTACT
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');

Route::get('/sitemap.xml', function () {

    try {

        $base = rtrim(env('APP_URL'), '/'); // always correct for live domain

        $sitemap = Sitemap::create();

        // -------------------------
        // STATIC PAGES
        // -------------------------
        $staticPages = [
            '/',
            '/about',
            '/services',
            '/projects',
            '/blog',
            '/contact',
            '/who-we-serve',
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(
                Url::create($base . $page)
            );
        }

        // -------------------------
        // SERVICES + SUBSERVICES
        // -------------------------
        foreach (Service::with('subServices')->get() as $service) {

            $sitemap->add(
                Url::create("$base/services/{$service->slug}")
            );

            foreach ($service->subServices as $sub) {
                $sitemap->add(
                    Url::create("$base/services/{$service->slug}/{$sub->slug}")
                );
            }
        }

        // -------------------------
        // PROJECTS
        // -------------------------
        foreach (Project::all() as $project) {
            $sitemap->add(
                Url::create("$base/projects/{$project->slug}")
            );
        }

        // -------------------------
        // BLOG POSTS
        // -------------------------
        foreach (Blog::all() as $blog) {
            $sitemap->add(
                Url::create("$base/blog/{$blog->slug}")
            );
        }

        // -------------------------
        // WHO WE SERVE
        // -------------------------
        foreach (WhoWeServe::all() as $item) {
            $sitemap->add(
                Url::create("$base/who-we-serve/{$item->slug}")
            );
        }

        // -------------------------
        // WRITE FILE
        // -------------------------
        $path = public_path('sitemap.xml');
        $sitemap->writeToFile($path);

        return response()->file($path);

    } catch (\Exception $e) {

        // Log for debugging
        Log::error('Sitemap generation error: ' . $e->getMessage());

        return response("Sitemap generation failed: " . $e->getMessage(), 500);
    }
});

Route::get('/sitemap-refresh', function () {

    try {

        $base = rtrim(config('app.url'), '/');

        $sitemap = Sitemap::create();

        // STATIC PAGES
        $staticPages = [
            '/',
            '/about',
            '/services',
            '/projects',
            '/blog',
            '/contact',
            '/who-we-serve',
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(Url::create($base . $page));
        }

        // SERVICES + SUBSERVICES
        foreach (Service::with('subServices')->get() as $service) {
            $sitemap->add(Url::create("$base/services/{$service->slug}"));
            foreach ($service->subServices as $sub) {
                $sitemap->add(Url::create("$base/services/{$service->slug}/{$sub->slug}"));
            }
        }

        // PROJECTS
        foreach (Project::all() as $project) {
            $sitemap->add(Url::create("$base/projects/{$project->slug}"));
        }

        // BLOG POSTS
        foreach (Blog::all() as $blog) {
            $sitemap->add(Url::create("$base/blog/{$blog->slug}"));
        }

        // WHO WE SERVE
        foreach (WhoWeServe::all() as $item) {
            $sitemap->add(Url::create("$base/who-we-serve/{$item->slug}"));
        }

        // Write to storage temporarily
        $tempPath = storage_path('app/sitemap-temp.xml');
        $sitemap->writeToFile($tempPath);

        // Move to public/sitemap.xml
        copy($tempPath, public_path('sitemap.xml'));

        return "Sitemap regenerated successfully.";

    } catch (\Throwable $e) {

        return response(
            "ERROR generating sitemap:<br>" .
            $e->getMessage() . "<br><br>" .
            nl2br($e->getTraceAsString()),
            500
        );
    }
});


Route::get('/debug-sitemap', function () {

    try {

        $base = rtrim(env('APP_URL'), '/');

        // TEST database models
        return [
            'app_url' => $base,
            'services_count' => \App\Models\Service::count(),
            'projects_count' => \App\Models\Project::count(),
            'blogs_count' => \App\Models\Blog::count(),
            'who_we_serve_count' => \App\Models\WhoWeServe::count(),
        ];

    } catch (\Exception $e) {

        return response("DEBUG ERROR: " . $e->getMessage(), 500);
    }
});
