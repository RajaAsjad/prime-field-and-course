@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')@include('layouts.admin.partials.cms-admin-styles')@endpush
<section class="content-header">
	<div class="cms-card">
		<div class="cms-card__header"><h1>{{ $page_title }}</h1><a href="{{ route('process.index') }}" class="cms-btn-primary"><i class="fa fa-arrow-left"></i> Back</a></div>
		<div class="cms-card__body">
			<form action="{{ route('process.update', $step->id) }}" method="POST" class="cms-form">@csrf @method('PUT')
				@include('admin.process._form', ['step' => $step])
				<button type="submit" class="cms-btn-primary">Update Step</button>
			</form>
		</div>
	</div>
</section>
@endsection
