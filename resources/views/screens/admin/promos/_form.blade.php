<div class="row g-3">
  <div class="col-md-4">
    <label class="form-label" for="book_name">Sportsbook Name</label>
    <input type="text" class="form-control" id="book_name" name="book_name" value="{{ old('book_name', $promo->book_name ?? '') }}" placeholder="BetMGM">
  </div>

  <div class="col-md-4">
    <label class="form-label" for="book_class">Book CSS Class</label>
    <select class="form-select" id="book_class" name="book_class">
      <option value="">Default</option>
      @foreach (['mgm','fd','dk','cz','b365'] as $class)
        <option value="{{ $class }}" @selected(old('book_class', $promo->book_class ?? '') === $class)>{{ strtoupper($class) }}</option>
      @endforeach
    </select>
  </div>

  <div class="col-md-4">
    <label class="form-label" for="bonus_text">Bonus Text</label>
    <input type="text" class="form-control" id="bonus_text" name="bonus_text" value="{{ old('bonus_text', $promo->bonus_text ?? '') }}" placeholder="$1,500 Back">
  </div>

  <div class="col-md-6">
    <label class="form-label" for="cta_url">CTA URL</label>
    <input type="url" class="form-control" id="cta_url" name="cta_url" value="{{ old('cta_url', $promo->cta_url ?? '') }}">
  </div>

  <div class="col-md-3">
    <label class="form-label" for="cta_label">CTA Label</label>
    <input type="text" class="form-control" id="cta_label" name="cta_label" value="{{ old('cta_label', $promo->cta_label ?? 'Claim Bonus →') }}">
  </div>

  <div class="col-md-3">
    <label class="form-label" for="sort_order">Sort Order</label>
    <input type="number" min="0" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $promo->sort_order ?? 0) }}">
  </div>

  <div class="col-md-4">
    <label class="form-label" for="ribbon_text">Ribbon Text</label>
    <input type="text" class="form-control" id="ribbon_text" name="ribbon_text" value="{{ old('ribbon_text', $promo->ribbon_text ?? '') }}" placeholder="TOP PICK">
  </div>

  <div class="col-md-4 d-flex align-items-end pb-2">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" @checked(old('is_featured', $promo->is_featured ?? false))>
      <label class="form-check-label" for="is_featured">Featured (Top Pick styling)</label>
    </div>
  </div>

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

  <div class="col-md-12">
    <label class="form-label" for="disclaimer">Disclaimer</label>
    <input
      type="text"
      class="form-control @error('disclaimer') is-invalid @enderror"
      id="disclaimer"
      name="disclaimer"
      value="{{ old('disclaimer', $promo->disclaimer ?? \App\Models\Promo::DEFAULT_DISCLAIMER) }}"
      placeholder="{{ \App\Models\Promo::DEFAULT_DISCLAIMER }}"
    />
    <small class="text-muted">Shown under the Claim Bonus button on homepage promo cards.</small>
    @error('disclaimer')
      <div class="invalid-feedback d-block">{{ $message }}</div>
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
