@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')@include('layouts.admin.partials.cms-admin-styles')@endpush
<section class="content-header">
	<div class="cms-card">
		<div class="cms-card__header">
			<h1>{{ $page_title }}</h1>
			@can('portfolio-create')<a href="{{ route('portfolio.create') }}" class="cms-btn-primary"><i class="fa fa-plus"></i> Add Project</a>@endcan
		</div>
		@if(session('message'))<div class="cms-card__body" style="padding-bottom:0"><div class="alert alert-success">{{ session('message') }}</div></div>@endif
		<div class="cms-card__body">
			<div class="cms-table-wrap">
				<table class="table table-hover cms-table mb-0">
					<thead><tr><th>#</th><th>Image</th><th>Category</th><th>Title</th><th>Order</th><th>Status</th><th width="120">Action</th></tr></thead>
					<tbody>
						@forelse($items as $key => $item)
						<tr>
							<td>{{ $items->firstItem() + $key }}</td>
							<td><img src="{{ $item->image_url }}" alt="" width="60" height="40" style="object-fit:cover;border-radius:6px"></td>
							<td>{{ $item->category_label }}</td>
							<td>{{ $item->title }}</td>
							<td>{{ $item->sort_order }}</td>
							<td><span class="label {{ $item->status ? 'label-success' : 'label-danger' }}">{{ $item->status ? 'Active' : 'Inactive' }}</span></td>
							<td>
								@can('portfolio-edit')<a href="{{ route('portfolio.edit', $item->slug) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>@endcan
								@can('portfolio-delete')<form action="{{ route('portfolio.destroy', $item->slug) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></form>@endcan
							</td>
						</tr>
						@empty
						<tr><td colspan="7" class="text-center text-muted">No portfolio items yet.</td></tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="mt-3">{{ $items->links() }}</div>
		</div>
	</div>
</section>
@endsection
