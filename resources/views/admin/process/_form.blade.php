@php $step = $step ?? null; @endphp
<div class="row">
	<div class="col-md-2"><div class="form-group"><label>Step #</label><input type="text" name="step_number" class="form-control" value="{{ old('step_number', $step->step_number ?? '') }}" placeholder="01"></div></div>
	<div class="col-md-4"><div class="form-group"><label>Phase label</label><input type="text" name="phase_label" class="form-control" value="{{ old('phase_label', $step->phase_label ?? '') }}" placeholder="Phase One"></div></div>
	<div class="col-md-3"><div class="form-group"><label>Sort order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $step->sort_order ?? 0) }}" min="0"></div></div>
	<div class="col-md-3"><div class="form-group"><label>Status</label><select name="status" class="form-control"><option value="1" @selected(old('status', $step->status ?? 1) == 1)>Active</option><option value="0" @selected(old('status', $step->status ?? 1) == 0)>Inactive</option></select></div></div>
</div>
<div class="form-group"><label>Title *</label><input type="text" name="title" class="form-control" value="{{ old('title', $step->title ?? '') }}" required></div>
<div class="form-group"><label>Description</label><textarea name="description" class="form-control" rows="4">{{ old('description', $step->description ?? '') }}</textarea></div>
