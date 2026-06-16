@extends('admin-auth.layouts.app')

@section('title', 'Admin login')

@section('content')
    <div class="admin-auth-portal">
        <div class="admin-auth-card">
            <header class="admin-auth-card__header">
                <span class="admin-auth-card__mark" aria-hidden="true">{{ $site['short_name'] ?? 'AD' }}</span>
                <div class="admin-auth-card__titles">
                    <h1 class="admin-auth-card__name">{{ $site['name'] ?? 'Admin' }}</h1>
                    <p class="admin-auth-card__panel">{{ $site['admin']['panel_title'] ?? 'Admin Panel' }}</p>
                </div>
            </header>

            <form method="POST" action="{{ route('admin.authenticate') }}" class="admin-auth-form">
                @csrf
                <input type="hidden" name="user_type" value="Admin">

                <div class="admin-auth-field">
                    <label for="email" class="admin-auth-label">{{ __('Email Address') }}</label>
                    <input id="email" class="admin-auth-input" type="email" name="email" value="{{ old('email') }}"
                        placeholder="you@example.com" autocomplete="email" autofocus>
                    @error('email')
                        <span class="admin-auth-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-auth-field">
                    <label for="password" class="admin-auth-label">{{ __('Password') }}</label>
                    <input id="password" class="admin-auth-input" type="password" name="password"
                        placeholder="••••••••" autocomplete="current-password">
                    @error('password')
                        <span class="admin-auth-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-auth-options">
                    <label class="admin-auth-remember">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>{{ __('Remember Me') }}</span>
                    </label>
                </div>

                <button type="submit" class="admin-auth-submit">{{ __('Login') }}</button>
            </form>
        </div>
    </div>
@endsection
