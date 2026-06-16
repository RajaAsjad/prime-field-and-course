@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')@include('layouts.admin.partials.cms-admin-styles')@endpush
<section class="content-header">
	<div class="cms-card">
		<div class="cms-card__header"><h1>{{ $page_title }}</h1><a href="{{ route('process.index') }}" class="cms-btn-primary"><i class="fa fa-arrow-left"></i> Back</a></div>
		<div class="cms-card__body">
			<form action="{{ route('process.store') }}" method="POST" class="cms-form">@csrf
				@include('admin.process._form')
				<button type="submit" class="cms-btn-primary">Save Step</button>
			</form>
		</div>
	</div>
</section>
@endsection
