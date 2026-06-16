<header class="site-header" id="hdr" role="banner">
    <div class="container nav-wrap">

        <a href="{{ route('index') }}" class="logo-link" aria-label="{{ $site['name'] ?? 'Home' }} — Home">
            @include('layouts.website.partials.logo-mark')
        </a>

        <nav aria-label="Main navigation">
            <ul class="nav-links">
                @foreach ($site['pages'] ?? [] as $page)
                    <li>
                        <a href="{{ url($page['url'] ?? '/') }}">{{ $page['label'] }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>

        @if (!empty($site['nav_cta']['enabled']))
            <a href="{{ url($site['nav_cta']['url'] ?? '/#contact') }}" class="btn btn-gold btn-sm nav-cta" aria-label="{{ $site['nav_cta']['label'] ?? 'Get a Free Quote' }}">
                {{ $site['nav_cta']['label'] ?? 'Get a Free Quote' }}
            </a>
        @endif

        <button class="hamburger" id="ham" aria-label="Open navigation menu" aria-expanded="false" aria-controls="drawer">
            <span></span><span></span><span></span>
        </button>
    </div>

    <div class="mobile-drawer" id="drawer" aria-label="Mobile navigation" aria-hidden="true">
        <div class="drawer-section-label">Navigation</div>
        @foreach ($site['pages'] ?? [] as $page)
            <a href="{{ url($page['url'] ?? '/') }}" class="drawer-link">{{ $page['label'] === 'About' ? 'About Us' : ($page['label'] === 'Process' ? 'Our Process' : $page['label']) }}</a>
        @endforeach
        @if (!empty($site['nav_cta']['enabled']))
            <a href="{{ url($site['nav_cta']['url'] ?? '/#contact') }}" class="btn btn-gold btn-lg">{{ $site['nav_cta']['label'] ?? 'Get a Free Quote' }}</a>
        @endif
        @if (!empty($site['contact']['phone']))
            <a href="tel:{{ $site['contact']['phone_href'] ?? preg_replace('/\D/', '', $site['contact']['phone']) }}" class="btn btn-outline-grn btn-lg" style="margin-top:var(--s3)">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 11.91 19.79 19.79 0 0 1 1.61 3.3 2 2 0 0 1 3.59 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.56a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.69 16l.31.92z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Call Us Now
            </a>
        @endif
    </div>
</header>
