@php
  $title = $item['title'] ?? '';
@endphp
<div class="card content-repeater-card mb-3" data-repeater-item>
  <div class="card-header d-flex justify-content-between align-items-center py-2">
    <div class="d-flex align-items-center gap-2">
      <span class="content-letter content-rank"></span>
      <strong data-item-title data-empty-label="New hub card">{{ $title !== '' ? $title : 'New hub card' }}</strong>
    </div>
    <button type="button" class="btn btn-outline-danger btn-sm" data-remove-item>Remove</button>
  </div>
  <div class="card-body row g-3">
    <div class="col-md-6">
      <label class="form-label">Title</label>
      <input type="text" class="form-control" name="content[cards][{{ $index }}][title]" value="{{ $title }}" data-title-source placeholder="e.g. FedEx Cup Betting">
    </div>
    <div class="col-md-6">
      <label class="form-label">Link URL</label>
      <input type="text" class="form-control" name="content[cards][{{ $index }}][url]" value="{{ $item['url'] ?? '' }}" placeholder="/blog/why-fedex-cup-betting-odds-change">
    </div>
    <div class="col-md-12">
      <label class="form-label">Description</label>
      <textarea class="form-control" name="content[cards][{{ $index }}][description]" rows="3" placeholder="Short card copy shown on the hub page">{{ $item['description'] ?? '' }}</textarea>
    </div>
  </div>
</div>
