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
			@can('process-create')
			<a href="{{ route('process.create') }}" class="cms-btn-primary"><i class="fa fa-plus"></i> Add Step</a>
			@endcan
		</div>
		@if(session('message'))
		<div class="cms-card__body" style="padding-bottom:0"><div class="alert alert-success">{{ session('message') }}</div></div>
		@endif
		<div class="cms-card__body">
			<div class="cms-table-wrap">
				<table class="table table-hover cms-table mb-0">
					<thead><tr><th>#</th><th>Step</th><th>Phase</th><th>Title</th><th>Order</th><th>Status</th><th width="120">Action</th></tr></thead>
					<tbody>
						@forelse($steps as $key => $step)
						<tr>
							<td>{{ $steps->firstItem() + $key }}</td>
							<td>{{ $step->step_number }}</td>
							<td>{{ $step->phase_label }}</td>
							<td>{{ $step->title }}</td>
							<td>{{ $step->sort_order }}</td>
							<td><span class="label {{ $step->status ? 'label-success' : 'label-danger' }}">{{ $step->status ? 'Active' : 'Inactive' }}</span></td>
							<td>
								@can('process-edit')<a href="{{ route('process.edit', $step->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>@endcan
								@can('process-delete')
								<form action="{{ route('process.destroy', $step->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this step?')">@csrf @method('DELETE')<button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></form>
								@endcan
							</td>
						</tr>
						@empty
						<tr><td colspan="7" class="text-center text-muted">No process steps yet.</td></tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="mt-3">{{ $steps->links() }}</div>
		</div>
	</div>
</section>
@endsection
