<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:service-list|service-create|service-edit|service-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:service-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:service-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:service-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $page_title = 'Services';
        $services = Service::orderBy('sort_order')->orderBy('id')->paginate(10);

        return view('admin.service.index', compact('services', 'page_title'));
    }

    public function create()
    {
        $page_title = 'Add Service';

        return view('admin.service.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'bullets' => 'nullable|string',
            'icon' => 'nullable|in:golf,athletics,renovation',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10000',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $service = new Service();
        $service->fill($request->only('tag', 'title', 'description', 'bullets', 'icon', 'sort_order'));
        $service->slug = Str::slug($request->title);
        $service->status = $request->boolean('status', true);
        $service->sort_order = (int) ($request->sort_order ?? 0);

        if ($request->hasFile('image')) {
            $service->image = $this->storeImage($request->file('image'));
        }

        $service->save();

        return redirect()->route('service.index')->with('message', 'Service added successfully.');
    }

    public function edit($slug)
    {
        $page_title = 'Edit Service';
        $service = Service::where('slug', $slug)->firstOrFail();

        return view('admin.service.edit', compact('service', 'page_title'));
    }

    public function update(Request $request, $slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'bullets' => 'nullable|string',
            'icon' => 'nullable|in:golf,athletics,renovation',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10000',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $service->fill($request->only('tag', 'title', 'description', 'bullets', 'icon', 'sort_order'));
        $service->slug = Str::slug($request->title);
        $service->status = $request->boolean('status', true);
        $service->sort_order = (int) ($request->sort_order ?? 0);

        if ($request->hasFile('image')) {
            $service->image = $this->storeImage($request->file('image'));
        }

        $service->save();

        return redirect()->route('service.index')->with('message', 'Service updated successfully.');
    }

    public function destroy($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $service->delete();

        return redirect()->route('service.index')->with('message', 'Service deleted successfully.');
    }

    protected function storeImage($file): string
    {
        $dir = public_path('admin/assets/images/services');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $name = date('d-m-Y-His') . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $name);

        return $name;
    }
}
