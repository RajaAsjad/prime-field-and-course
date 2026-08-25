<div class="row g-3">
  <div class="col-md-4">
    <label class="form-label">Label <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="label" value="{{ old('label', $link->label ?? '') }}" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">URL <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="url" value="{{ old('url', $link->url ?? '') }}" required placeholder="#section or /page-slug">
  </div>
  <div class="col-md-4">
    <label class="form-label">Location <span class="text-danger">*</span></label>
    <select class="form-select" name="location" required>
      @foreach (\App\Models\NavigationLink::LOCATIONS as $value => $label)
        <option value="{{ $value }}" @selected(old('location', $link->location ?? '') === $value)>{{ $label }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label">Sort Order</label>
    <input type="number" min="0" class="form-control" name="sort_order" value="{{ old('sort_order', $link->sort_order ?? 0) }}">
  </div>
  <div class="col-md-4 d-flex align-items-end gap-3 pb-2">
    <div class="form-check"><input class="form-check-input" type="checkbox" name="open_new_tab" value="1" @checked(old('open_new_tab', $link->open_new_tab ?? false))><label class="form-check-label">Open in new tab</label></div>
    <div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked(old('is_active', $link->is_active ?? true))><label class="form-check-label">Active</label></div>
  </div>
</div>
