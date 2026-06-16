@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
@include('admin.testimonial.partials.admin-theme')
@endpush

<input type="hidden" id="page_url" value="{{ route('testimonial.index') }}">
<section class="content-header" style="margin-bottom: 0;">
	<div class="tst-card">
		<div class="tst-header">
			<h1>All Testimonials</h1>
		</div>

		<div class="tst-stats">
			<div class="stat-box">
				<div class="num">{{ $totalTestimonials ?? 0 }}</div>
				<div class="lbl">Total Testimonials</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $activeTestimonials ?? 0 }}</div>
				<div class="lbl">Active</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $inactiveTestimonials ?? 0 }}</div>
				<div class="lbl">Inactive</div>
			</div>
			@can('testimonial-create')
			<div class="stat-box" style="display:flex;align-items:center;justify-content:center;">
				<a href="{{ route('testimonial.create') }}" class="tst-btn-primary"><i class="fa fa-plus"></i> Add Testimonial</a>
			</div>
			@endcan
		</div>

		<div class="tst-search">
			<div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
				<input type="text" id="search" class="form-control" placeholder="Search by name..." style="max-width:280px;">
				<select id="status" class="form-control status" name="status" style="max-width:180px;">
					<option value="All" selected>All status</option>
					<option value="1">Active</option>
					<option value="2">In-Active</option>
				</select>
				<button type="button" class="btn tst-btn-primary" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
				@if(request('search') || (request('status') && request('status') != 'All'))
				<a href="{{ route('testimonial.index') }}" class="btn btn-default" style="border-radius:9999px;font-weight:600;"><i class="fa fa-times"></i> Clear</a>
				@endif
			</div>
		</div>

		<div class="tst-body">
			@if (session('status') || session('message'))
			<div class="tst-alert-success">{{ session('message') ?? session('status') }}</div>
			@endif

			<div class="tst-table-wrap">
				<div class="table-responsive p-0">
					<table class="table table-hover tst-table mb-0">
						<thead>
							<tr>
								<th width="50">SL</th>
								<th width="80">Image</th>
								<th>Name</th>
								<th>Comment</th>
								<th width="80">Status</th>
								<th width="180">Action</th>
							</tr>
						</thead>
						<tbody id="body">
							@foreach($testimonials as $key=>$testimonial)
							<tr id="id-{{ $testimonial->slug }}">
								<td>{{ $testimonials->firstItem()+$key }}.</td>
								<td>
									@if($testimonial->image)
									<img src="{{ asset('admin/assets/images/testimonials/'.$testimonial->image) }}" alt="{{ $testimonial->name }}">
									@else
									<img src="{{ asset('admin/assets/images/testimonials/no-photo1.jpg') }}" alt="No Image">
									@endif
								</td>
								<td>{!! $testimonial->name !!}</td>
								<td>{!! \Illuminate\Support\Str::limit(strip_tags($testimonial->comment), 60) !!}</td>
								<td>
									@if($testimonial->status)
									<span class="label label-success">Active</span>
									@else
									<span class="label label-danger">In-Active</span>
									@endif
								</td>
								<td>
									<div style="display:flex;gap:6px;flex-wrap:nowrap;">
										@can('testimonial-edit')
										<a href="{{ route('testimonial.edit', $testimonial->slug) }}" class="btn btn-edit btn-xs"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('testimonial-delete')
										<button type="button" class="btn btn-danger btn-xs btn-delete delete-testimonial" data-slug="{{ $testimonial->slug }}" data-del-url="{{ url('testimonial', $testimonial->slug) }}"><i class="fa fa-trash"></i> Delete</button>
										@endcan
									</div>
								</td>
							</tr>
							@endforeach
							@if($testimonials->hasPages())
							<tr>
								<td colspan="6">
									<div class="d-flex flex-column align-items-center" style="padding:12px 0;">
										<div class="text-muted small mb-2">Displaying {{ $testimonials->firstItem() }} to {{ $testimonials->lastItem() }} of {{ $testimonials->total() }} records</div>
										{!! $testimonials->appends(request()->query())->links('pagination::bootstrap-4') !!}
									</div>
								</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@push('js')
<script>
$(document).ready(function() {
	$('#btn-filter').on('click', function() {
		var pageurl = $('#page_url').val();
		var search = $('#search').val();
		var status = $('#status').val();
		$.get(pageurl + '?page=1&search=' + encodeURIComponent(search) + '&status=' + encodeURIComponent(status), function(response) {
			$('#body').html(response);
		});
	});

	$(document).on('click', '#body .delete-testimonial', function() {
		var slug = $(this).attr('data-slug');
		var delete_url = $(this).attr('data-del-url');
		Swal.fire({
			title: 'Are you sure?',
			text: "This testimonial will be deleted.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#1f7a1f',
			cancelButtonColor: '#6c757d',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
				$.ajax({
					url: delete_url,
					type: 'DELETE',
					success: function(response) {
						if (response) {
							$('#id-' + slug).fadeOut(300, function() { $(this).remove(); });
							Swal.fire('Deleted!', 'Testimonial has been deleted.', 'success');
						} else {
							Swal.fire('Error', 'Something went wrong.', 'error');
						}
					},
					error: function() {
						Swal.fire('Error', 'Failed to delete.', 'error');
					}
				});
			}
		});
	});
});
</script>
@endpush
