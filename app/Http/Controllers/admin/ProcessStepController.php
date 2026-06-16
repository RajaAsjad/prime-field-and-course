<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProcessStep;
use Illuminate\Http\Request;

class ProcessStepController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:process-list|process-create|process-edit|process-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:process-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:process-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:process-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $page_title = 'How We Work';
        $steps = ProcessStep::orderBy('sort_order')->orderBy('id')->paginate(10);

        return view('admin.process.index', compact('steps', 'page_title'));
    }

    public function create()
    {
        $page_title = 'Add Process Step';

        return view('admin.process.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'step_number' => 'nullable|string|max:4',
            'phase_label' => 'nullable|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        ProcessStep::create([
            'step_number' => $request->step_number,
            'phase_label' => $request->phase_label,
            'title' => $request->title,
            'description' => $request->description,
            'sort_order' => (int) ($request->sort_order ?? 0),
            'status' => $request->boolean('status', true),
        ]);

        return redirect()->route('process.index')->with('message', 'Process step added successfully.');
    }

    public function edit($id)
    {
        $page_title = 'Edit Process Step';
        $step = ProcessStep::findOrFail($id);

        return view('admin.process.edit', compact('step', 'page_title'));
    }

    public function update(Request $request, $id)
    {
        $step = ProcessStep::findOrFail($id);

        $request->validate([
            'step_number' => 'nullable|string|max:4',
            'phase_label' => 'nullable|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $step->update([
            'step_number' => $request->step_number,
            'phase_label' => $request->phase_label,
            'title' => $request->title,
            'description' => $request->description,
            'sort_order' => (int) ($request->sort_order ?? 0),
            'status' => $request->boolean('status', true),
        ]);

        return redirect()->route('process.index')->with('message', 'Process step updated successfully.');
    }

    public function destroy($id)
    {
        ProcessStep::findOrFail($id)->delete();

        return redirect()->route('process.index')->with('message', 'Process step deleted successfully.');
    }
}
