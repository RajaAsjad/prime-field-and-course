@extends('layouts.admin.master')
@section('title', 'Homepage Settings')
@section('content')
@php $h = $homepage; @endphp
<div class="container-fluid">
  @include('screens.admin.partials.alerts')
  <form method="POST" action="{{ route('admin.homepage.update') }}">@csrf @method('PUT')
    <div class="card mb-3"><div class="card-header"><h5>Hero Section</h5></div><div class="card-body row g-3">
      <div class="col-md-12"><label class="form-label">Headline HTML</label><textarea class="form-control" name="hero[headline_html]" rows="2">{{ old('hero.headline_html', $h['hero']['headline_html'] ?? '') }}</textarea></div>
      <div class="col-md-12"><label class="form-label">Subtitle</label><input class="form-control" name="hero[subtitle]" value="{{ old('hero.subtitle', $h['hero']['subtitle'] ?? '') }}"></div>
      <div class="col-md-12"><label class="form-label">Background Image URL</label><input class="form-control" name="hero[image_url]" value="{{ old('hero.image_url', $h['hero']['image_url'] ?? '') }}"></div>
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

    <div class="card mb-3"><div class="card-header"><h5>Promos Section Headings</h5></div><div class="card-body row g-3">
      <div class="col-md-4"><label class="form-label">Eyebrow</label><input class="form-control" name="sections[promos][eyebrow]" value="{{ old('sections.promos.eyebrow', $h['sections']['promos']['eyebrow'] ?? '') }}"></div>
      <div class="col-md-4"><label class="form-label">Title</label><input class="form-control" name="sections[promos][title]" value="{{ old('sections.promos.title', $h['sections']['promos']['title'] ?? '') }}"></div>
      <div class="col-md-12"><label class="form-label">Subtitle</label><textarea class="form-control" name="sections[promos][subtitle]" rows="2">{{ old('sections.promos.subtitle', $h['sections']['promos']['subtitle'] ?? '') }}</textarea></div>
    </div></div>

    <div class="card mb-3"><div class="card-header"><h5>Premium / CTA Section</h5></div><div class="card-body row g-3">
      <div class="col-md-12"><label class="form-label">Title HTML</label><textarea class="form-control" name="premium[title_html]" rows="2">{{ old('premium.title_html', $h['premium']['title_html'] ?? '') }}</textarea></div>
      <div class="col-md-12"><label class="form-label">Subtitle</label><textarea class="form-control" name="premium[subtitle]" rows="2">{{ old('premium.subtitle', $h['premium']['subtitle'] ?? '') }}</textarea></div>
      <div class="col-md-4"><label class="form-label">Price</label><input class="form-control" name="premium[price]" value="{{ old('premium.price', $h['premium']['price'] ?? '') }}"></div>
      <div class="col-md-4"><label class="form-label">Price Unit</label><input class="form-control" name="premium[price_unit]" value="{{ old('premium.price_unit', $h['premium']['price_unit'] ?? '') }}"></div>
      @foreach(($h['premium']['features'] ?? ['','','']) as $i => $feature)
        <div class="col-md-12"><label class="form-label">Feature {{ $i + 1 }}</label><input class="form-control" name="premium[features][]" value="{{ old('premium.features.'.$i, $feature) }}"></div>
      @endforeach
      <div class="col-md-12"><label class="form-label">Form Title HTML</label><textarea class="form-control" name="premium[form_title_html]" rows="2">{{ old('premium.form_title_html', $h['premium']['form_title_html'] ?? '') }}</textarea></div>
      <div class="col-md-12"><label class="form-label">Form Note</label><input class="form-control" name="premium[form_note]" value="{{ old('premium.form_note', $h['premium']['form_note'] ?? '') }}"></div>
    </div></div>

    <div class="card mb-3"><div class="card-header"><h5>FAQ Section Headings</h5></div><div class="card-body row g-3">
      <div class="col-md-6"><label class="form-label">Eyebrow</label><input class="form-control" name="sections[faq][eyebrow]" value="{{ old('sections.faq.eyebrow', $h['sections']['faq']['eyebrow'] ?? '') }}"></div>
      <div class="col-md-6"><label class="form-label">Title</label><input class="form-control" name="sections[faq][title]" value="{{ old('sections.faq.title', $h['sections']['faq']['title'] ?? '') }}"></div>
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
@endsection
