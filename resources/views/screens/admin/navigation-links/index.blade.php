@extends('layouts.admin.master')
@section('title', 'Navigation Links')
@section('content')
<div class="container-fluid">
  @include('screens.admin.partials.alerts')
  <div class="card">
    <div class="card-header d-flex justify-content-between"><h5 class="mb-0">Navigation Links</h5><a href="{{ route('admin.navigation-links.create') }}" class="btn btn-primary btn-sm">Add Link</a></div>
    <div class="card-body">
      <form method="GET" class="mb-3"><select name="location" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
        <option value="">All locations</option>
        @foreach (\App\Models\NavigationLink::LOCATIONS as $value => $label)
          <option value="{{ $value }}" @selected($location === $value)>{{ $label }}</option>
        @endforeach
      </select></form>
      <table class="table"><thead><tr><th>Label</th><th>URL</th><th>Location</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>@forelse($links as $link)<tr><td>{{ $link->label }}</td><td><code>{{ $link->url }}</code></td><td>{{ \App\Models\NavigationLink::LOCATIONS[$link->location] ?? $link->location }}</td><td>{{ $link->sort_order }}</td><td>{{ $link->is_active ? 'Active' : 'Hidden' }}</td><td class="d-flex gap-2"><a href="{{ route('admin.navigation-links.edit', $link) }}" class="btn btn-primary btn-sm">Edit</a><form method="POST" action="{{ route('admin.navigation-links.destroy', $link) }}">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form></td></tr>@empty<tr><td colspan="6" class="text-muted text-center">No links.</td></tr>@endforelse</tbody></table>
      {{ $links->links() }}
    </div>
  </div>
</div>
@endsection
