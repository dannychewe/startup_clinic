<?php

use Illuminate\Support\Facades\Route;

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
