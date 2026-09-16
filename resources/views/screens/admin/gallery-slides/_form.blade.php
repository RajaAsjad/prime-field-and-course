<div class="row g-3">
  <div class="col-md-12">
    <label class="form-label" for="image">Image @unless($slide->exists)<span class="text-danger">*</span>@endunless</label>
    @if ($slide->exists && $slide->imageUrl())
      <div class="mb-2">
        <p class="small text-muted mb-1">Current image</p>
        <img
          src="{{ $slide->imageUrl() }}"
          alt="{{ $slide->title ?: 'Current slide' }}"
          class="img-thumbnail"
          id="current-gallery-image"
          style="max-height:180px;width:auto;object-fit:contain;"
        >
      </div>
    @endif
    <input
      type="file"
      class="form-control @error('image') is-invalid @enderror"
      id="image"
      name="image"
      accept=".jpg,.jpeg,.png,.webp,.avif,image/jpeg,image/png,image/webp,image/avif"
      data-preview="preview-gallery-image"
      @unless($slide->exists) required @endunless
    />
    <small class="text-muted">JPG, PNG, WEBP, or AVIF. Max 5MB. Recommended wide image (around 1400×500).</small>
    <img
      src="#"
      alt="Selected image preview"
      class="img-thumbnail mt-2 d-none"
      id="preview-gallery-image"
      style="max-height:180px;width:auto;object-fit:contain;"
    >
    @error('image')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>
  <div class="col-md-8">
    <label class="form-label">Title</label>
    <input class="form-control" name="title" value="{{ old('title', $slide->title ?? '') }}" placeholder="Optional caption">
  </div>
  <div class="col-md-4">
    <label class="form-label">Sort Order</label>
    <input type="number" min="0" class="form-control" name="sort_order" value="{{ old('sort_order', $slide->sort_order ?? 0) }}">
  </div>
  <div class="col-md-8">
    <label class="form-label">Link URL</label>
    <input class="form-control" name="link_url" value="{{ old('link_url', $slide->link_url ?? '') }}" placeholder="https://… (optional)">
  </div>
  <div class="col-md-4 d-flex align-items-end pb-2">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="is_active" id="slide_active" value="1" @checked(old('is_active', $slide->is_active ?? true))>
      <label class="form-check-label" for="slide_active">Active</label>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll('input[type="file"][data-preview]').forEach(function (input) {
    input.addEventListener('change', function () {
      var preview = document.getElementById(input.getAttribute('data-preview'));
      var current = document.getElementById('current-gallery-image');
      if (!preview) return;

      if (!input.files || !input.files[0]) {
        preview.classList.add('d-none');
        preview.removeAttribute('src');
        if (current) current.parentElement.classList.remove('d-none');
        return;
      }

      preview.src = URL.createObjectURL(input.files[0]);
      preview.classList.remove('d-none');
      if (current) current.parentElement.classList.add('d-none');
    });
  });
</script>
