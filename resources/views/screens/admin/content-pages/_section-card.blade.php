<div class="card content-repeater-card mb-3" data-repeater-item>
  <div class="card-header d-flex justify-content-between align-items-center py-2">
    <div class="d-flex align-items-center gap-2">
      <span class="content-letter content-rank" aria-hidden="true"></span>
      <strong data-item-title data-empty-label="New section">{{ ($item['title'] ?? '') !== '' ? $item['title'] : 'New section' }}</strong>
    </div>
    <button type="button" class="btn btn-outline-danger btn-sm" data-remove-item>Remove</button>
  </div>
  <div class="card-body row g-3">
    <div class="col-md-8">
      <label class="form-label">Title</label>
      <input type="text" class="form-control" name="content[sections][{{ $index }}][title]" value="{{ $item['title'] ?? '' }}" data-title-source placeholder="e.g. Types of Golf Bets">
    </div>
    <div class="col-md-4">
      <label class="form-label">Anchor ID</label>
      <input type="text" class="form-control" name="content[sections][{{ $index }}][id]" value="{{ $item['id'] ?? '' }}" placeholder="auto from title">
    </div>
    <div class="col-md-12">
      <label class="form-label">Intro paragraph</label>
      <textarea class="form-control" name="content[sections][{{ $index }}][content]" rows="2" placeholder="Optional lead paragraph">{{ $item['content'] ?? '' }}</textarea>
    </div>
    <div class="col-md-12">
      <label class="form-label">Paragraphs</label>
      @php $paragraphs = array_values(array_filter($item['paragraphs'] ?? [])); if ($paragraphs === []) { $paragraphs = ['']; } @endphp
      <div data-repeater data-next-index="{{ count($paragraphs) }}">
        <div data-repeater-items>
          @foreach ($paragraphs as $paragraph)
            <div class="mb-2" data-repeater-item>
              <div class="input-group">
                <textarea class="form-control" name="content[sections][{{ $index }}][paragraphs][]" rows="2" placeholder="One paragraph">{{ $paragraph }}</textarea>
                <button type="button" class="btn btn-outline-danger" data-remove-item>Remove</button>
              </div>
            </div>
          @endforeach
        </div>
        <template data-repeater-template>
          <div class="mb-2" data-repeater-item>
            <div class="input-group">
              <textarea class="form-control" name="content[sections][{{ $index }}][paragraphs][]" rows="2" placeholder="One paragraph"></textarea>
              <button type="button" class="btn btn-outline-danger" data-remove-item>Remove</button>
            </div>
          </div>
        </template>
        <button type="button" class="btn btn-outline-primary btn-sm" data-add-item>+ Add Paragraph</button>
      </div>
    </div>
    <div class="col-md-12">
      <label class="form-label">List items</label>
      @php $list = array_values(array_filter($item['list'] ?? [])); if ($list === []) { $list = ['']; } @endphp
      <div data-repeater data-next-index="{{ count($list) }}">
        <div data-repeater-items>
          @foreach ($list as $line)
            <div class="input-group mb-2" data-repeater-item>
              <input type="text" class="form-control" name="content[sections][{{ $index }}][list][]" value="{{ $line }}" placeholder="e.g. Outright winner">
              <button type="button" class="btn btn-outline-danger" data-remove-item>Remove</button>
            </div>
          @endforeach
        </div>
        <template data-repeater-template>
          <div class="input-group mb-2" data-repeater-item>
            <input type="text" class="form-control" name="content[sections][{{ $index }}][list][]" value="" placeholder="e.g. Outright winner">
            <button type="button" class="btn btn-outline-danger" data-remove-item>Remove</button>
          </div>
        </template>
        <button type="button" class="btn btn-outline-primary btn-sm" data-add-item>+ Add List Item</button>
      </div>
    </div>
  </div>
</div>
