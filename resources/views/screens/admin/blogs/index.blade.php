@extends('layouts.admin.master')

@section('title', 'Blog Management')

@section('content')
  <style>
    .blog-thumb { width: 56px; height: 56px; object-fit: cover; border-radius: 8px; }
    .blog-thumb-placeholder {
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
            <h5 class="mb-0">All Blog Posts</h5>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">Create Blog</a>
          </div>
          <div class="card-body pt-3">
            <form method="GET" action="{{ route('admin.blogs.index') }}" class="row g-2 mb-3">
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
                  <a href="{{ route('admin.blogs.index') }}" class="btn btn-light btn-sm">Clear</a>
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
                    <th><span class="c-o-light f-w-600">Status</span></th>
                    <th><span class="c-o-light f-w-600">Published</span></th>
                    <th><span class="c-o-light f-w-600">Actions</span></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($blogs as $blog)
                    <tr>
                      <td>
                        @if ($blog->imageUrl())
                          <img src="{{ $blog->imageUrl() }}" alt="{{ $blog->title }}" class="blog-thumb">
                        @else
                          <div class="blog-thumb-placeholder">No<br>Image</div>
                        @endif
                      </td>
                      <td>{{ $blog->title }}</td>
                      <td><code>{{ $blog->slug }}</code></td>
                      <td>
                        @if ($blog->status)
                          <span class="badge bg-success">Published</span>
                        @else
                          <span class="badge bg-secondary">Draft</span>
                        @endif
                      </td>
                      <td>{{ $blog->published_at?->format('d M Y, H:i A') ?: '—' }}</td>
                      <td>
                        <div class="d-flex flex-wrap gap-2">
                          <a href="{{ $blog->publicUrl() }}" target="_blank" class="btn btn-light btn-sm">View</a>
                          <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                          <button
                            type="button"
                            class="btn btn-outline-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteBlogModal"
                            data-blog-title="{{ $blog->title }}"
                            data-delete-url="{{ route('admin.blogs.destroy', $blog) }}"
                          >
                            Delete
                          </button>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center py-4">No blog posts found.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            @if ($blogs->hasPages())
              <div class="pt-3">
                {{ $blogs->links() }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteBlogModal" tabindex="-1" aria-labelledby="deleteBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteBlogModalLabel">Delete Blog Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0">Are you sure you want to delete <strong id="delete-blog-title"></strong>? This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <form id="delete-blog-form" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('deleteBlogModal')?.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var title = button.getAttribute('data-blog-title');
      var deleteUrl = button.getAttribute('data-delete-url');

      document.getElementById('delete-blog-title').textContent = title || 'this blog post';
      document.getElementById('delete-blog-form').setAttribute('action', deleteUrl);
    });
  </script>
@endsection
