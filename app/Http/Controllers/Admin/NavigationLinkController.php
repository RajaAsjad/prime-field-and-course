<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNavigationLinkRequest;
use App\Http\Requests\Admin\UpdateNavigationLinkRequest;
use App\Models\NavigationLink;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NavigationLinkController extends Controller
{
    public function index(Request $request): View
    {
        $location = $request->query('location');

        $links = NavigationLink::query()
            ->when($location, fn ($q) => $q->where('location', $location))
            ->orderBy('location')
            ->orderBy('sort_order')
            ->paginate(20)
            ->withQueryString();

        return view('screens.admin.navigation-links.index', compact('links', 'location'));
    }

    public function create(): View
    {
        $link = new NavigationLink(['is_active' => true, 'sort_order' => 0]);

        return view('screens.admin.navigation-links.create', compact('link'));
    }

    public function store(StoreNavigationLinkRequest $request): RedirectResponse
    {
        NavigationLink::create($this->prepareData($request));

        return redirect()
            ->route('admin.navigation-links.index')
            ->with('success', 'Navigation link created successfully.');
    }

    public function edit(NavigationLink $navigationLink): View
    {
        return view('screens.admin.navigation-links.edit', ['link' => $navigationLink]);
    }

    public function update(UpdateNavigationLinkRequest $request, NavigationLink $navigationLink): RedirectResponse
    {
        $navigationLink->update($this->prepareData($request));

        return redirect()
            ->route('admin.navigation-links.index')
            ->with('success', 'Navigation link updated successfully.');
    }

    public function destroy(NavigationLink $navigationLink): RedirectResponse
    {
        $navigationLink->delete();

        return redirect()
            ->route('admin.navigation-links.index')
            ->with('success', 'Navigation link deleted successfully.');
    }

    private function prepareData(StoreNavigationLinkRequest|UpdateNavigationLinkRequest $request): array
    {
        $data = $request->validated();
        $data['open_new_tab'] = $request->boolean('open_new_tab');
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
