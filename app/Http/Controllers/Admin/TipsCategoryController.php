<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTipsCategoryRequest;
use App\Http\Requests\Admin\UpdateTipsCategoryRequest;
use App\Models\TipsCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TipsCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $categories = TipsCategory::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('screens.admin.tips-categories.index', compact('categories', 'search'));
    }

    public function create(): View
    {
        $category = new TipsCategory();

        return view('screens.admin.tips-categories.create', compact('category'));
    }

    public function store(StoreTipsCategoryRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('image');

        $category = new TipsCategory($data);

        if ($request->hasFile('image')) {
            $category->image_url = $request->file('image')->store('tips-categories', 'public');
        }

        $category->save();

        return redirect()
            ->route('admin.tips-categories.index')
            ->with('success', 'Tips category created successfully.');
    }

    public function edit(TipsCategory $tipsCategory): View
    {
        return view('screens.admin.tips-categories.edit', ['category' => $tipsCategory]);
    }

    public function update(UpdateTipsCategoryRequest $request, TipsCategory $tipsCategory): RedirectResponse
    {
        $data = $request->safe()->except('image');

        $tipsCategory->fill($data);

        if ($request->hasFile('image')) {
            $tipsCategory->deleteStoredImage();
            $tipsCategory->image_url = $request->file('image')->store('tips-categories', 'public');
        }

        $tipsCategory->save();

        return redirect()
            ->route('admin.tips-categories.index')
            ->with('success', 'Tips category updated successfully.');
    }

    public function destroy(TipsCategory $tipsCategory): RedirectResponse
    {
        $tipsCategory->delete();

        return redirect()
            ->route('admin.tips-categories.index')
            ->with('success', 'Tips category deleted successfully.');
    }
}
