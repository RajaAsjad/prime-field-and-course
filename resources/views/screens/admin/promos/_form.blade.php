<div class="row g-3">
  <div class="col-md-8">
    <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
    <input
      type="text"
      class="form-control @error('title') is-invalid @enderror"
      id="title"
      name="title"
      value="{{ old('title', isset($promo) ? $promo->title : '') }}"
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
      <option value="1" @selected((string) old('status', $promo->exists ? (int) $promo->status : 1) === '1')>Active</option>
      <option value="0" @selected((string) old('status', $promo->exists ? (int) $promo->status : 1) === '0')>Inactive</option>
    </select>
    @error('status')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label" for="price">Price</label>
    <input
      type="number"
      step="0.01"
      min="0"
      class="form-control @error('price') is-invalid @enderror"
      id="price"
      name="price"
      value="{{ old('price', isset($promo) ? $promo->price : '') }}"
    />
    @error('price')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label" for="discount_price">Discount Price</label>
    <input
      type="number"
      step="0.01"
      min="0"
      class="form-control @error('discount_price') is-invalid @enderror"
      id="discount_price"
      name="discount_price"
      value="{{ old('discount_price', isset($promo) ? $promo->discount_price : '') }}"
    />
    @error('discount_price')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-12">
    <label class="form-label" for="image">Image</label>
    @if (isset($promo) && $promo->exists && $promo->imageUrl())
      <div class="mb-2">
        <p class="small text-muted mb-1">Current image</p>
        <img src="{{ $promo->imageUrl() }}" alt="{{ $promo->title }}" class="img-thumbnail promo-image-preview" id="current-promo-image">
      </div>
    @endif
    <input
      type="file"
      class="form-control @error('image') is-invalid @enderror"
      id="image"
      name="image"
      accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
      data-preview="preview-promo-image"
    />
    <small class="text-muted">Allowed: JPG, PNG, WEBP. Max 2MB.</small>
    <img src="#" alt="" class="img-thumbnail promo-image-preview mt-2 d-none" id="preview-promo-image">
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
    >{{ old('description', isset($promo) ? $promo->description : '') }}</textarea>
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
