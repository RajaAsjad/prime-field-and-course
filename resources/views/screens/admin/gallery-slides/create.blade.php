@extends('layouts.admin.master')
@section('title', 'Add Gallery Image')
@section('content')
<div class="container-fluid">
  @include('screens.admin.partials.alerts')
  <div class="card">
    <div class="card-header"><h5>Add Gallery Image</h5></div>
    <div class="card-body">
      <form method="POST" action="{{ route('admin.gallery-slides.store') }}" enctype="multipart/form-data">
        @csrf
        @include('screens.admin.gallery-slides._form')
        <div class="d-flex gap-2 mt-4">
          <button class="btn btn-primary">Save</button>
          <a href="{{ route('admin.gallery-slides.index') }}" class="btn btn-light">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
