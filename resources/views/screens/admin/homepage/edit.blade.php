@extends('layouts.admin.master')
@section('title', 'Homepage')
@section('content')
@php
  $h = $homepage;
  $heroHeadline = \App\Support\HomepageDefaults::parseHighlightedHtml($h['hero']['headline_html'] ?? '');
  $premiumTitle = \App\Support\HomepageDefaults::parseHighlightedHtml($h['premium']['title_html'] ?? '');
  $premiumFormTitle = \App\Support\HomepageDefaults::parseHighlightedHtml($h['premium']['form_title_html'] ?? '');
@endphp
<style>
  .hero-image-preview {
    max-height: 180px;
    width: 100%;
    max-width: 480px;
    object-fit: cover;
    display: block;
  }
</style>
<div class="container-fluid">
  @include('screens.admin.partials.alerts')
  <form method="POST" action="{{ route('admin.homepage.update') }}" enctype="multipart/form-data">@csrf @method('PUT')
    <div class="card mb-3">
      <div class="card-header"><h5>Page Title &amp; SEO</h5></div>
      <div class="card-body row g-3">
        <div class="col-md-12">
          <label class="form-label" for="seo_meta_title">Page Title</label>
          <input
            class="form-control @error('seo.meta_title') is-invalid @enderror"
            id="seo_meta_title"
            name="seo[meta_title]"
            value="{{ old('seo.meta_title', $h['seo']['meta_title'] ?? '') }}"
            placeholder="e.g. Online Golf Betting | Picks & Live Odds | Pinshot"
          >
          <small class="text-muted">Browser tab and Google results title for the homepage.</small>
          @error('seo.meta_title')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-md-12">
          <label class="form-label" for="seo_meta_description">Meta Description</label>
          <textarea
            class="form-control @error('seo.meta_description') is-invalid @enderror"
            id="seo_meta_description"
            name="seo[meta_description]"
            rows="2"
            placeholder="Short summary for search engines"
          >{{ old('seo.meta_description', $h['seo']['meta_description'] ?? '') }}</textarea>
          @error('seo.meta_description')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>

    <div class="card mb-3"><div class="card-header"><h5>Hero Section</h5></div><div class="card-body row g-3">
      <div class="col-md-4">
        <label class="form-label" for="headline_before">Headline</label>
        <input class="form-control" id="headline_before" name="hero[headline_before]" value="{{ old('hero.headline_before', $heroHeadline['before']) }}" placeholder="Golf Betting">
      </div>
      <div class="col-md-4">
        <label class="form-label" for="headline_highlight">Gold Highlight</label>
        <input class="form-control" id="headline_highlight" name="hero[headline_highlight]" value="{{ old('hero.headline_highlight', $heroHeadline['highlight']) }}" placeholder="Made Simple.">
        <small class="text-muted">Shown in gold on the homepage.</small>
      </div>
      <div class="col-md-4">
        <label class="form-label" for="headline_after">Headline (after gold)</label>
        <input class="form-control" id="headline_after" name="hero[headline_after]" value="{{ old('hero.headline_after', $heroHeadline['after']) }}" placeholder="Expert Picks & Exclusive Deals.">
      </div>
      <div class="col-md-12"><label class="form-label">Subtitle</label><input class="form-control" name="hero[subtitle]" value="{{ old('hero.subtitle', $h['hero']['subtitle'] ?? '') }}"></div>
      <div class="col-md-12">
        <label class="form-label" for="hero_image">Hero Background Image</label>
        @if (!empty($h['hero']['image_url']))
          <div class="mb-2">
            <p class="small text-muted mb-1">Current background</p>
            <img src="{{ $h['hero']['image_url'] }}" alt="Current hero background" class="img-thumbnail hero-image-preview" id="current-hero-image">
          </div>
        @endif
        <input
          type="file"
          class="form-control @error('hero_image') is-invalid @enderror"
          id="hero_image"
          name="hero_image"
          accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
          data-preview="preview-hero-image"
        />
        <small class="text-muted">JPG, PNG or WEBP. Max 5MB. This image shows behind the hero banner on the homepage.</small>
        <img src="#" alt="" class="img-thumbnail hero-image-preview mt-2 d-none" id="preview-hero-image">
        @error('hero_image')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-6"><label class="form-label">Primary CTA Label</label><input class="form-control" name="hero[cta_primary][label]" value="{{ old('hero.cta_primary.label', $h['hero']['cta_primary']['label'] ?? '') }}"></div>
      <div class="col-md-6"><label class="form-label">Primary CTA URL</label><input class="form-control" name="hero[cta_primary][url]" value="{{ old('hero.cta_primary.url', $h['hero']['cta_primary']['url'] ?? '') }}"></div>
      <div class="col-md-6"><label class="form-label">Secondary CTA Label</label><input class="form-control" name="hero[cta_secondary][label]" value="{{ old('hero.cta_secondary.label', $h['hero']['cta_secondary']['label'] ?? '') }}"></div>
      <div class="col-md-6"><label class="form-label">Secondary CTA URL</label><input class="form-control" name="hero[cta_secondary][url]" value="{{ old('hero.cta_secondary.url', $h['hero']['cta_secondary']['url'] ?? '') }}"></div>
      <div class="col-md-12"><label class="form-label">Disclaimer</label><input class="form-control" name="hero[disclaimer]" value="{{ old('hero.disclaimer', $h['hero']['disclaimer'] ?? '') }}"></div>
    </div></div>

    <div class="card mb-3"><div class="card-header"><h5>Header CTAs</h5></div><div class="card-body row g-3">
      <div class="col-md-6"><label class="form-label">Primary Button Label</label><input class="form-control" name="header_ctas[primary][label]" value="{{ old('header_ctas.primary.label', $h['header_ctas']['primary']['label'] ?? '') }}"></div>
      <div class="col-md-6"><label class="form-label">Primary Button URL</label><input class="form-control" name="header_ctas[primary][url]" value="{{ old('header_ctas.primary.url', $h['header_ctas']['primary']['url'] ?? '') }}"></div>
      <div class="col-md-6"><label class="form-label">Secondary Button Label</label><input class="form-control" name="header_ctas[secondary][label]" value="{{ old('header_ctas.secondary.label', $h['header_ctas']['secondary']['label'] ?? '') }}"></div>
      <div class="col-md-6"><label class="form-label">Secondary Button URL</label><input class="form-control" name="header_ctas[secondary][url]" value="{{ old('header_ctas.secondary.url', $h['header_ctas']['secondary']['url'] ?? '') }}"></div>
    </div></div>

    <div class="card mb-3">
      <div class="card-header"><h5>Affiliate Offer Banners</h5></div>
      <div class="card-body">
        <p class="mb-2">Create multiple offer banners and choose which homepage sections or pages they appear on.</p>
        <a href="{{ route('admin.affiliate-banners.index') }}" class="btn btn-primary btn-sm">Manage Offer Banners</a>
      </div>
    </div>

    @include('screens.admin.homepage._section-fields', [
      'key' => 'strategy',
      'label' => 'Strategy / Tips Section',
      'note' => 'Story cards still load from Field Level Media.',
    ])
    @include('screens.admin.homepage._section-fields', [
      'key' => 'promos',
      'label' => 'Promos Section',
      'note' => 'Promo cards are managed under Promos in the sidebar.',
    ])
    @include('screens.admin.homepage._section-fields', [
      'key' => 'best_picks',
      'label' => 'Best Picks Section',
      'note' => 'Pick cards still load from SportsDataIO odds.',
    ])
    @include('screens.admin.homepage._section-fields', [
      'key' => 'hot_props',
      'label' => 'Hot Props Section',
      'note' => 'Odds table still loads from SportsDataIO. Auto-refresh seconds are appended automatically.',
    ])
    @include('screens.admin.homepage._section-fields', [
      'key' => 'competition_feeds',
      'label' => 'Competition / Rankings Section',
      'note' => 'Rankings, players, and schedule still load from SportsDataIO.',
    ])
    @include('screens.admin.homepage._section-fields', [
      'key' => 'live_odds',
      'label' => 'Live Odds Section',
      'note' => 'Odds table still loads from SportsDataIO. Auto-refresh seconds are appended automatically.',
    ])
    @include('screens.admin.homepage._section-fields', [
      'key' => 'rotoballer_news',
      'label' => 'RotoBaller News Section',
      'note' => 'News cards still load from RotoBaller. Auto-refresh seconds are appended automatically.',
    ])
    @include('screens.admin.homepage._section-fields', [
      'key' => 'golf_betting',
      'label' => 'Golf Betting Guides Section',
      'showGuides' => true,
      'showNewsletter' => true,
    ])
    @include('screens.admin.homepage._section-fields', [
      'key' => 'tournaments',
      'label' => 'Tournaments Section',
      'note' => 'Tournament cards still load from SportsDataIO schedule.',
    ])

    <div class="card mb-3"><div class="card-header"><h5>Premium / CTA Section</h5></div><div class="card-body row g-3">
      <div class="col-md-4">
        <label class="form-label">Title</label>
        <input class="form-control" name="premium[title_before]" value="{{ old('premium.title_before', $premiumTitle['before']) }}" placeholder="Unlock">
      </div>
      <div class="col-md-4">
        <label class="form-label">Gold Highlight</label>
        <input class="form-control" name="premium[title_highlight]" value="{{ old('premium.title_highlight', $premiumTitle['highlight']) }}" placeholder="Insider">
      </div>
      <div class="col-md-4">
        <label class="form-label">Title (after gold)</label>
        <input class="form-control" name="premium[title_after]" value="{{ old('premium.title_after', $premiumTitle['after']) }}" placeholder="Information">
      </div>
      <div class="col-md-12"><label class="form-label">Subtitle</label><textarea class="form-control" name="premium[subtitle]" rows="2">{{ old('premium.subtitle', $h['premium']['subtitle'] ?? '') }}</textarea></div>
      <div class="col-md-4"><label class="form-label">Price</label><input class="form-control" name="premium[price]" value="{{ old('premium.price', $h['premium']['price'] ?? '') }}"></div>
      <div class="col-md-4"><label class="form-label">Price Unit</label><input class="form-control" name="premium[price_unit]" value="{{ old('premium.price_unit', $h['premium']['price_unit'] ?? '') }}"></div>
      @foreach(($h['premium']['features'] ?? ['','','']) as $i => $feature)
        <div class="col-md-12"><label class="form-label">Feature {{ $i + 1 }}</label><input class="form-control" name="premium[features][]" value="{{ old('premium.features.'.$i, $feature) }}"></div>
      @endforeach
      <div class="col-md-4">
        <label class="form-label">Form Title</label>
        <input class="form-control" name="premium[form_title_before]" value="{{ old('premium.form_title_before', $premiumFormTitle['before']) }}" placeholder="Start Your">
      </div>
      <div class="col-md-4">
        <label class="form-label">Gold Highlight</label>
        <input class="form-control" name="premium[form_title_highlight]" value="{{ old('premium.form_title_highlight', $premiumFormTitle['highlight']) }}" placeholder="Free Trial">
      </div>
      <div class="col-md-4">
        <label class="form-label">Form Title (after gold)</label>
        <input class="form-control" name="premium[form_title_after]" value="{{ old('premium.form_title_after', $premiumFormTitle['after']) }}">
      </div>
      <div class="col-md-12"><label class="form-label">Form Note</label><input class="form-control" name="premium[form_note]" value="{{ old('premium.form_note', $h['premium']['form_note'] ?? '') }}"></div>
    </div></div>

    <div class="card mb-3"><div class="card-header"><h5>FAQ Section Headings</h5></div><div class="card-body row g-3">
      <div class="col-md-4"><label class="form-label">Eyebrow</label><input class="form-control" name="sections[faq][eyebrow]" value="{{ old('sections.faq.eyebrow', $h['sections']['faq']['eyebrow'] ?? '') }}"></div>
      <div class="col-md-4"><label class="form-label">Title</label><input class="form-control" name="sections[faq][title]" value="{{ old('sections.faq.title', $h['sections']['faq']['title'] ?? '') }}"></div>
      <div class="col-md-4"><label class="form-label">Title (italic / green)</label><input class="form-control" name="sections[faq][title_em]" value="{{ old('sections.faq.title_em', $h['sections']['faq']['title_em'] ?? '') }}"></div>
      <div class="col-12"><small class="text-muted">FAQ answers are managed under Website Content → FAQs.</small></div>
    </div></div>

    <div class="card mb-3"><div class="card-header"><h5>Testimonials</h5></div><div class="card-body row g-3">
      @foreach(($h['testimonials'] ?? []) as $i => $testimonial)
        <div class="col-md-12"><label class="form-label">Quote {{ $i + 1 }}</label><textarea class="form-control" name="testimonials[{{ $i }}][quote]" rows="2">{{ old('testimonials.'.$i.'.quote', $testimonial['quote'] ?? '') }}</textarea></div>
        <div class="col-md-6"><label class="form-label">Author {{ $i + 1 }}</label><input class="form-control" name="testimonials[{{ $i }}][author]" value="{{ old('testimonials.'.$i.'.author', $testimonial['author'] ?? '') }}"></div>
        <div class="col-md-6"><label class="form-label">Stars</label><input type="number" min="1" max="5" class="form-control" name="testimonials[{{ $i }}][stars]" value="{{ old('testimonials.'.$i.'.stars', $testimonial['stars'] ?? 5) }}"></div>
      @endforeach
    </div></div>

    <button class="btn btn-primary">Save Homepage</button>
  </form>
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
@endsection
