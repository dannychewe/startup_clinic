<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Client;
use App\Models\WhoWeServe;
use App\Models\About;
use App\Models\HeroSection;
use App\Models\Blog;
use App\Models\TeamMember;

class HomeController extends Controller
{
    public function index()
    {
        // CMS Home Page (Page + PageSections)
        // $page = Page::where('slug', 'home')->firstOrFail();
        // $sections = $page->sections()->orderBy('order')->get();

        // Dynamic content for Home
        $hero = HeroSection::first();  
        $about = About::first(); 
        $blogs = Blog::limit(2)->where('status', 'published')->orderBy('published_at', 'desc')->get();
       
        $services = Service::limit(6)->get();
        $testimonials = Testimonial::limit(6)->get();
        $teamMembers = TeamMember::orderBy('order')->get();

        $clients = Client::orderBy('name')->get();
        $whoWeServe = WhoWeServe::orderBy('order')->get();

        return view('frontend.home', compact(
            // 'page',
            // 'sections',
            'hero',
            'about',
            'blogs',
            'services',
            'testimonials',
            'teamMembers',
            'clients',
            'whoWeServe'
        ));
    }
}
