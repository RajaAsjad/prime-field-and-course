<div class="row g-3">
  <div class="col-md-8">
    <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
    <input
      type="text"
      class="form-control @error('title') is-invalid @enderror"
      id="title"
      name="title"
      value="{{ old('title', $blog->title ?? '') }}"
      required
    />
    @error('title')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-4">
    <label class="form-label" for="slug">Slug</label>
    <input
      type="text"
      class="form-control @error('slug') is-invalid @enderror"
      id="slug"
      name="slug"
      value="{{ old('slug', $blog->slug ?? '') }}"
      placeholder="auto-generated from title"
    />
    @error('slug')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label" for="meta_title">SEO Meta Title</label>
    <input
      type="text"
      class="form-control @error('meta_title') is-invalid @enderror"
      id="meta_title"
      name="meta_title"
      value="{{ old('meta_title', $blog->meta_title ?? '') }}"
    />
    @error('meta_title')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label" for="published_at">Publish Date</label>
    <input
      type="datetime-local"
      class="form-control @error('published_at') is-invalid @enderror"
      id="published_at"
      name="published_at"
      value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d\\TH:i')) }}"
    />
    @error('published_at')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-12">
    <label class="form-label" for="meta_description">SEO Meta Description</label>
    <textarea
      class="form-control @error('meta_description') is-invalid @enderror"
      id="meta_description"
      name="meta_description"
      rows="2"
    >{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
    @error('meta_description')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-12">
    <label class="form-label" for="excerpt">Excerpt</label>
    <textarea
      class="form-control @error('excerpt') is-invalid @enderror"
      id="excerpt"
      name="excerpt"
      rows="2"
      placeholder="Short summary shown on blog listing cards"
    >{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
    @error('excerpt')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-12">
    <label class="form-label" for="image">Featured Image</label>
    @if ($blog->exists && $blog->imageUrl())
      <div class="mb-2">
        <p class="small text-muted mb-1">Current image</p>
        <img src="{{ $blog->imageUrl() }}" alt="{{ $blog->title }}" class="img-thumbnail blog-image-preview" id="current-blog-image">
      </div>
    @endif
    <input
      type="file"
      class="form-control @error('image') is-invalid @enderror"
      id="image"
      name="image"
      accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
      data-preview="preview-blog-image"
    />
    <small class="text-muted">Allowed: JPG, PNG, WEBP. Max 2MB.</small>
    <img src="#" alt="" class="img-thumbnail blog-image-preview mt-2 d-none" id="preview-blog-image">
    @error('image')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-12">
    <label class="form-label" for="body">Body</label>
    <textarea
      class="form-control @error('body') is-invalid @enderror"
      id="body"
      name="body"
      rows="16"
    >{{ old('body', $blog->body ?? '') }}</textarea>
    <small class="text-muted">Use the toolbar for headings, bold, lists, links, images, tables, and more.</small>
    @error('body')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-md-4">
    <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
      <option value="1" @selected((string) old('status', $blog->exists ? (int) $blog->status : 1) === '1')>Published</option>
      <option value="0" @selected((string) old('status', $blog->exists ? (int) $blog->status : 1) === '0')>Draft</option>
    </select>
    @error('status')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/tinymce.min.js" referrerpolicy="origin"></script>
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

  if (window.tinymce) {
    tinymce.remove('#body');
    tinymce.init({
      selector: '#body',
      height: 520,
      menubar: 'file edit view insert format tools table',
      plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table wordcount',
      toolbar: 'undo redo | blocks | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | removeformat | code fullscreen preview',
      block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4',
      branding: false,
      promotion: false,
      convert_urls: false,
      relative_urls: false,
      content_style: 'body { font-family: Rubik, Arial, sans-serif; font-size: 15px; line-height: 1.6; }',
      setup: function (editor) {
        editor.on('change keyup', function () {
          editor.save();
        });
      },
    });
  }

  document.querySelector('form')?.addEventListener('submit', function () {
    if (window.tinymce) {
      tinymce.triggerSave();
    }
  });
</script>
@endpush
