@php $service = $service ?? null; @endphp
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Title *</label>
			<input type="text" name="title" class="form-control" value="{{ old('title', $service->title ?? '') }}" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label>Tag (badge)</label>
			<input type="text" name="tag" class="form-control" value="{{ old('tag', $service->tag ?? '') }}" placeholder="Golf">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label>Icon</label>
			<select name="icon" class="form-control">
				@foreach(['golf' => 'Golf flag', 'athletics' => 'Athletic field', 'renovation' => 'Renovation'] as $val => $label)
				<option value="{{ $val }}" @selected(old('icon', $service->icon ?? 'golf') === $val)>{{ $label }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>
<div class="form-group">
	<label>Description</label>
	<textarea name="description" class="form-control" rows="4">{{ old('description', $service->description ?? '') }}</textarea>
</div>
<div class="form-group">
	<label>Bullet points (one per line)</label>
	<textarea name="bullets" class="form-control" rows="6">{{ old('bullets', $service->bullets ?? '') }}</textarea>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label>Image</label>
			<input type="file" name="image" class="form-control" accept="image/*">
			@if(!empty($service?->image))
			<p class="help-block"><img src="{{ $service->image_url }}" width="120" style="border-radius:8px;margin-top:8px"></p>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label>Sort order</label>
			<input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $service->sort_order ?? 0) }}" min="0">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label>Status</label>
			<select name="status" class="form-control">
				<option value="1" @selected(old('status', $service->status ?? 1) == 1)>Active</option>
				<option value="0" @selected(old('status', $service->status ?? 1) == 0)>Inactive</option>
			</select>
		</div>
	</div>
</div>
