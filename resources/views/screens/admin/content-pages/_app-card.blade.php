<div class="card content-repeater-card mb-3" data-repeater-item>
  <div class="card-header d-flex justify-content-between align-items-center py-2">
    <div class="d-flex align-items-center gap-2">
      <span class="content-letter content-rank" aria-hidden="true"></span>
      <strong data-item-title data-empty-label="New app">{{ ($item['name'] ?? '') !== '' ? $item['name'] : 'New app' }}</strong>
    </div>
    <button type="button" class="btn btn-outline-danger btn-sm" data-remove-item>Remove</button>
  </div>
  <div class="card-body row g-3">
    <div class="col-md-6">
      <label class="form-label">Name</label>
      <input type="text" class="form-control" name="content[apps][{{ $index }}][name]" value="{{ $item['name'] ?? '' }}" data-title-source placeholder="e.g. FanDuel">
    </div>
    <div class="col-md-6">
      <label class="form-label">Tagline</label>
      <input type="text" class="form-control" name="content[apps][{{ $index }}][tagline]" value="{{ $item['tagline'] ?? '' }}" placeholder="Short line under the name">
    </div>
    <div class="col-md-12">
      <label class="form-label">Description</label>
      <textarea class="form-control" name="content[apps][{{ $index }}][description]" rows="3" placeholder="Shown on the app card">{{ $item['description'] ?? '' }}</textarea>
    </div>
    <div class="col-md-6">
      <label class="form-label">Pros</label>
      @php $pros = array_values(array_filter($item['pros'] ?? [])); if ($pros === []) { $pros = ['']; } @endphp
      <div data-repeater data-next-index="{{ count($pros) }}">
        <div data-repeater-items>
          @foreach ($pros as $pro)
            <div class="input-group mb-2" data-repeater-item>
              <input type="text" class="form-control" name="content[apps][{{ $index }}][pros][]" value="{{ $pro }}" placeholder="e.g. Clean design">
              <button type="button" class="btn btn-outline-danger" data-remove-item>Remove</button>
            </div>
          @endforeach
        </div>
        <template data-repeater-template>
          <div class="input-group mb-2" data-repeater-item>
            <input type="text" class="form-control" name="content[apps][{{ $index }}][pros][]" value="" placeholder="e.g. Clean design">
            <button type="button" class="btn btn-outline-danger" data-remove-item>Remove</button>
          </div>
        </template>
        <button type="button" class="btn btn-outline-primary btn-sm" data-add-item>+ Add Pro</button>
      </div>
    </div>
    <div class="col-md-6">
      <label class="form-label">Cons</label>
      @php $cons = array_values(array_filter($item['cons'] ?? [])); if ($cons === []) { $cons = ['']; } @endphp
      <div data-repeater data-next-index="{{ count($cons) }}">
        <div data-repeater-items>
          @foreach ($cons as $con)
            <div class="input-group mb-2" data-repeater-item>
              <input type="text" class="form-control" name="content[apps][{{ $index }}][cons][]" value="{{ $con }}" placeholder="e.g. Busy for first-timers">
              <button type="button" class="btn btn-outline-danger" data-remove-item>Remove</button>
            </div>
          @endforeach
        </div>
        <template data-repeater-template>
          <div class="input-group mb-2" data-repeater-item>
            <input type="text" class="form-control" name="content[apps][{{ $index }}][cons][]" value="" placeholder="e.g. Busy for first-timers">
            <button type="button" class="btn btn-outline-danger" data-remove-item>Remove</button>
          </div>
        </template>
        <button type="button" class="btn btn-outline-primary btn-sm" data-add-item>+ Add Con</button>
      </div>
    </div>
    <div class="col-md-12">
      <label class="form-label">Pro Tip</label>
      <input type="text" class="form-control" name="content[apps][{{ $index }}][tip]" value="{{ $item['tip'] ?? '' }}" placeholder="Shown in the tip banner on the card">
    </div>
  </div>
</div>
