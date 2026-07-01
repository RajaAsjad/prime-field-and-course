@extends('layouts.admin.master')

@section('title', 'Users')

@section('content')
  <div class="container-fluid user-list-wrapper">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header pb-0">
            <h5>All Users</h5>
          </div>
          <div class="card-body pt-3 px-0">
            <div class="list-product user-list-table">
              <div class="table-responsive custom-scrollbar">
                <table class="table" id="users-table">
                  <thead>
                    <tr>
                      <th><span class="c-o-light f-w-600">Name</span></th>
                      <th><span class="c-o-light f-w-600">Email</span></th>
                      <th><span class="c-o-light f-w-600">Role</span></th>
                      <th><span class="c-o-light f-w-600">Created</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                      <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ formatRole($user->role) }}</td>
                        <td>{{ $user->created_at?->format('d M Y, H:i A') }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4" class="text-center py-4">No users found.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              @if ($users->hasPages())
                <div class="px-4 pt-3">
                  {{ $users->links() }}
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
