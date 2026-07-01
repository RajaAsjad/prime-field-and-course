@extends('layouts.admin.master')

@section('title', 'Tips')

@section('content')
  <style>
    .tip-thumb { width: 56px; height: 56px; object-fit: cover; border-radius: 8px; }
    .tip-thumb-placeholder {
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
            <h5 class="mb-0">All Tips</h5>
            <a href="{{ route('admin.tips.create') }}" class="btn btn-primary btn-sm">Create Tip</a>
          </div>
          <div class="card-body pt-3">
            <form method="GET" action="{{ route('admin.tips.index') }}" class="row g-2 mb-3">
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
                  <a href="{{ route('admin.tips.index') }}" class="btn btn-light btn-sm">Clear</a>
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
                    <th><span class="c-o-light f-w-600">Slogan</span></th>
                    <th><span class="c-o-light f-w-600">Status</span></th>
                    <th><span class="c-o-light f-w-600">Created Date</span></th>
                    <th><span class="c-o-light f-w-600">Actions</span></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($tips as $tip)
                    <tr>
                      <td>
                        @if ($tip->imageUrl())
                          <img src="{{ $tip->imageUrl() }}" alt="{{ $tip->title }}" class="tip-thumb">
                        @else
                          <div class="tip-thumb-placeholder">No<br>Image</div>
                        @endif
                      </td>
                      <td>{{ $tip->title }}</td>
                      <td><code>{{ $tip->slug }}</code></td>
                      <td>{{ $tip->slogan ?: '—' }}</td>
                      <td>
                        @if ($tip->status)
                          <span class="badge bg-success">Active</span>
                        @else
                          <span class="badge bg-secondary">Inactive</span>
                        @endif
                      </td>
                      <td>{{ $tip->created_at?->format('d M Y, H:i A') }}</td>
                      <td>
                        <div class="d-flex flex-wrap gap-2">
                          <a href="{{ route('admin.tips.edit', $tip) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                          <button
                            type="button"
                            class="btn btn-outline-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteTipModal"
                            data-tip-title="{{ $tip->title }}"
                            data-delete-url="{{ route('admin.tips.destroy', $tip) }}"
                          >
                            Delete
                          </button>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="7" class="text-center py-4">No tips found.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            @if ($tips->hasPages())
              <div class="pt-3">
                {{ $tips->links() }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteTipModal" tabindex="-1" aria-labelledby="deleteTipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteTipModalLabel">Delete Tip</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0">Are you sure you want to delete <strong id="delete-tip-title"></strong>? This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <form id="delete-tip-form" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('deleteTipModal')?.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var title = button.getAttribute('data-tip-title');
      var deleteUrl = button.getAttribute('data-delete-url');

      document.getElementById('delete-tip-title').textContent = title || 'this tip';
      document.getElementById('delete-tip-form').setAttribute('action', deleteUrl);
    });
  </script>
@endsection
