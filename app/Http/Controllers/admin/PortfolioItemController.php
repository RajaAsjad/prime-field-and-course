<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:portfolio-list|portfolio-create|portfolio-edit|portfolio-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:portfolio-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:portfolio-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:portfolio-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $page_title = 'Portfolio';
        $items = PortfolioItem::orderBy('sort_order')->orderBy('id')->paginate(10);

        return view('admin.portfolio.index', compact('items', 'page_title'));
    }

    public function create()
    {
        $page_title = 'Add Portfolio Item';

        return view('admin.portfolio.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_label' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image_alt' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10000',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $item = new PortfolioItem();
        $item->fill($request->only('category_label', 'title', 'subtitle', 'image_alt', 'sort_order'));
        $item->slug = Str::slug($request->title);
        $item->status = $request->boolean('status', true);
        $item->sort_order = (int) ($request->sort_order ?? 0);

        if ($request->hasFile('image')) {
            $item->image = $this->storeImage($request->file('image'));
        }

        $item->save();

        return redirect()->route('portfolio.index')->with('message', 'Portfolio item added successfully.');
    }

    public function edit($slug)
    {
        $page_title = 'Edit Portfolio Item';
        $item = PortfolioItem::where('slug', $slug)->firstOrFail();

        return view('admin.portfolio.edit', compact('item', 'page_title'));
    }

    public function update(Request $request, $slug)
    {
        $item = PortfolioItem::where('slug', $slug)->firstOrFail();

        $request->validate([
            'category_label' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image_alt' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10000',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $item->fill($request->only('category_label', 'title', 'subtitle', 'image_alt', 'sort_order'));
        $item->slug = Str::slug($request->title);
        $item->status = $request->boolean('status', true);
        $item->sort_order = (int) ($request->sort_order ?? 0);

        if ($request->hasFile('image')) {
            $item->image = $this->storeImage($request->file('image'));
        }

        $item->save();

        return redirect()->route('portfolio.index')->with('message', 'Portfolio item updated successfully.');
    }

    public function destroy($slug)
    {
        PortfolioItem::where('slug', $slug)->firstOrFail()->delete();

        return redirect()->route('portfolio.index')->with('message', 'Portfolio item deleted successfully.');
    }

    protected function storeImage($file): string
    {
        $dir = public_path('admin/assets/images/portfolio');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $name = date('d-m-Y-His') . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $name);

        return $name;
    }
}
