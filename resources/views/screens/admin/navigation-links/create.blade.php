@extends('layouts.admin.master')
@section('title', 'Create Navigation Link')
@section('content')
<div class="container-fluid">@include('screens.admin.partials.alerts')<div class="card"><div class="card-header"><h5>Create Navigation Link</h5></div><div class="card-body"><form method="POST" action="{{ route('admin.navigation-links.store') }}">@csrf @include('screens.admin.navigation-links._form', ['link' => $link])<div class="d-flex gap-2 mt-4"><button class="btn btn-primary">Save</button><a href="{{ route('admin.navigation-links.index') }}" class="btn btn-light">Cancel</a></div></form></div></div></div>
@endsection
