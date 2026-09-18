<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $blogs = Blog::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('screens.admin.blogs.index', compact('blogs', 'search'));
    }

    public function create(): View
    {
        $blog = new Blog(['status' => true, 'published_at' => now()]);

        return view('screens.admin.blogs.create', compact('blog'));
    }

    public function store(StoreBlogRequest $request): RedirectResponse
    {
        $data = $this->prepareData($request);
        $blog = new Blog($data);

        if ($request->hasFile('image')) {
            $blog->image = $request->file('image')->store('blogs', 'public');
        }

        $blog->save();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog): View
    {
        return view('screens.admin.blogs.edit', compact('blog'));
    }

    public function update(UpdateBlogRequest $request, Blog $blog): RedirectResponse
    {
        $blog->fill($this->prepareData($request));

        if ($request->hasFile('image')) {
            $blog->deleteStoredImage();
            $blog->image = $request->file('image')->store('blogs', 'public');
        }

        $blog->save();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    private function prepareData(StoreBlogRequest|UpdateBlogRequest $request): array
    {
        $data = $request->safe()->except('image');
        $data['status'] = $request->boolean('status');

        if (! empty($data['slug'])) {
            $data['slug'] = Str::slug($data['slug']);
        } else {
            unset($data['slug']);
        }

        if (empty($data['published_at'])) {
            $data['published_at'] = $data['status'] ? now() : null;
        }

        return $data;
    }
}
