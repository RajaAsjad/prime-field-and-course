@extends('layouts.admin.master')
@section('title', 'Edit FAQ')
@section('content')
<div class="container-fluid">@include('screens.admin.partials.alerts')<div class="card"><div class="card-header"><h5>Edit FAQ</h5></div><div class="card-body"><form method="POST" action="{{ route('admin.faqs.update', $faq) }}">@csrf @method('PUT') @include('screens.admin.faqs._form', ['faq' => $faq])<div class="d-flex gap-2 mt-4"><button class="btn btn-primary">Update</button><a href="{{ route('admin.faqs.index') }}" class="btn btn-light">Cancel</a></div></form></div></div></div>
@endsection
