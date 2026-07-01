<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTipRequest;
use App\Http\Requests\Admin\UpdateTipRequest;
use App\Models\Tip;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TipController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $tips = Tip::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('screens.admin.tips.index', compact('tips', 'search'));
    }

    public function create(): View
    {
        $tip = new Tip();

        return view('screens.admin.tips.create', compact('tip'));
    }

    public function store(StoreTipRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('image');
        $data['status'] = $request->boolean('status');

        $tip = new Tip($data);

        if ($request->hasFile('image')) {
            $tip->image = $request->file('image')->store('tips', 'public');
        }

        $tip->save();

        return redirect()
            ->route('admin.tips.index')
            ->with('success', 'Tip created successfully.');
    }

    public function edit(Tip $tip): View
    {
        return view('screens.admin.tips.edit', compact('tip'));
    }

    public function update(UpdateTipRequest $request, Tip $tip): RedirectResponse
    {
        $data = $request->safe()->except('image');
        $data['status'] = $request->boolean('status');

        $tip->fill($data);

        if ($request->hasFile('image')) {
            $tip->deleteStoredImage();
            $tip->image = $request->file('image')->store('tips', 'public');
        }

        $tip->save();

        return redirect()
            ->route('admin.tips.index')
            ->with('success', 'Tip updated successfully.');
    }

    public function destroy(Tip $tip): RedirectResponse
    {
        $tip->delete();

        return redirect()
            ->route('admin.tips.index')
            ->with('success', 'Tip deleted successfully.');
    }
}
