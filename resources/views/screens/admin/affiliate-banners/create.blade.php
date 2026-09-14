@extends('layouts.admin.master')
@section('title', 'Create Offer Banner')
@section('content')
<div class="container-fluid">
  @include('screens.admin.partials.alerts')
  <div class="card">
    <div class="card-header"><h5>Create Offer Banner</h5></div>
    <div class="card-body">
      <form method="POST" action="{{ route('admin.affiliate-banners.store') }}" enctype="multipart/form-data">
        @csrf
        @include('screens.admin.affiliate-banners._form')
        <div class="d-flex gap-2 mt-4">
          <button class="btn btn-primary">Save</button>
          <a href="{{ route('admin.affiliate-banners.index') }}" class="btn btn-light">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
