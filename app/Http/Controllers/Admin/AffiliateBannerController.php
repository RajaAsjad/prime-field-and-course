<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAffiliateBannerRequest;
use App\Http\Requests\Admin\UpdateAffiliateBannerRequest;
use App\Models\AffiliateBanner;
use App\Support\AffiliateBannerPlacements;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AffiliateBannerController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $banners = AffiliateBanner::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder->where('title', 'like', "%{$search}%")
                        ->orWhere('brand_name', 'like', "%{$search}%");
                });
            })
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('screens.admin.affiliate-banners.index', compact('banners', 'search'));
    }

    public function create(): View
    {
        $banner = new AffiliateBanner([
            'is_active' => true,
            'sort_order' => 0,
            'cta_label' => 'Claim Offer',
            'placements' => [],
        ]);

        return view('screens.admin.affiliate-banners.create', [
            'banner' => $banner,
            'placementGroups' => AffiliateBannerPlacements::groups(),
        ]);
    }

    public function store(StoreAffiliateBannerRequest $request): RedirectResponse
    {
        AffiliateBanner::create($this->prepareData($request));

        return redirect()
            ->route('admin.affiliate-banners.index')
            ->with('success', 'Offer banner created successfully.');
    }

    public function edit(AffiliateBanner $affiliateBanner): View
    {
        return view('screens.admin.affiliate-banners.edit', [
            'banner' => $affiliateBanner,
            'placementGroups' => AffiliateBannerPlacements::groups(),
        ]);
    }

    public function update(UpdateAffiliateBannerRequest $request, AffiliateBanner $affiliateBanner): RedirectResponse
    {
        $affiliateBanner->update($this->prepareData($request));

        return redirect()
            ->route('admin.affiliate-banners.index')
            ->with('success', 'Offer banner updated successfully.');
    }

    public function destroy(AffiliateBanner $affiliateBanner): RedirectResponse
    {
        $affiliateBanner->delete();

        return redirect()
            ->route('admin.affiliate-banners.index')
            ->with('success', 'Offer banner deleted successfully.');
    }

    private function prepareData(StoreAffiliateBannerRequest|UpdateAffiliateBannerRequest $request): array
    {
        $data = $request->safe()->except('placements');
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) $request->input('sort_order', 0);
        $data['placements'] = array_values(array_intersect(
            (array) $request->input('placements', []),
            AffiliateBannerPlacements::keys()
        ));

        return $data;
    }
}
