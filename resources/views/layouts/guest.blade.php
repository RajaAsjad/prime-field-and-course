<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Login — Prime Field &amp; Course</title>
  <link rel="icon" href="/assets/images/favicon.svg" type="image/svg+xml" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="/assets/css/auth.css" />
</head>

<body class="auth-body">
  <div class="auth-wrap">
    <a href="{{ route('home') }}" class="auth-brand" aria-label="Prime Field &amp; Course Solutions LLC">
      @include('partials.brand-logo')
    </a>

    <div class="auth-card">
      {{ $slot }}
    </div>

    <a href="{{ route('home') }}" class="auth-back">← Back to website</a>
  </div>
</body>

</html>
