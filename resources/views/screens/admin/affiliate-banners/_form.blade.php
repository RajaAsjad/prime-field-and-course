@php
  $selected = old('placements', $banner->placements ?? []);
@endphp
<div class="row g-3">
  <div class="col-md-4">
    <label class="form-label">Brand name</label>
    <input class="form-control" name="brand_name" value="{{ old('brand_name', $banner->brand_name ?? '') }}" placeholder="BetMGM">
  </div>
  <div class="col-md-8">
    <label class="form-label">Headline <span class="text-danger">*</span></label>
    <input class="form-control" name="title" value="{{ old('title', $banner->title ?? '') }}" required>
  </div>
  <div class="col-md-12">
    <label class="form-label">Fine print</label>
    <textarea class="form-control" name="description" rows="2">{{ old('description', $banner->description ?? '') }}</textarea>
  </div>
  <div class="col-md-4">
    <label class="form-label">Button label</label>
    <input class="form-control" name="cta_label" value="{{ old('cta_label', $banner->cta_label ?? 'Claim Offer') }}">
  </div>
  <div class="col-md-8">
    <label class="form-label">Button URL</label>
    <input class="form-control" name="cta_url" value="{{ old('cta_url', $banner->cta_url ?? '') }}">
  </div>
  <div class="col-md-12">
    <label class="form-label">Tracking pixel URL</label>
    <input class="form-control" name="pixel_url" value="{{ old('pixel_url', $banner->pixel_url ?? '') }}">
  </div>
  <div class="col-md-4">
    <label class="form-label">Sort Order</label>
    <input type="number" min="0" class="form-control" name="sort_order" value="{{ old('sort_order', $banner->sort_order ?? 0) }}">
  </div>
  <div class="col-md-8 d-flex align-items-end pb-2">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="is_active" id="banner_active" value="1" @checked(old('is_active', $banner->is_active ?? true))>
      <label class="form-check-label" for="banner_active">Active</label>
    </div>
  </div>
  <div class="col-md-12">
    <label class="form-label d-block">Show this banner on</label>
    <small class="text-muted d-block mb-2">Pick any homepage section or page. The same banner can appear in more than one place.</small>
    @foreach ($placementGroups as $group => $options)
      <div class="mb-3">
        <p class="fw-semibold mb-2">{{ $group }}</p>
        @forelse ($options as $key => $label)
          <div class="form-check">
            <input
              class="form-check-input"
              type="checkbox"
              id="placement_{{ md5($key) }}"
              name="placements[]"
              value="{{ $key }}"
              @checked(in_array($key, $selected, true))
            >
            <label class="form-check-label" for="placement_{{ md5($key) }}">{{ $label }}</label>
          </div>
        @empty
          <p class="text-muted mb-0">No {{ strtolower($group) }} yet.</p>
        @endforelse
      </div>
    @endforeach
  </div>
</div>
