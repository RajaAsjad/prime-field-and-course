@php $contentJson = old('content_json', isset($page) && $page->exists ? json_encode($page->content ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '{}'); @endphp
<div class="row g-3">
  <div class="col-md-8">
    <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $page->title ?? '') }}" required>
    @error('title')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-4">
    <label class="form-label" for="type">Page Type <span class="text-danger">*</span></label>
    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
      @foreach (\App\Models\ContentPage::TYPES as $value => $label)
        <option value="{{ $value }}" @selected(old('type', $page->type ?? 'generic') === $value)>{{ $label }}</option>
      @endforeach
    </select>
    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6">
    <label class="form-label" for="slug">Slug</label>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $page->slug ?? '') }}" placeholder="auto-generated from title">
    @error('slug')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6">
    <label class="form-label" for="footer_label">Footer Label</label>
    <input type="text" class="form-control" id="footer_label" name="footer_label" value="{{ old('footer_label', $page->footer_label ?? '') }}">
  </div>
  <div class="col-md-12">
    <label class="form-label" for="subtitle">Subtitle</label>
    <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle', $page->subtitle ?? '') }}">
  </div>
  <div class="col-md-12">
    <label class="form-label" for="meta_description">Meta Description</label>
    <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
  </div>
  <div class="col-md-6">
    <label class="form-label" for="eyebrow">Eyebrow</label>
    <input type="text" class="form-control" id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $page->eyebrow ?? '') }}">
  </div>
  <div class="col-md-3">
    <label class="form-label" for="sort_order">Sort Order</label>
    <input type="number" min="0" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $page->sort_order ?? 0) }}">
  </div>
  <div class="col-md-3 d-flex align-items-end gap-3 pb-2">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published', $page->is_published ?? true))>
      <label class="form-check-label" for="is_published">Published</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="show_in_footer" name="show_in_footer" value="1" @checked(old('show_in_footer', $page->show_in_footer ?? false))>
      <label class="form-check-label" for="show_in_footer">Footer Link</label>
    </div>
  </div>
  <div class="col-md-12">
    <label class="form-label" for="intro">Intro</label>
    <textarea class="form-control" id="intro" name="intro" rows="3">{{ old('intro', $page->intro ?? '') }}</textarea>
  </div>
  <div class="col-md-12">
    <label class="form-label" for="body">Body (for legal/simple pages)</label>
    <textarea class="form-control" id="body" name="body" rows="8">{{ old('body', $page->body ?? '') }}</textarea>
  </div>
  <div class="col-md-12">
    <label class="form-label" for="content_json">Structured Content (JSON)</label>
    <textarea class="form-control font-monospace" id="content_json" name="content_json" rows="16">{{ $contentJson }}</textarea>
    <small class="text-muted">For glossary: {"terms":[...]} · apps: {"apps":[...],"tips":[...]} · guide: {"sections":[...]}</small>
  </div>
</div>
