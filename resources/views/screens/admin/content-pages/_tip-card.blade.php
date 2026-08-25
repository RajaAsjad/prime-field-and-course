<div class="card content-repeater-card mb-3" data-repeater-item>
  <div class="card-header d-flex justify-content-between align-items-center py-2">
    <strong>{{ ($item['title'] ?? '') !== '' ? $item['title'] : 'New tip' }}</strong>
    <button type="button" class="btn btn-outline-danger btn-sm" data-remove-item>Remove</button>
  </div>
  <div class="card-body row g-3">
    <div class="col-md-12">
      <label class="form-label">Title</label>
      <input type="text" class="form-control" name="content[tips][{{ $index }}][title]" value="{{ $item['title'] ?? '' }}">
    </div>
    <div class="col-md-12">
      <label class="form-label">Text</label>
      <textarea class="form-control" name="content[tips][{{ $index }}][text]" rows="2">{{ $item['text'] ?? '' }}</textarea>
    </div>
  </div>
</div>
