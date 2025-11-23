<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first(); // assuming single record

        return view('frontend.pages.about.index', compact('about'));
    }
}
