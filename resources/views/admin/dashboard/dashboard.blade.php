@extends('layouts.admin.app')
@section('title', $page_title ?? 'Dashboard')

@push('css')
    @if (!empty($site['theme']['google_fonts']))
        <link href="{{ $site['theme']['google_fonts'] }}" rel="stylesheet">
    @endif
    <style>
        body.skin-blue.fixed .content-wrapper {
            background: var(--dash-surface) !important;
            min-height: 100vh;
            margin-top: 0 !important;
            padding: 50px 0 0 !important;
        }

        .pg-dash {
            min-height: calc(100vh - 50px);
            background: var(--dash-surface);
            padding: 0.75rem 1rem 1.25rem;
            margin: 0;
        }

        .pg-dash.content {
            padding: 0.75rem 1rem 1.25rem !important;
            margin: 0 !important;
            min-height: calc(100vh - 50px);
        }

        .pg-dash__banner {
            width: 100%;
            margin: 0 0 1.25rem;
            padding: 2.5rem 1.5rem;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid color-mix(in srgb, var(--dash-primary) 15%, transparent);
            box-shadow: 0 8px 32px color-mix(in srgb, var(--dash-primary) 10%, transparent);
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .pg-dash__banner::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse 80% 55% at 75% 25%, color-mix(in srgb, var(--dash-primary) 14%, transparent) 0%, transparent 58%),
                radial-gradient(ellipse 55% 45% at 15% 85%, color-mix(in srgb, var(--dash-secondary) 12%, transparent) 0%, transparent 52%),
                radial-gradient(ellipse 45% 35% at 92% 70%, color-mix(in srgb, var(--dash-primary-dark) 8%, transparent) 0%, transparent 48%);
            animation: pgDashMesh 18s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes pgDashMesh {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-10px, 12px) scale(1.02); }
        }

        .pg-dash__welcome {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .pg-dash__welcome-title {
            font-family: var(--dash-font-display);
            font-weight: 800;
            font-size: clamp(2rem, 5vw, 3.5rem);
            line-height: 1.1;
            letter-spacing: -0.02em;
            margin: 0;
            background: linear-gradient(135deg, var(--dash-primary) 0%, var(--dash-primary-dark) 45%, var(--dash-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: welcomeFloat 3s ease-in-out infinite;
        }

        @keyframes welcomeFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .pg-dash__welcome-subtitle {
            font-family: var(--dash-font-body);
            font-size: clamp(1rem, 2vw, 1.25rem);
            font-weight: 500;
            color: var(--dash-muted);
            margin: 1rem 0 0;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .pg-dash__grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1.25rem;
        }

        .pg-dash__card {
            flex: 1 1 160px;
            min-width: min(100%, 160px);
            background: #fff;
            border-radius: 16px;
            padding: 1.75rem 1.5rem;
            box-shadow: 0 4px 16px color-mix(in srgb, var(--dash-primary) 8%, transparent);
            border: 1px solid color-mix(in srgb, var(--dash-primary) 12%, transparent);
            text-decoration: none;
            color: inherit;
            display: block;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.35s ease, border-color 0.35s ease;
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(24px);
            animation: cardFadeIn 0.55s ease forwards;
        }

        .pg-dash__card:nth-child(1) { animation-delay: 0.05s; }
        .pg-dash__card:nth-child(2) { animation-delay: 0.1s; }
        .pg-dash__card:nth-child(3) { animation-delay: 0.15s; }
        .pg-dash__card:nth-child(4) { animation-delay: 0.2s; }
        .pg-dash__card:nth-child(5) { animation-delay: 0.25s; }
        .pg-dash__card:nth-child(6) { animation-delay: 0.3s; }

        @keyframes cardFadeIn {
            to { opacity: 1; transform: translateY(0); }
        }

        .pg-dash__card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, color-mix(in srgb, var(--dash-primary) 12%, transparent), transparent);
            transition: left 0.5s ease;
        }

        .pg-dash__card:hover::before { left: 100%; }

        .pg-dash__card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px color-mix(in srgb, var(--dash-primary) 15%, transparent);
            border-color: color-mix(in srgb, var(--dash-primary) 28%, transparent);
            color: inherit;
            text-decoration: none;
        }

        .pg-dash__card-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
            background: linear-gradient(135deg, var(--dash-primary) 0%, color-mix(in srgb, var(--dash-primary) 70%, var(--dash-secondary)) 50%, var(--dash-secondary) 100%);
            color: #fff;
            box-shadow: 0 6px 18px color-mix(in srgb, var(--dash-primary) 35%, transparent);
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .pg-dash__card:hover .pg-dash__card-icon {
            transform: scale(1.08) rotate(4deg);
        }

        .pg-dash__card-value {
            font-family: var(--dash-font-body);
            font-size: 2.35rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
            background: linear-gradient(135deg, var(--dash-text), #3a4a3a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .pg-dash__card:hover .pg-dash__card-value {
            background: linear-gradient(135deg, var(--dash-primary), var(--dash-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .pg-dash__card-label {
            font-family: var(--dash-font-body);
            font-size: 0.9375rem;
            color: var(--dash-muted);
            margin-top: 0.25rem;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        .pg-dash__actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
            margin-top: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .pg-dash__link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.25rem;
            border-radius: 999px;
            font-family: var(--dash-font-body);
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            color: var(--dash-primary-dark);
            background: color-mix(in srgb, var(--dash-primary) 8%, #fff);
            border: 1px solid color-mix(in srgb, var(--dash-primary) 20%, transparent);
            transition: background 0.2s, transform 0.2s;
        }

        .pg-dash__link:hover {
            background: color-mix(in srgb, var(--dash-primary) 14%, #fff);
            transform: translateY(-2px);
            color: var(--dash-primary-dark);
            text-decoration: none;
        }

        @media (max-width: 576px) {
            .pg-dash,
            .pg-dash.content {
                padding: 0.5rem 0.75rem 1rem !important;
            }

            .pg-dash__banner { padding: 1.75rem 1rem; margin-bottom: 1rem; }
            .pg-dash__card { padding: 1.25rem; }
            .pg-dash__card-value { font-size: 1.65rem; }
        }
    </style>
@endpush

@section('content')
    <section class="content pg-dash">
        @php
            $contactUsIndex = Route::has('contactus.index') ? route('contactus.index') : '#';
            $settingsIndex = Route::has('page.index') ? route('page.index') : '#';
            $serviceIndex = Route::has('service.index') ? route('service.index') : '#';
            $portfolioIndex = Route::has('portfolio.index') ? route('portfolio.index') : '#';
            $processIndex = Route::has('process.index') ? route('process.index') : '#';
            $testimonialIndex = Route::has('testimonial.index') ? route('testimonial.index') : '#';
            $welcomeName = $site['admin']['welcome_message'] ?: ($site['short_name'] ?? $site['name'] ?? 'Admin');
        @endphp

        <div class="pg-dash__banner">
            <div class="pg-dash__welcome">
                <h1 class="pg-dash__welcome-title">Welcome<br>{{ $welcomeName }}</h1>
                <p class="pg-dash__welcome-subtitle">{{ $site['admin']['dashboard_subtitle'] ?? 'Manage your website content' }}</p>
                <div class="pg-dash__actions">
                    <a href="{{ url('/') }}" target="_blank" rel="noopener" class="pg-dash__link">
                        <i class="fa fa-globe" aria-hidden="true"></i> View Website
                    </a>
                    @can('page-list')
                        <a href="{{ $settingsIndex }}" class="pg-dash__link">
                            <i class="fa fa-cog" aria-hidden="true"></i> Site Settings
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="pg-dash__grid">
            @can('contactus-list')
            <a href="{{ $contactUsIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $contactUsTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Contact Messages</div>
            </a>
            @endcan

            @can('service-list')
            <a href="{{ $serviceIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon"><i class="fa fa-wrench" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $servicesTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Services</div>
            </a>
            @endcan

            @can('portfolio-list')
            <a href="{{ $portfolioIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $portfolioTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Portfolio Projects</div>
            </a>
            @endcan

            @can('process-list')
            <a href="{{ $processIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $processTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">How We Work Steps</div>
            </a>
            @endcan

            @can('testimonial-list')
            <a href="{{ $testimonialIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon"><i class="fa fa-quote-left" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $activeTestimonialsTotal ?? $testimonialsTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Active Testimonials</div>
            </a>
            @endcan
        </div>
    </section>
@endsection
