<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Admin') — {{ $site['name'] ?? 'Admin' }}</title>
    @php
        $authFav = $home_page_data['header_favicon'] ?? '';
    @endphp
    @if (!empty($authFav))
        <link rel="icon" href="{{ asset('public/admin/assets/images/page/' . $authFav) }}" type="image/png"
            sizes="16x16">
    @else
        <link rel="icon" href="{{ asset($site['assets']['favicon'] ?? 'assets/website/favicon.svg') }}" type="image/svg+xml">
    @endif
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @if (!empty($site['theme']['google_fonts']))
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="{{ $site['theme']['google_fonts'] }}" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/toastr.min.css') }}">
    @include('layouts.admin.partials.theme-vars')
    <style>
        body.hold-transition.login-page {
            min-height: 100vh;
            font-family: var(--auth-font-body);
            background-color: var(--auth-surface);
            background-image:
                radial-gradient(ellipse 85% 55% at 75% 15%, color-mix(in srgb, var(--auth-brand-500) 12%, transparent) 0%, transparent 58%),
                radial-gradient(ellipse 55% 45% at 12% 85%, color-mix(in srgb, var(--auth-accent) 9%, transparent) 0%, transparent 52%),
                radial-gradient(ellipse 45% 35% at 92% 75%, color-mix(in srgb, var(--auth-brand-600) 8%, transparent) 0%, transparent 48%);
            background-attachment: fixed;
        }

        body.login-page::after {
            display: none;
        }

        .admin-auth-portal {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .admin-auth-card {
            width: 100%;
            max-width: 420px;
            background: var(--auth-card);
            border: 1px solid var(--auth-border);
            border-radius: 20px;
            box-shadow: 0 16px 48px color-mix(in srgb, var(--auth-brand-500) 12%, transparent);
            padding: 2rem 1.75rem 2.25rem;
        }

        .admin-auth-card__header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.75rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid color-mix(in srgb, var(--auth-brand-500) 10%, transparent);
        }

        .admin-auth-card__mark {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--auth-font-display);
            font-weight: 800;
            font-size: 1rem;
            color: #fff;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--auth-brand-500), var(--auth-accent));
            box-shadow: 0 4px 16px color-mix(in srgb, var(--auth-brand-500) 25%, transparent);
        }

        .admin-auth-card__name {
            font-family: var(--auth-font-display);
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--auth-text);
            letter-spacing: -0.02em;
            margin: 0 0 0.2rem;
            line-height: 1.15;
        }

        .admin-auth-card__panel {
            margin: 0;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--auth-muted);
        }

        .admin-auth-form {
            margin: 0;
        }

        .admin-auth-field {
            margin-bottom: 1.1rem;
        }

        .admin-auth-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--auth-text);
            margin-bottom: 0.35rem;
        }

        .admin-auth-input {
            width: 100%;
            padding: 0.65rem 0.9rem;
            font-size: 0.9375rem;
            font-family: var(--auth-font-body);
            border: 1px solid var(--auth-border);
            border-radius: 12px;
            background: var(--auth-surface);
            color: var(--auth-text);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .admin-auth-input::placeholder {
            color: #9ca3af;
        }

        .admin-auth-input:hover {
            border-color: color-mix(in srgb, var(--auth-brand-500) 25%, transparent);
        }

        .admin-auth-input:focus {
            outline: none;
            border-color: var(--auth-brand-500);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--auth-brand-500) 18%, transparent);
            background: #fff;
        }

        .admin-auth-error {
            display: block;
            font-size: 0.78rem;
            color: #dc2626;
            margin-top: 0.35rem;
        }

        .admin-auth-options {
            margin: 0.25rem 0 1.25rem;
        }

        .admin-auth-remember {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.8125rem;
            color: var(--auth-muted);
            cursor: pointer;
            user-select: none;
            margin: 0;
        }

        .admin-auth-remember input {
            width: 1rem;
            height: 1rem;
            accent-color: var(--auth-brand-500);
            cursor: pointer;
        }

        .admin-auth-submit {
            width: 100%;
            padding: 0.75rem 1rem;
            font-family: var(--auth-font-body);
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            border: none;
            border-radius: 9999px;
            cursor: pointer;
            background: var(--auth-brand-500);
            box-shadow: 0 4px 16px color-mix(in srgb, var(--auth-brand-500) 30%, transparent);
            transition: transform 0.15s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .admin-auth-submit:hover {
            background: var(--auth-brand-600);
            transform: translateY(-1px);
            box-shadow: 0 8px 24px color-mix(in srgb, var(--auth-brand-500) 35%, transparent);
        }

        .admin-auth-submit:active {
            transform: translateY(0);
        }

        .admin-auth-submit:focus {
            outline: none;
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--auth-brand-500) 35%, transparent);
        }

        @media (max-width: 400px) {
            .admin-auth-card {
                padding: 1.5rem 1.25rem;
            }

            .admin-auth-card__name {
                font-size: 1.2rem;
            }
        }

        /* Forgot password / change password (still use .login-box) */
        .login-page .login-box {
            width: 100%;
            max-width: 440px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .login-page .login-box .login-logo {
            color: var(--auth-text);
            font-family: var(--auth-font-display);
            text-align: center;
            margin-bottom: 1rem;
        }

        .login-page .login-box-body {
            background: var(--auth-card);
            border: 1px solid var(--auth-border);
            border-radius: 20px;
            padding: 1.5rem 1.25rem;
            box-shadow: 0 16px 48px color-mix(in srgb, var(--auth-brand-500) 12%, transparent);
        }
    </style>
    @stack('styles')
    @stack('css')
</head>

<body class="hold-transition login-page sidebar-mini">

    @yield('content')

    <script src="{{ asset('public/admin/assets/js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/jquery.inputmask.extensions.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/icheck.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/demo.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/toastr.min.js') }}"></script>
    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    @stack('scripts')
    @stack('js')
</body>

</html>
