<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function home()
    {
        $page = Page::where('slug', 'home')->firstOrFail();
        $sections = $page->sections()->orderBy('order')->get();

        return view('pages.home', compact('page', 'sections'));
    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $sections = $page->sections()->orderBy('order')->get();

        return view('pages.page', compact('page', 'sections'));
    }
}
