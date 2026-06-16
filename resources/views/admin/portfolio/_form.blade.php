@php $item = $item ?? null; @endphp
<div class="row">
	<div class="col-md-6"><div class="form-group"><label>Title *</label><input type="text" name="title" class="form-control" value="{{ old('title', $item->title ?? '') }}" required></div></div>
	<div class="col-md-6"><div class="form-group"><label>Category label</label><input type="text" name="category_label" class="form-control" value="{{ old('category_label', $item->category_label ?? '') }}" placeholder="Golf Course — New Build"></div></div>
</div>
<div class="form-group"><label>Subtitle (location / year)</label><input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $item->subtitle ?? '') }}"></div>
<div class="form-group"><label>Image alt text</label><input type="text" name="image_alt" class="form-control" value="{{ old('image_alt', $item->image_alt ?? '') }}"></div>
<div class="row">
	<div class="col-md-4"><div class="form-group"><label>Image</label><input type="file" name="image" class="form-control" accept="image/*">@if(!empty($item?->image))<p class="help-block"><img src="{{ $item->image_url }}" width="120" style="border-radius:8px;margin-top:8px"></p>@endif</div></div>
	<div class="col-md-4"><div class="form-group"><label>Sort order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $item->sort_order ?? 0) }}" min="0"><small class="text-muted">1=tall left, 2–3=top right, 4=wide bottom</small></div></div>
	<div class="col-md-4"><div class="form-group"><label>Status</label><select name="status" class="form-control"><option value="1" @selected(old('status', $item->status ?? 1) == 1)>Active</option><option value="0" @selected(old('status', $item->status ?? 1) == 0)>Inactive</option></select></div></div>
</div>
