<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaqRequest;
use App\Http\Requests\Admin\UpdateFaqRequest;
use App\Models\Faq;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $faqs = Faq::query()
            ->when($search !== '', fn ($q) => $q->where('question', 'like', "%{$search}%"))
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();

        return view('screens.admin.faqs.index', compact('faqs', 'search'));
    }

    public function create(): View
    {
        $faq = new Faq(['is_active' => true, 'sort_order' => 0]);

        return view('screens.admin.faqs.create', compact('faq'));
    }

    public function store(StoreFaqRequest $request): RedirectResponse
    {
        Faq::create($this->prepareData($request));

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq): View
    {
        return view('screens.admin.faqs.edit', compact('faq'));
    }

    public function update(UpdateFaqRequest $request, Faq $faq): RedirectResponse
    {
        $faq->update($this->prepareData($request));

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }

    private function prepareData(StoreFaqRequest|UpdateFaqRequest $request): array
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $data['open_by_default'] = $request->boolean('open_by_default');

        return $data;
    }
}
