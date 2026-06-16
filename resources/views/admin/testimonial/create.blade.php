@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
@include('admin.testimonial.partials.admin-theme')
@endpush

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('testimonial.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<div class="tst-form-container">
					<div class="tst-form-body">
						<div class="tst-form-banner">
							<h3>Add Testimonial</h3>
							<a href="{{ route('testimonial.index') }}" class="btn-back">
								<i class="fa fa-arrow-left"></i> Back
							</a>
						</div>

						<div class="form-group">
							<label for="image">Image <span class="required">*</span></label>
							<input type="file" name="image" class="form-control" accept="image/*" id="image">
							@error('image')
								<span class="text-danger">{{ $message }}</span>
							@enderror
							<div class="image-preview-section">
								<img id="banner_preview" src="{{ asset('admin/assets/images/default.jpg') }}" alt="Image Preview">
							</div>
						</div>

						<div class="form-group">
							<label for="name">Name <span class="required">*</span></label>
							<input type="text" id="name" autocomplete="off" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter name">
							@error('name')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="designation">Designation</label>
							<input type="text" id="designation" autocomplete="off" class="form-control" name="designation" value="{{ old('designation') }}" placeholder="e.g. General Manager — Ridgeview Country Club">
							@error('designation')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="comment">Comment <span class="required">*</span></label>
							<textarea id="comment" class="form-control texteditor" name="comment" style="height:200px;" placeholder="Enter testimonial quote">{{ old('comment') }}</textarea>
							@error('comment')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="action-section">
							<button type="submit" class="btn-submit" name="form1">
								<i class="fa fa-plus"></i> Add Testimonial
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
				image: "required",
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
