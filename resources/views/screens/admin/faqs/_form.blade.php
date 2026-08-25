<div class="row g-3">
  <div class="col-md-12"><label class="form-label">Question <span class="text-danger">*</span></label><input type="text" class="form-control" name="question" value="{{ old('question', $faq->question ?? '') }}" required></div>
  <div class="col-md-12"><label class="form-label">Answer <span class="text-danger">*</span></label><textarea class="form-control" name="answer" rows="4" required>{{ old('answer', $faq->answer ?? '') }}</textarea></div>
  <div class="col-md-4"><label class="form-label">Sort Order</label><input type="number" min="0" class="form-control" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}"></div>
  <div class="col-md-4 d-flex align-items-end gap-3 pb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked(old('is_active', $faq->is_active ?? true))><label class="form-check-label">Active</label></div><div class="form-check"><input class="form-check-input" type="checkbox" name="open_by_default" value="1" @checked(old('open_by_default', $faq->open_by_default ?? false))><label class="form-check-label">Open by default</label></div></div>
</div>
