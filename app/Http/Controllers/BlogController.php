<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::query()
            ->published()
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(9);

        return view('pages.blogs.index', compact('blogs'));
    }

    public function show(Blog $blog): View
    {
        abort_unless($blog->status, 404);

        if ($blog->published_at && $blog->published_at->isFuture()) {
            abort(404);
        }

        $related = Blog::query()
            ->published()
            ->where('id', '!=', $blog->id)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('pages.blogs.show', compact('blog', 'related'));
    }
}
