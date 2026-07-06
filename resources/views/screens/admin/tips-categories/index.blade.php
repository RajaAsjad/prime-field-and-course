@extends('layouts.admin.master')

@section('title', 'Tips Categories')

@section('content')
  <style>
    .category-thumb { width: 56px; height: 56px; object-fit: cover; border-radius: 8px; }
    .category-thumb-placeholder {
      width: 56px;
      height: 56px;
      border-radius: 8px;
      background: #eef5ef;
      color: #6a8070;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .7rem;
      font-weight: 700;
      text-align: center;
      line-height: 1.2;
    }
  </style>

  <div class="container-fluid">
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header pb-0 d-flex flex-wrap align-items-center justify-content-between gap-2">
            <h5 class="mb-0">All Tips Categories</h5>
            <a href="{{ route('admin.tips-categories.create') }}" class="btn btn-primary btn-sm">Create Category</a>
          </div>
          <div class="card-body pt-3">
            <form method="GET" action="{{ route('admin.tips-categories.index') }}" class="row g-2 mb-3">
              <div class="col-md-6 col-lg-4">
                <input
                  type="text"
                  name="search"
                  class="form-control"
                  placeholder="Search by title or slug..."
                  value="{{ $search }}"
                />
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm">Search</button>
              </div>
              @if ($search !== '')
                <div class="col-auto">
                  <a href="{{ route('admin.tips-categories.index') }}" class="btn btn-light btn-sm">Clear</a>
                </div>
              @endif
            </form>

            <div class="table-responsive custom-scrollbar">
              <table class="table">
                <thead>
                  <tr>
                    <th><span class="c-o-light f-w-600">Image</span></th>
                    <th><span class="c-o-light f-w-600">Title</span></th>
                    <th><span class="c-o-light f-w-600">Slug</span></th>
                    <th><span class="c-o-light f-w-600">Description</span></th>
                    <th><span class="c-o-light f-w-600">Created Date</span></th>
                    <th><span class="c-o-light f-w-600">Actions</span></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($categories as $category)
                    <tr>
                      <td>
                        @if ($category->imageUrl())
                          <img src="{{ $category->imageUrl() }}" alt="{{ $category->title }}" class="category-thumb">
                        @else
                          <div class="category-thumb-placeholder">No<br>Image</div>
                        @endif
                      </td>
                      <td>{{ $category->title }}</td>
                      <td><code>{{ $category->slug }}</code></td>
                      <td>{{ Str::limit($category->description, 60) ?: '—' }}</td>
                      <td>{{ $category->created_at?->format('d M Y, H:i A') }}</td>
                      <td>
                        <div class="d-flex flex-wrap gap-2">
                          <a href="{{ route('admin.tips-categories.edit', $category) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                          <button
                            type="button"
                            class="btn btn-outline-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteCategoryModal"
                            data-category-title="{{ $category->title }}"
                            data-delete-url="{{ route('admin.tips-categories.destroy', $category) }}"
                          >
                            Delete
                          </button>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center py-4">No tips categories found.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            @if ($categories->hasPages())
              <div class="pt-3">
                {{ $categories->links() }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteCategoryModalLabel">Delete Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0">Are you sure you want to delete <strong id="delete-category-title"></strong>? This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <form id="delete-category-form" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('deleteCategoryModal')?.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var title = button.getAttribute('data-category-title');
      var deleteUrl = button.getAttribute('data-delete-url');

      document.getElementById('delete-category-title').textContent = title || 'this category';
      document.getElementById('delete-category-form').setAttribute('action', deleteUrl);
    });
  </script>
@endsection
