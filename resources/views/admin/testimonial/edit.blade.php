@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
@include('admin.testimonial.partials.admin-theme')
@endpush

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('testimonial.update', $testimonial->slug) }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="tst-form-container">
					<div class="tst-form-body">
						<div class="tst-form-banner">
							<h3>Edit Testimonial</h3>
							<a href="{{ route('testimonial.index') }}" class="btn-back">
								<i class="fa fa-arrow-left"></i> Back
							</a>
						</div>

						<div class="form-group">
							<label for="image">Replace Image <span class="text-muted">(optional)</span></label>
							<input type="file" name="image" accept="image/*" id="image" class="form-control">
							@if($testimonial->image)
								<p class="current-file mb-0">Current image: <strong>{{ $testimonial->image }}</strong></p>
							@endif
							@error('image')
								<span class="text-danger">{{ $message }}</span>
							@enderror
							<div class="image-preview-section">
								<img id="banner_preview" src="{{ $testimonial->image_url }}" alt="Testimonial Image">
							</div>
						</div>

						<div class="form-group">
							<label for="name">Name <span class="required">*</span></label>
							<input type="text" id="name" autocomplete="off" class="form-control" name="name" value="{{ old('name', $testimonial->name) }}" placeholder="Enter name">
							@error('name')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="designation">Designation</label>
							<input type="text" id="designation" autocomplete="off" class="form-control" name="designation" value="{{ old('designation', $testimonial->designation) }}" placeholder="e.g. General Manager — Ridgeview Country Club">
							@error('designation')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="comment">Comment <span class="required">*</span></label>
							<textarea id="comment" class="form-control texteditor" name="comment" style="height:200px;" placeholder="Enter testimonial quote">{{ old('comment', $testimonial->comment) }}</textarea>
							@error('comment')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="status">Status</label>
							<select name="status" id="status" class="form-control">
								<option value="1" {{ ($testimonial->status == 1 || $testimonial->status === '1') ? 'selected' : '' }}>Active</option>
								<option value="0" {{ ($testimonial->status == 0 || $testimonial->status === '0') ? 'selected' : '' }}>Inactive</option>
							</select>
						</div>

						<div class="action-section">
							<button type="submit" class="btn-submit">
								<i class="fa fa-save"></i> Update Testimonial
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection

@push('js')
<script>
	$(document).ready(function() {
		if ($(".texteditor").length > 0) {
			tinymce.init({
				selector: "textarea.texteditor",
				theme: "modern",
				height: 150,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality emoticons template paste textcolor"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
			});
		}

		$("#regform").validate({
			rules: {
				name: "required",
				comment: "required",
			},
			errorClass: "error",
			validClass: "valid",
			errorElement: "span",
			errorPlacement: function(error, element) {
				error.addClass("text-danger");
				error.insertAfter(element);
			}
		});

		image.onchange = evt => {
			const [file] = image.files
			if (file) {
				banner_preview.src = URL.createObjectURL(file)
			}
		}
	});
</script>
@endpush
