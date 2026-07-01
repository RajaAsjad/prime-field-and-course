<div class="row g-3">
  <div class="col-md-8">
    <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
    <input
      type="text"
      class="form-control @error('title') is-invalid @enderror"
      id="title"
      name="title"
      value="{{ old('title', isset($tip) ? $tip->title : '') }}"
      required
    />
    <small class="text-muted">A unique URL slug will be generated automatically from the title.</small>
    @error('title')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-4">
    <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
      <option value="1" @selected((string) old('status', $tip->exists ? (int) $tip->status : 1) === '1')>Active</option>
      <option value="0" @selected((string) old('status', $tip->exists ? (int) $tip->status : 1) === '0')>Inactive</option>
    </select>
    @error('status')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-12">
    <label class="form-label" for="slogan">Slogan</label>
    <input
      type="text"
      class="form-control @error('slogan') is-invalid @enderror"
      id="slogan"
      name="slogan"
      value="{{ old('slogan', isset($tip) ? $tip->slogan : '') }}"
    />
    @error('slogan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-12">
    <label class="form-label" for="image">Image</label>
    @if (isset($tip) && $tip->exists && $tip->imageUrl())
      <div class="mb-2">
        <p class="small text-muted mb-1">Current image</p>
        <img src="{{ $tip->imageUrl() }}" alt="{{ $tip->title }}" class="img-thumbnail tip-image-preview" id="current-tip-image">
      </div>
    @endif
    <input
      type="file"
      class="form-control @error('image') is-invalid @enderror"
      id="image"
      name="image"
      accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
      data-preview="preview-tip-image"
    />
    <small class="text-muted">Allowed: JPG, PNG, WEBP. Max 2MB.</small>
    <img src="#" alt="" class="img-thumbnail tip-image-preview mt-2 d-none" id="preview-tip-image">
    @error('image')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-12">
    <label class="form-label" for="description">Description</label>
    <textarea
      class="form-control @error('description') is-invalid @enderror"
      id="description"
      name="description"
      rows="6"
    >{{ old('description', isset($tip) ? $tip->description : '') }}</textarea>
    @error('description')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<script>
  document.querySelectorAll('input[type="file"][data-preview]').forEach(function (input) {
    input.addEventListener('change', function () {
      var previewId = input.getAttribute('data-preview');
      var preview = document.getElementById(previewId);
      if (!preview) return;

      if (!input.files || !input.files[0]) {
        preview.classList.add('d-none');
        preview.removeAttribute('src');
        return;
      }

      preview.src = URL.createObjectURL(input.files[0]);
      preview.classList.remove('d-none');
    });
  });
</script>
