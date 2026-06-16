@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
@include('layouts.admin.partials.cms-admin-styles')
@endpush

<section class="content-header">
	<div class="cms-card">
		<div class="cms-card__header">
			<h1>{{ $page_title }}</h1>
			<a href="{{ route('service.index') }}" class="cms-btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
		</div>
		<div class="cms-card__body">
			<form action="{{ route('service.update', $service->slug) }}" method="POST" enctype="multipart/form-data" class="cms-form">
				@csrf @method('PUT')
				@include('admin.service._form', ['service' => $service])
				<button type="submit" class="cms-btn-primary">Update Service</button>
			</form>
		</div>
	</div>
</section>
@endsection
