<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContentPageRequest;
use App\Http\Requests\Admin\UpdateContentPageRequest;
use App\Models\ContentPage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContentPageController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $pages = ContentPage::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('screens.admin.content-pages.index', compact('pages', 'search'));
    }

    public function create(): View
    {
        $page = new ContentPage(['type' => 'generic', 'is_published' => true]);

        return view('screens.admin.content-pages.create', compact('page'));
    }

    public function store(StoreContentPageRequest $request): RedirectResponse
    {
        $data = $this->prepareData($request);
        ContentPage::create($data);

        return redirect()
            ->route('admin.content-pages.index')
            ->with('success', 'Content page created successfully.');
    }

    public function edit(ContentPage $contentPage): View
    {
        return view('screens.admin.content-pages.edit', ['page' => $contentPage]);
    }

    public function update(UpdateContentPageRequest $request, ContentPage $contentPage): RedirectResponse
    {
        $contentPage->update($this->prepareData($request));

        return redirect()
            ->route('admin.content-pages.index')
            ->with('success', 'Content page updated successfully.');
    }

    public function destroy(ContentPage $contentPage): RedirectResponse
    {
        $contentPage->delete();

        return redirect()
            ->route('admin.content-pages.index')
            ->with('success', 'Content page deleted successfully.');
    }

    private function prepareData(StoreContentPageRequest|UpdateContentPageRequest $request): array
    {
        $data = $request->safe()->except(['content', 'content_json']);
        $data['is_published'] = $request->boolean('is_published');
        $data['show_in_footer'] = $request->boolean('show_in_footer');

        if ($request->filled('content_json')) {
            $decoded = json_decode($request->input('content_json'), true);
            $data['content'] = is_array($decoded) ? $decoded : [];
        } else {
            $data['content'] = $request->input('content', []);
        }

        if (! empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['slug']);
        } else {
            unset($data['slug']);
        }

        return $data;
    }
}
