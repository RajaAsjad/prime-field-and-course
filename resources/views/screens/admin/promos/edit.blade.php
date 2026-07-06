@extends('layouts.admin.master')

@section('title', 'Edit Promo')

@section('content')
  <style>
    .promo-image-preview { max-height: 120px; width: auto; }
  </style>

  <div class="container-fluid">
    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Please fix the following errors:</strong>
        <ul class="mb-0 mt-2">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header pb-0">
            <h5>Edit Promo</h5>
            <p class="text-muted mb-0 mt-1">Current slug: <code>{{ $promo->slug }}</code></p>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.promos.update', $promo) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              @include('screens.admin.promos._form', ['promo' => $promo])

              <div class="d-flex flex-wrap gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.promos.index') }}" class="btn btn-light">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
