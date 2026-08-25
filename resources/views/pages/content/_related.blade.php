@if (!empty($relatedPages))
  <div class="content-related rev">
    <h2>More guides</h2>
    <div class="content-related-grid">
      @foreach ($relatedPages as $related)
        <a href="{{ $related['url'] }}" class="content-related-card">
          <span class="content-related-eyebrow">{{ $related['eyebrow'] }}</span>
          <h3>{{ $related['title'] }}</h3>
          <p>{{ \Illuminate\Support\Str::limit($related['description'], 120) }}</p>
        </a>
      @endforeach
    </div>
  </div>
@endif
