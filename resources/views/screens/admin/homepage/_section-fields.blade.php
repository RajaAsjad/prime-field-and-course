@php
  $section = $h['sections'][$key] ?? [];
  $note = $note ?? null;
  $showSubtitle = $showSubtitle ?? true;
  $showGuides = $showGuides ?? false;
  $showNewsletter = $showNewsletter ?? false;
  $guides = old("sections.{$key}.guides", $section['guides'] ?? []);
  if ($showGuides && $guides === []) {
      $guides = [['icon' => '', 'title' => '', 'meta' => '', 'url' => '']];
  }
@endphp
<div class="card mb-3">
  <div class="card-header"><h5>{{ $label }}</h5></div>
  <div class="card-body row g-3">
    <div class="col-md-4">
      <label class="form-label">Eyebrow</label>
      <input class="form-control" name="sections[{{ $key }}][eyebrow]" value="{{ old("sections.{$key}.eyebrow", $section['eyebrow'] ?? '') }}">
    </div>
    <div class="col-md-4">
      <label class="form-label">Title</label>
      <input class="form-control" name="sections[{{ $key }}][title]" value="{{ old("sections.{$key}.title", $section['title'] ?? '') }}">
    </div>
    <div class="col-md-4">
      <label class="form-label">Title (italic / green)</label>
      <input class="form-control" name="sections[{{ $key }}][title_em]" value="{{ old("sections.{$key}.title_em", $section['title_em'] ?? '') }}">
    </div>
    @if ($showSubtitle)
      <div class="col-md-12">
        <label class="form-label">Subtitle</label>
        <textarea class="form-control" name="sections[{{ $key }}][subtitle]" rows="2">{{ old("sections.{$key}.subtitle", $section['subtitle'] ?? '') }}</textarea>
      </div>
    @endif

    @if ($showNewsletter)
      <div class="col-12"><hr class="my-1"><p class="small text-muted mb-0">Newsletter card</p></div>
      <div class="col-md-4">
        <label class="form-label">Newsletter Eyebrow</label>
        <input class="form-control" name="sections[{{ $key }}][newsletter_eyebrow]" value="{{ old("sections.{$key}.newsletter_eyebrow", $section['newsletter_eyebrow'] ?? '') }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Newsletter Title</label>
        <input class="form-control" name="sections[{{ $key }}][newsletter_title]" value="{{ old("sections.{$key}.newsletter_title", $section['newsletter_title'] ?? '') }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Newsletter Button</label>
        <input class="form-control" name="sections[{{ $key }}][newsletter_button]" value="{{ old("sections.{$key}.newsletter_button", $section['newsletter_button'] ?? '') }}">
      </div>
      <div class="col-md-12">
        <label class="form-label">Newsletter Subtitle</label>
        <input class="form-control" name="sections[{{ $key }}][newsletter_subtitle]" value="{{ old("sections.{$key}.newsletter_subtitle", $section['newsletter_subtitle'] ?? '') }}">
      </div>
    @endif

    @if ($showGuides)
      <div class="col-12"><hr class="my-1"><p class="small text-muted mb-0">Guide links</p></div>
      @foreach ($guides as $i => $guide)
        <div class="col-md-2">
          <label class="form-label">Icon {{ $i + 1 }}</label>
          <input class="form-control" name="sections[{{ $key }}][guides][{{ $i }}][icon]" value="{{ old("sections.{$key}.guides.{$i}.icon", $guide['icon'] ?? '') }}">
        </div>
        <div class="col-md-4">
          <label class="form-label">Guide Title {{ $i + 1 }}</label>
          <input class="form-control" name="sections[{{ $key }}][guides][{{ $i }}][title]" value="{{ old("sections.{$key}.guides.{$i}.title", $guide['title'] ?? '') }}">
        </div>
        <div class="col-md-3">
          <label class="form-label">Meta {{ $i + 1 }}</label>
          <input class="form-control" name="sections[{{ $key }}][guides][{{ $i }}][meta]" value="{{ old("sections.{$key}.guides.{$i}.meta", $guide['meta'] ?? '') }}">
        </div>
        <div class="col-md-3">
          <label class="form-label">URL {{ $i + 1 }}</label>
          <input class="form-control" name="sections[{{ $key }}][guides][{{ $i }}][url]" value="{{ old("sections.{$key}.guides.{$i}.url", $guide['url'] ?? '') }}">
        </div>
      @endforeach
    @endif

    @if ($note)
      <div class="col-12"><small class="text-muted">{{ $note }}</small></div>
    @endif
  </div>
</div>
