@extends('layouts.admin.master')

@section('title', 'Dashboard')

@section('content')
  <div class="container-fluid admin-home">
    <div class="admin-home-hero">
      <div>
        <p class="admin-home-kicker">{{ now()->format('l, F j') }}</p>
        <h2 class="admin-home-title">Welcome back, {{ explode(' ', $user->name)[0] }}</h2>
        <p class="admin-home-copy">Manage tips, promos, and website content for Prime Field &amp; Course.</p>
      </div>
      <div class="admin-home-hero-actions">
        <a href="{{ route('admin.homepage.edit') }}" class="btn dashboard-welcome-btn dashboard-welcome-btn--solid">Edit Homepage</a>
        <a href="{{ route('home') }}" class="btn dashboard-welcome-btn dashboard-welcome-btn--ghost" target="_blank" rel="noopener">View Website</a>
      </div>
    </div>

    <div class="admin-home-stats">
      @foreach ($stats as $stat)
        <a href="{{ $stat['url'] }}" class="admin-stat">
          <span class="admin-stat-icon" aria-hidden="true"><i class="{{ $stat['icon'] }}"></i></span>
          <span class="admin-stat-value">{{ number_format((int) $stat['value']) }}</span>
          <span class="admin-stat-label">{{ $stat['label'] }}</span>
          <span class="admin-stat-meta">{{ $stat['meta'] }}</span>
        </a>
      @endforeach
    </div>

    <div class="row g-3">
      <div class="col-xl-7">
        <div class="card admin-home-panel h-100">
          <div class="card-header border-0 pb-0">
            <h5 class="mb-0">Quick actions</h5>
            <p class="admin-home-panel-sub mb-0">Jump into the sections you use most.</p>
          </div>
          <div class="card-body">
            <div class="admin-home-shortcuts">
              @foreach ($shortcuts as $shortcut)
                <a href="{{ $shortcut['url'] }}" class="admin-shortcut">
                  <span class="admin-shortcut-icon" aria-hidden="true"><i class="{{ $shortcut['icon'] }}"></i></span>
                  <span>
                    <strong>{{ $shortcut['label'] }}</strong>
                    <small>{{ $shortcut['desc'] }}</small>
                  </span>
                </a>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-5">
        <div class="card admin-home-panel h-100">
          <div class="card-header border-0 pb-0 d-flex justify-content-between align-items-center">
            <div>
              <h5 class="mb-0">Latest tips</h5>
              <p class="admin-home-panel-sub mb-0">Recently added strategy content.</p>
            </div>
            <a href="{{ route('admin.tips.index') }}" class="admin-home-link">View all</a>
          </div>
          <div class="card-body">
            @forelse ($recentTips as $tip)
              <a href="{{ route('admin.tips.edit', $tip) }}" class="admin-home-row">
                <span>
                  <strong>{{ $tip->title }}</strong>
                  <small>{{ $tip->created_at?->format('d M Y') }} · {{ $tip->statusLabel() }}</small>
                </span>
                <i class="fa-solid fa-angle-right" aria-hidden="true"></i>
              </a>
            @empty
              <p class="admin-home-empty mb-0">No tips yet. <a href="{{ route('admin.tips.create') }}">Create one</a>.</p>
            @endforelse

            <h6 class="admin-home-split">Active promos</h6>
            @forelse ($recentPromos as $promo)
              <a href="{{ route('admin.promos.edit', $promo) }}" class="admin-home-row">
                <span>
                  <strong>{{ $promo->displayBookName() }}</strong>
                  <small>{{ $promo->displayBonus() }} · {{ $promo->statusLabel() }}</small>
                </span>
                <i class="fa-solid fa-angle-right" aria-hidden="true"></i>
              </a>
            @empty
              <p class="admin-home-empty mb-0">No promos yet. <a href="{{ route('admin.promos.create') }}">Add a promo</a>.</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
