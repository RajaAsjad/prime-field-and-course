<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePromoRequest;
use App\Http\Requests\Admin\UpdatePromoRequest;
use App\Models\Promo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $promos = Promo::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('screens.admin.promos.index', compact('promos', 'search'));
    }

    public function create(): View
    {
        $promo = new Promo();

        return view('screens.admin.promos.create', compact('promo'));
    }

    public function store(StorePromoRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('image');
        $data['status'] = $request->boolean('status');

        $promo = new Promo($data);

        if ($request->hasFile('image')) {
            $promo->image_url = $request->file('image')->store('promos', 'public');
        }

        $promo->save();

        return redirect()
            ->route('admin.promos.index')
            ->with('success', 'Promo created successfully.');
    }

    public function edit(Promo $promo): View
    {
        return view('screens.admin.promos.edit', compact('promo'));
    }

    public function update(UpdatePromoRequest $request, Promo $promo): RedirectResponse
    {
        $data = $request->safe()->except('image');
        $data['status'] = $request->boolean('status');

        $promo->fill($data);

        if ($request->hasFile('image')) {
            $promo->deleteStoredImage();
            $promo->image_url = $request->file('image')->store('promos', 'public');
        }

        $promo->save();

        return redirect()
            ->route('admin.promos.index')
            ->with('success', 'Promo updated successfully.');
    }

    public function destroy(Promo $promo): RedirectResponse
    {
        $promo->delete();

        return redirect()
            ->route('admin.promos.index')
            ->with('success', 'Promo deleted successfully.');
    }
}
