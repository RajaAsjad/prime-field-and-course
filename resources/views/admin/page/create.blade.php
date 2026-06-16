@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	@include('layouts.admin.partials.page-admin-theme')

	.page-form-container {
		background: #fff;
		border-radius: 12px;
		box-shadow: 0 4px 24px color-mix(in srgb, var(--pg-pink) 10%, transparent);
		border: 1px solid color-mix(in srgb, var(--pg-pink) 12%, transparent);
		overflow: hidden;
		margin: 20px 0;
	}

	.page-form-body {
		padding: 0 30px 40px;
		background: var(--pg-cream);
	}

	.page-form-container .section-banner {
		background: linear-gradient(135deg, var(--pg-pink) 0%, var(--pg-pink-deep) 45%, var(--pg-orange) 100%) !important;
		padding: 15px 20px;
		margin: 0 -40px 25px -40px;
		border-bottom: 2px solid rgba(190, 24, 93, 0.35);
		box-shadow: 0 4px 20px rgba(236, 72, 153, 0.18);
		display: flex;
		justify-content: center;
		align-items: center;
		position: relative;
	}

	.page-form-container .section-banner h3 {
		margin: 0;
		font-size: 18px;
		font-weight: 600;
		color: #fff;
		letter-spacing: 0.5px;
		text-transform: uppercase;
		text-shadow: 0 1px 2px rgba(0, 0, 0, 0.12);
	}

	.page-form-container .section-banner .btn {
		background: #fff;
		color: var(--pg-pink-deep);
		border: 2px solid rgba(255, 255, 255, 0.95);
		padding: 8px 24px;
		border-radius: 25px;
		font-size: 13px;
		font-weight: 700;
		text-decoration: none;
		transition: all 0.3s ease;
		position: absolute;
		right: 20px;
		display: inline-flex;
		align-items: center;
		gap: 6px;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.12);
	}

	.page-form-container .section-banner .btn:hover {
		background: var(--pg-text);
		color: #fff;
		border-color: var(--pg-text);
		transform: translateY(-2px);
		box-shadow: 0 4px 14px rgba(28, 25, 23, 0.2);
	}

	.page-form-container .section-banner .btn i {
		font-size: 12px;
	}

	.page-form-container .form-group {
		margin-bottom: 25px;
	}

	.page-form-container .form-group label {
		display: block;
		margin-bottom: 8px;
		font-weight: 600;
		color: #374151;
		font-size: 14px;
	}

	.page-form-container .required {
		color: #dc2626;
		margin-left: 3px;
	}

	.page-form-container .form-control {
		border: 1px solid #e7e5e4;
		border-radius: 8px;
		padding: 5px;
		font-size: 14px;
		transition: all 0.3s ease;
	}

	.page-form-container .form-control:focus {
		border-color: rgba(236, 72, 153, 0.55);
		box-shadow: 0 0 0 0.2rem rgba(236, 72, 153, 0.12);
		outline: none;
	}

	.page-form-container .text-danger {
		color: #dc2626;
		font-size: 13px;
		margin-top: 5px;
		display: block;
	}

	.page-form-container .action-section {
		margin-top: 30px;
		padding-top: 20px;
		border-top: 1px solid rgba(236, 72, 153, 0.12);
	}

	.page-form-container .btn-submit {
		background: linear-gradient(135deg, var(--pg-pink) 0%, var(--pg-orange) 100%);
		color: #fff;
		border: none;
		padding: 12px 30px;
		border-radius: 8px;
		font-weight: 600;
		font-size: 14px;
		cursor: pointer;
		transition: all 0.3s ease;
		box-shadow: 0 4px 14px rgba(236, 72, 153, 0.25);
	}

	.page-form-container .btn-submit:hover {
		transform: translateY(-2px);
		background: linear-gradient(135deg, var(--pg-pink-deep) 0%, var(--pg-orange) 100%);
		box-shadow: 0 6px 20px rgba(236, 72, 153, 0.35);
	}

	.page-form-container .btn-submit i {
		margin-right: 8px;
	}
</style>
@endpush

<section class="content page-admin">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('page.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<div class="page-form-container">
					<div class="page-form-body">
						<div class="section-banner">
							<h3>Add Page</h3>
							<a href="{{ route('page.index') }}" class="btn btn-primary btn-sm">
								<i class="fa fa-arrow-left"></i> Back
							</a>
						</div>

						<div class="form-group">
							<label for="title">Page Title <span class="required">*</span></label>
							<input type="text" id="title" autocomplete="off" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter page title" required>
							@error('title')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="description">Description</label>
							<textarea id="description" class="form-control texteditor" name="description" maxlength="255" style="height:140px;" placeholder="Describe page (max 255 characters)">{{ old('description') }}</textarea>
							@error('description')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="action-section">
							<button type="submit" class="btn-submit" name="form1">
								<i class="fa fa-plus"></i> Add Page
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
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

			});
		}

		$("#regform").validate({
			rules: {
				title: "required"
			}
		});
	});
</script>
@endpush
