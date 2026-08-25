@extends('layouts.admin.master')
@section('title', 'Content Pages')
@section('content')
<div class="container-fluid">
  @include('screens.admin.partials.alerts')
  <div class="card">
    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Content Pages</h5>
      <a href="{{ route('admin.content-pages.create') }}" class="btn btn-primary btn-sm">Create Page</a>
    </div>
    <div class="card-body">
      <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4"><input type="text" name="search" class="form-control" placeholder="Search..." value="{{ $search }}"></div>
        <div class="col-auto"><button class="btn btn-primary btn-sm">Search</button></div>
      </form>
      <div class="table-responsive">
        <table class="table">
          <thead><tr><th>Title</th><th>Slug</th><th>Type</th><th>Status</th><th>Footer</th><th>Actions</th></tr></thead>
          <tbody>
            @forelse ($pages as $page)
              <tr>
                <td>{{ $page->title }}</td>
                <td><code>{{ $page->slug }}</code></td>
                <td>{{ \App\Models\ContentPage::TYPES[$page->type] ?? $page->type }}</td>
                <td><span class="badge {{ $page->is_published ? 'bg-success' : 'bg-secondary' }}">{{ $page->is_published ? 'Published' : 'Draft' }}</span></td>
                <td>{{ $page->show_in_footer ? 'Yes' : 'No' }}</td>
                <td class="d-flex gap-2">
                  <a href="{{ $page->publicUrl() }}" target="_blank" class="btn btn-light btn-sm">View</a>
                  <a href="{{ route('admin.content-pages.edit', $page) }}" class="btn btn-primary btn-sm">Edit</a>
                  <form action="{{ route('admin.content-pages.destroy', $page) }}" method="POST" onsubmit="return confirm('Delete this page?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="text-center text-muted">No pages found.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      @if ($pages->hasPages())
        {{ $pages->links() }}
      @endif
    </div>
  </div>
</div>
@endsection
