<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGallerySlideRequest;
use App\Http\Requests\Admin\UpdateGallerySlideRequest;
use App\Models\GallerySlide;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GallerySlideController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $slides = GallerySlide::query()
            ->when($search !== '', fn ($q) => $q->where('title', 'like', "%{$search}%"))
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('screens.admin.gallery-slides.index', compact('slides', 'search'));
    }

    public function create(): View
    {
        $slide = new GallerySlide([
            'is_active' => true,
            'sort_order' => 0,
        ]);

        return view('screens.admin.gallery-slides.create', compact('slide'));
    }

    public function store(StoreGallerySlideRequest $request): RedirectResponse
    {
        $slide = new GallerySlide($this->prepareData($request));
        $slide->image = $request->file('image')->store('gallery', 'public');
        $slide->save();

        return redirect()
            ->route('admin.gallery-slides.index')
            ->with('success', 'Gallery slide created successfully.');
    }

    public function edit(GallerySlide $gallerySlide): View
    {
        return view('screens.admin.gallery-slides.edit', [
            'slide' => $gallerySlide,
        ]);
    }

    public function update(UpdateGallerySlideRequest $request, GallerySlide $gallerySlide): RedirectResponse
    {
        $gallerySlide->fill($this->prepareData($request));

        if ($request->hasFile('image')) {
            $gallerySlide->deleteStoredImage();
            $gallerySlide->image = $request->file('image')->store('gallery', 'public');
        }

        $gallerySlide->save();

        return redirect()
            ->route('admin.gallery-slides.index')
            ->with('success', 'Gallery slide updated successfully.');
    }

    public function destroy(GallerySlide $gallerySlide): RedirectResponse
    {
        $gallerySlide->delete();

        return redirect()
            ->route('admin.gallery-slides.index')
            ->with('success', 'Gallery slide deleted successfully.');
    }

    private function prepareData(StoreGallerySlideRequest|UpdateGallerySlideRequest $request): array
    {
        $data = $request->safe()->except('image');
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) $request->input('sort_order', 0);

        return $data;
    }
}
