@php
  $content = old('content', $page->content ?? []);
  $selectedType = old('type', $page->type ?? 'generic');
  $asLines = static fn ($value) => is_array($value) ? implode("\n", $value) : (string) $value;
  $terms = $content['terms'] ?? [];
  $apps = $content['apps'] ?? [];
  $tips = $content['tips'] ?? [];
  $sections = $content['sections'] ?? [];
  if ($terms === []) {
      $terms = [[]];
  }
  if ($apps === []) {
      $apps = [[]];
  }
  if ($tips === []) {
      $tips = [[]];
  }
  if ($sections === []) {
      $sections = [[]];
  }
@endphp
<style>
  .content-repeater-card { border: 1px solid #e2e8e4; box-shadow: none; }
  .content-repeater-card .card-header { background: #f4f7f5; }
  .content-letter {
    width: 32px; height: 32px; border-radius: 50%;
    background: #1a5c28; color: #fff; font-weight: 700; font-size: .85rem;
    display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;
  }
  [data-content-panel="apps"] > [data-repeater] > [data-repeater-items],
  [data-content-panel="guide"] > [data-repeater] > [data-repeater-items] { counter-reset: app-rank; }
  .content-rank::before {
    counter-increment: app-rank;
    content: counter(app-rank);
  }
  [data-body-field][hidden],
  [data-content-panel][hidden] {
    display: none !important;
  }
</style>
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
        <option value="{{ $value }}" @selected($selectedType === $value)>{{ $label }}</option>
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
  <div class="col-md-12" data-body-field @if (in_array($selectedType, ['glossary', 'apps', 'guide'], true)) hidden @endif>
    <label class="form-label" for="body">Body (for legal/simple pages)</label>
    <textarea class="form-control" id="body" name="body" rows="8">{{ old('body', $page->body ?? '') }}</textarea>
  </div>

  <div class="col-md-12" data-content-panel="glossary" @if ($selectedType !== 'glossary') hidden @endif>
    <div class="d-flex justify-content-between align-items-center mb-2">
      <div>
        <label class="form-label mb-0">Glossary Cards</label>
        <small class="text-muted d-block">Each card appears on the Golf Glossary page.</small>
      </div>
    </div>
    <div data-repeater data-next-index="{{ count($terms) }}">
      <div data-repeater-items>
        @foreach ($terms as $i => $item)
          @include('screens.admin.content-pages._term-card', ['index' => $i, 'item' => $item])
        @endforeach
      </div>
      <template data-repeater-template>
        @include('screens.admin.content-pages._term-card', ['index' => '__INDEX__', 'item' => []])
      </template>
      <button type="button" class="btn btn-outline-primary btn-sm" data-add-item>+ Add Card</button>
    </div>
  </div>

  <div class="col-md-12" data-content-panel="apps" @if ($selectedType !== 'apps') hidden @endif>
    <div class="mb-2">
      <label class="form-label mb-0">Betting Apps</label>
      <small class="text-muted d-block">Each card appears on the Best Golf Betting Apps page.</small>
    </div>
    <div data-repeater data-next-index="{{ count($apps) }}">
      <div data-repeater-items>
        @foreach ($apps as $i => $item)
          @include('screens.admin.content-pages._app-card', ['index' => $i, 'item' => $item, 'asLines' => $asLines])
        @endforeach
      </div>
      <template data-repeater-template>
        @include('screens.admin.content-pages._app-card', ['index' => '__INDEX__', 'item' => [], 'asLines' => $asLines])
      </template>
      <button type="button" class="btn btn-outline-primary btn-sm" data-add-item>+ Add App</button>
    </div>
    <div class="mt-4 mb-2">
      <label class="form-label mb-0">Betting Tips</label>
    </div>
    <div data-repeater data-next-index="{{ count($tips) }}">
      <div data-repeater-items>
        @foreach ($tips as $i => $item)
          @include('screens.admin.content-pages._tip-card', ['index' => $i, 'item' => $item])
        @endforeach
      </div>
      <template data-repeater-template>
        @include('screens.admin.content-pages._tip-card', ['index' => '__INDEX__', 'item' => []])
      </template>
      <button type="button" class="btn btn-outline-primary btn-sm" data-add-item>+ Add Tip</button>
    </div>
  </div>

  <div class="col-md-12" data-content-panel="guide" @if ($selectedType !== 'guide') hidden @endif>
    <div class="mb-2">
      <label class="form-label mb-0">Guide Sections</label>
      <small class="text-muted d-block">Each section appears on the How to Bet on Golf page. Anchor ID is auto-generated from the title if left blank.</small>
    </div>
    <div data-repeater data-next-index="{{ count($sections) }}">
      <div data-repeater-items>
        @foreach ($sections as $i => $item)
          @include('screens.admin.content-pages._section-card', ['index' => $i, 'item' => $item])
        @endforeach
      </div>
      <template data-repeater-template>
        @include('screens.admin.content-pages._section-card', ['index' => '__INDEX__', 'item' => []])
      </template>
      <button type="button" class="btn btn-outline-primary btn-sm" data-add-item>+ Add Section</button>
    </div>
  </div>
</div>
<script>
  (function () {
    var root = document.querySelector('.row.g-3');
    var typeSelect = document.getElementById('type');
    if (!root) return;

    function addRepeaterItem(repeater) {
      var index = Number(repeater.getAttribute('data-next-index') || 0);
      var template = repeater.querySelector(':scope > [data-repeater-template]');
      if (!template) return;
      var html = template.innerHTML.replaceAll('__INDEX__', String(index));
      repeater.querySelector(':scope > [data-repeater-items]').insertAdjacentHTML('beforeend', html);
      repeater.setAttribute('data-next-index', String(index + 1));
    }

    root.addEventListener('click', function (event) {
      var addBtn = event.target.closest('[data-add-item]');
      if (addBtn) {
        var repeater = addBtn.closest('[data-repeater]');
        if (repeater) addRepeaterItem(repeater);
        return;
      }

      var removeBtn = event.target.closest('[data-remove-item]');
      if (removeBtn) {
        var item = removeBtn.closest('[data-repeater-item]');
        if (item) item.remove();
      }
    });

    root.addEventListener('input', function (event) {
      var letterInput = event.target.closest('[data-letter-source]');
      if (letterInput) {
        var item = letterInput.closest('[data-repeater-item]');
        var badge = item && item.querySelector('[data-letter-badge]');
        var title = item && item.querySelector('[data-item-title]');
        var letter = (letterInput.value.trim().charAt(0) || '?').toUpperCase();
        if (badge) badge.textContent = letter;
        if (title) title.textContent = letterInput.value.trim() || 'New card';
      }

      var titleInput = event.target.closest('[data-title-source]');
      if (titleInput) {
        var card = titleInput.closest('[data-repeater-item]');
        var heading = card && card.querySelector('[data-item-title]');
        if (heading) heading.textContent = titleInput.value.trim() || heading.getAttribute('data-empty-label') || 'New item';
      }
    });

    function syncPanels() {
      var type = typeSelect ? typeSelect.value : 'generic';
      document.querySelectorAll('[data-content-panel]').forEach(function (panel) {
        var active = panel.getAttribute('data-content-panel') === type;
        panel.hidden = !active;
        panel.querySelectorAll('input, textarea, select, button').forEach(function (control) {
          control.disabled = !active;
        });
      });
      var bodyField = document.querySelector('[data-body-field]');
      if (bodyField) {
        var hideBody = type === 'glossary' || type === 'apps' || type === 'guide';
        bodyField.hidden = hideBody;
        bodyField.querySelectorAll('input, textarea, select').forEach(function (control) {
          control.disabled = hideBody;
        });
      }
    }

    if (typeSelect) {
      typeSelect.addEventListener('change', syncPanels);
    }
    syncPanels();
  })();
</script>
