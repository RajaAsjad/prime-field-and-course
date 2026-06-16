<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-top">

            <div class="f-brand">
                <a href="{{ route('index') }}" class="logo-link" aria-label="{{ $site['name'] ?? 'Home' }} — Back to top">
                    @include('layouts.website.partials.logo-mark')
                </a>
                <p class="f-brand-desc">{{ $site['footer']['about_text'] ?? $site['description'] ?? '' }}</p>
                <nav class="f-social" role="list" aria-label="Social media">
                    @if (!empty($site['social']['facebook']))
                        <a href="{{ $site['social']['facebook'] }}" class="f-soc-link" role="listitem" aria-label="Follow us on Facebook" target="_blank" rel="noopener noreferrer">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </a>
                    @endif
                    @if (!empty($site['social']['instagram']))
                        <a href="{{ $site['social']['instagram'] }}" class="f-soc-link" role="listitem" aria-label="Follow us on Instagram" target="_blank" rel="noopener noreferrer">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        </a>
                    @endif
                    @if (!empty($site['social']['linkedin']))
                        <a href="{{ $site['social']['linkedin'] }}" class="f-soc-link" role="listitem" aria-label="Connect with us on LinkedIn" target="_blank" rel="noopener noreferrer">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                        </a>
                    @endif
                    @if (!empty($site['social']['youtube']))
                        <a href="{{ $site['social']['youtube'] }}" class="f-soc-link" role="listitem" aria-label="Watch project videos on YouTube" target="_blank" rel="noopener noreferrer">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="none" stroke-linecap="round"/></svg>
                        </a>
                    @endif
                </nav>
            </div>

            <nav class="f-col" aria-label="Quick links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('index') }}">Home</a></li>
                    @foreach ($site['pages'] ?? [] as $page)
                        <li><a href="{{ url($page['url'] ?? '/') }}">{{ $page['label'] === 'About' ? 'About Us' : ($page['label'] === 'Process' ? 'Our Process' : $page['label']) }}</a></li>
                    @endforeach
                </ul>
            </nav>

            <nav class="f-col" aria-label="Services links">
                <h4>Services</h4>
                <ul>
                    <li><a href="{{ url('/#services') }}">Golf Course Construction</a></li>
                    <li><a href="{{ url('/#services') }}">Athletic Field Construction</a></li>
                    <li><a href="{{ url('/#services') }}">Course &amp; Field Renovation</a></li>
                    <li><a href="{{ url('/#services') }}">Drainage Engineering</a></li>
                    <li><a href="{{ url('/#services') }}">Irrigation Installation</a></li>
                    <li><a href="{{ url('/#services') }}">Field Lighting</a></li>
                </ul>
            </nav>

            <div class="f-col">
                <h4>Stay Informed</h4>
                <p class="f-newsletter-desc">Get project spotlights, construction insights, and industry news delivered to your inbox monthly.</p>
                <div class="newsletter-row">
                    <label for="nl-email" class="sr-only">Email address for newsletter</label>
                    <input type="email" id="nl-email" placeholder="Your email address" autocomplete="email"/>
                    <button type="button" aria-label="Subscribe to newsletter">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    </button>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <p>
                @if (!empty($site['footer']['copyright']))
                    {{ $site['footer']['copyright'] }}
                @else
                    &copy; {{ date('Y') }} {{ $site['name'] ?? 'Website' }}. All rights reserved.
                @endif
            </p>
            <nav class="footer-legal" aria-label="Legal links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Sitemap</a>
            </nav>
        </div>
    </div>
</footer>
