<x-guest-layout>
  <h1>Welcome back</h1>
  <p class="auth-sub">Sign in to access the admin panel.</p>

  @if (session('status'))
    <div class="auth-status">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="auth-field">
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
        autocomplete="username" />
      @error('email')
        <p class="auth-error">{{ $message }}</p>
      @enderror
    </div>

    <div class="auth-field">
      <label for="password">Password</label>
      <input id="password" type="password" name="password" required autocomplete="current-password" />
      @error('password')
        <p class="auth-error">{{ $message }}</p>
      @enderror
    </div>

    <div class="auth-row">
      <label class="auth-remember" for="remember_me">
        <input id="remember_me" type="checkbox" name="remember" />
        <span>Remember me</span>
      </label>

      @if (Route::has('password.request'))
        <a class="auth-link" href="{{ route('password.request') }}">Forgot password?</a>
      @endif
    </div>

    <div class="auth-actions">
      <button type="submit" class="btn-auth btn-auth-primary">Log in</button>
    </div>
  </form>
</x-guest-layout>
