@extends('layouts.admin.master')
@section('title', 'Offer Banners')
@section('content')
<div class="container-fluid">
  @include('screens.admin.partials.alerts')
  <div class="card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
      <h5 class="mb-0">Offer Banners</h5>
      <a href="{{ route('admin.affiliate-banners.create') }}" class="btn btn-primary btn-sm">Add Banner</a>
    </div>
    <div class="card-body">
      <form method="GET" action="{{ route('admin.affiliate-banners.index') }}" class="row g-2 mb-3">
        <div class="col-md-6 col-lg-4">
          <input type="text" name="search" class="form-control" placeholder="Search by brand or headline..." value="{{ $search }}" />
        </div>
        <div class="col-auto"><button type="submit" class="btn btn-primary btn-sm">Search</button></div>
        @if ($search !== '')
          <div class="col-auto"><a href="{{ route('admin.affiliate-banners.index') }}" class="btn btn-light btn-sm">Clear</a></div>
        @endif
      </form>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Brand</th>
              <th>Headline</th>
              <th>Shown on</th>
              <th>Order</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($banners as $banner)
              @php $labels = \App\Support\AffiliateBannerPlacements::labelsFor($banner->placements ?? []); @endphp
              <tr>
                <td>{{ $banner->brand_name ?: '—' }}</td>
                <td>{{ $banner->title }}</td>
                <td>{{ $labels ? implode(', ', $labels) : 'Nowhere yet' }}</td>
                <td>{{ $banner->sort_order }}</td>
                <td>{{ $banner->is_active ? 'Active' : 'Hidden' }}</td>
                <td class="d-flex gap-2">
                  <a href="{{ route('admin.affiliate-banners.edit', $banner) }}" class="btn btn-primary btn-sm">Edit</a>
                  <form method="POST" action="{{ route('admin.affiliate-banners.destroy', $banner) }}" onsubmit="return confirm('Delete this banner?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="text-center text-muted">No offer banners yet.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      @if ($banners->hasPages())
        {{ $banners->links() }}
      @endif
    </div>
  </div>
</div>
@endsection
