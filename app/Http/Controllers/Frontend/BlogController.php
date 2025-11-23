<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $query = Blog::with('category', 'author')
            ->where('status', 'published');

        // Apply category filter if provided
        if (request('category')) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', request('category'));
            });
        }

        $blogs = $query->orderBy('published_at', 'desc')
                    ->paginate(10)
                    ->withQueryString();  // IMPORTANT: keeps ?category= in pagination links

        return view('frontend.pages.blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::with('category', 'author')->where('slug', $slug)->firstOrFail();

        // Fetch 2 similar posts (same category, excluding itself)
        $similar = Blog::where('category_id', $blog->category_id)
                        ->where('id', '!=', $blog->id)
                        ->where('status', 'published')
                        ->orderBy('published_at', 'desc')
                        ->take(2)
                        ->get();

        return view('frontend.pages.blog.show', compact('blog', 'similar'));
    }

}
