@extends('layouts.admin.master')
@section('title', 'Create Content Page')
@section('content')
<div class="container-fluid">
  @include('screens.admin.partials.alerts')
  <div class="card"><div class="card-header"><h5>Create Content Page</h5></div><div class="card-body">
    <form action="{{ route('admin.content-pages.store') }}" method="POST">@csrf
      @include('screens.admin.content-pages._form', ['page' => $page])
      <div class="d-flex gap-2 mt-4"><button class="btn btn-primary">Save</button><a href="{{ route('admin.content-pages.index') }}" class="btn btn-light">Cancel</a></div>
    </form>
  </div></div>
</div>
@endsection
