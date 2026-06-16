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
			@can('service-create')
			<a href="{{ route('service.create') }}" class="cms-btn-primary"><i class="fa fa-plus"></i> Add Service</a>
			@endcan
		</div>
		@if(session('message'))
		<div class="cms-card__body" style="padding-bottom:0">
			<div class="alert alert-success">{{ session('message') }}</div>
		</div>
		@endif
		<div class="cms-card__body">
			<div class="cms-table-wrap">
				<table class="table table-hover cms-table mb-0">
					<thead>
						<tr>
							<th>#</th>
							<th>Image</th>
							<th>Tag</th>
							<th>Title</th>
							<th>Order</th>
							<th>Status</th>
							<th width="140">Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse($services as $key => $service)
						<tr>
							<td>{{ $services->firstItem() + $key }}</td>
							<td><img src="{{ $service->image_url }}" alt="" width="60" height="40" style="object-fit:cover;border-radius:6px"></td>
							<td>{{ $service->tag }}</td>
							<td>{{ $service->title }}</td>
							<td>{{ $service->sort_order }}</td>
							<td><span class="label {{ $service->status ? 'label-success' : 'label-danger' }}">{{ $service->status ? 'Active' : 'Inactive' }}</span></td>
							<td>
								@can('service-edit')
								<a href="{{ route('service.edit', $service->slug) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
								@endcan
								@can('service-delete')
								<form action="{{ route('service.destroy', $service->slug) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this service?')">
									@csrf @method('DELETE')
									<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
								</form>
								@endcan
							</td>
						</tr>
						@empty
						<tr><td colspan="7" class="text-center text-muted">No services yet.</td></tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="mt-3">{{ $services->links() }}</div>
		</div>
	</div>
</section>
@endsection
