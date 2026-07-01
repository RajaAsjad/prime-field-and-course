@extends('layouts.admin.master')

@section('title', 'Dashboard')

@section('content')
  <div class="container-fluid default-dashboard">
    <div class="row mb-3">
      <div class="col-12">
        <div class="card dashboard-welcome-card border-0">
          <div class="card-body d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
              <h4 class="mb-1 text-white">Welcome back, {{ $user->name }}</h4>
              <p class="mb-0 dashboard-welcome-sub">Manage your golf platform from here.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
              @if ($user->hasRole(config('roles.admin')))
                <a href="{{ route('users.index') }}" class="btn btn-light btn-sm">Manage Users</a>
              @endif
              <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm" target="_blank">View Website</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row widget-grid">
      @if ($user->hasRole(config('roles.admin')))
        <div class="col-xxl-3 col-md-6 box-col-6">
          <a href="{{ route('users.index') }}" class="text-decoration-none">
            <div class="card widget-1">
              <div class="card-body">
                <div class="widget-content">
                  <div class="widget-round primary">
                    <div class="bg-round">
                      <svg aria-hidden="true">
                        <use href="{{ asset('assets/admin/svg/icon-sprite.svg#c-customer') }}"></use>
                      </svg>
                      <svg class="half-circle svg-fill" aria-hidden="true">
                        <use href="{{ asset('assets/admin/svg/icon-sprite.svg#halfcircle') }}"></use>
                      </svg>
                    </div>
                  </div>
                  <div>
                    <h4 class="mb-0">{{ number_format((int) ($stats['totalUsers'] ?? 0)) }}</h4>
                    <span class="f-light">Users</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      @endif
    </div>
  </div>

  <style>
    .dashboard-welcome-card {
      background: linear-gradient(135deg, #1a5c28 0%, #0d1e10 100%);
      box-shadow: 0 12px 32px rgba(26, 92, 40, .18);
    }

    .dashboard-welcome-sub {
      color: rgba(255, 255, 255, .72);
    }

    .default-dashboard .widget-round.primary .bg-round svg {
      fill: #1a5c28;
    }
  </style>
@endsection
