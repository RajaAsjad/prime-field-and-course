@php
  $term = $item['term'] ?? '';
  $letter = strtoupper(substr($term, 0, 1) ?: '?');
@endphp
<div class="card content-repeater-card mb-3" data-repeater-item>
  <div class="card-header d-flex justify-content-between align-items-center py-2">
    <div class="d-flex align-items-center gap-2">
      <span class="content-letter" data-letter-badge>{{ $letter }}</span>
      <strong data-item-title>{{ $term !== '' ? $term : 'New card' }}</strong>
    </div>
    <button type="button" class="btn btn-outline-danger btn-sm" data-remove-item>Remove</button>
  </div>
  <div class="card-body row g-3">
    <div class="col-md-6">
      <label class="form-label">Term</label>
      <input type="text" class="form-control" name="content[terms][{{ $index }}][term]" value="{{ $term }}" data-letter-source placeholder="e.g. Ace">
    </div>
    <div class="col-md-6">
      <label class="form-label">Also known as</label>
      <input type="text" class="form-control" name="content[terms][{{ $index }}][alias]" value="{{ $item['alias'] ?? '' }}" placeholder="e.g. Double Eagle">
    </div>
    <div class="col-md-12">
      <label class="form-label">Definition</label>
      <textarea class="form-control" name="content[terms][{{ $index }}][definition]" rows="2" placeholder="Short explanation shown on the card">{{ $item['definition'] ?? '' }}</textarea>
    </div>
    <div class="col-md-12">
      <label class="form-label">Example</label>
      <input type="text" class="form-control" name="content[terms][{{ $index }}][example]" value="{{ $item['example'] ?? '' }}" placeholder="Optional example line">
    </div>
  </div>
</div>
