@extends('layouts.admin.master')

@section('title', 'Create Tips Category')

@section('content')
  <style>
    .category-image-preview { max-height: 120px; width: auto; }
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
            <h5>Create Tips Category</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.tips-categories.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @include('screens.admin.tips-categories._form')

              <div class="d-flex flex-wrap gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.tips-categories.index') }}" class="btn btn-light">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
