<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\WhoWeServe;

class WhoWeServeController extends Controller
{
    public function index()
    {
        $items = WhoWeServe::orderBy('order')->get();

        return view('frontend.pages.who-we-serve.index', compact('items'));
    }

    public function show($slug)
    {
        $item = WhoWeServe::where('slug', $slug)->firstOrFail();

        // Load all items for "other categories" section
        $items = WhoWeServe::orderBy('order')->get();

        return view('frontend.pages.who-we-serve.show', compact('item', 'items'));
    }

}
