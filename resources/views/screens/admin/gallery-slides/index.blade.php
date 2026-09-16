@extends('layouts.admin.master')
@section('title', 'Gallery Slider')
@section('content')
<div class="container-fluid">
  @include('screens.admin.partials.alerts')
  <div class="card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
      <h5 class="mb-0">Gallery Slider</h5>
      <a href="{{ route('admin.gallery-slides.create') }}" class="btn btn-primary btn-sm">Add Image</a>
    </div>
    <div class="card-body">
      <form method="GET" action="{{ route('admin.gallery-slides.index') }}" class="row g-2 mb-3">
        <div class="col-md-6 col-lg-4">
          <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ $search }}" />
        </div>
        <div class="col-auto"><button type="submit" class="btn btn-primary btn-sm">Search</button></div>
        @if ($search !== '')
          <div class="col-auto"><a href="{{ route('admin.gallery-slides.index') }}" class="btn btn-light btn-sm">Clear</a></div>
        @endif
      </form>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Image</th>
              <th>Title</th>
              <th>Link</th>
              <th>Order</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($slides as $slide)
              <tr>
                <td>
                  @if ($slide->imageUrl())
                    <img src="{{ $slide->imageUrl() }}" alt="{{ $slide->title ?: 'Slide' }}" style="height:72px;width:120px;object-fit:contain;border-radius:8px;background:#f3f5f3;">
                  @else
                    —
                  @endif
                </td>
                <td>{{ $slide->title ?: '—' }}</td>
                <td class="text-truncate" style="max-width:220px;">{{ $slide->link_url ?: '—' }}</td>
                <td>{{ $slide->sort_order }}</td>
                <td>{{ $slide->is_active ? 'Active' : 'Hidden' }}</td>
                <td class="d-flex gap-2">
                  <a href="{{ route('admin.gallery-slides.edit', $slide) }}" class="btn btn-primary btn-sm">Edit</a>
                  <form method="POST" action="{{ route('admin.gallery-slides.destroy', $slide) }}" onsubmit="return confirm('Delete this slide?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="text-center text-muted">No gallery images yet. Add slides to show the homepage slider.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      @if ($slides->hasPages())
        {{ $slides->links() }}
      @endif
    </div>
  </div>
</div>
@endsection
