@extends('layouts.website.master')

@section('title', $page_title)
@section('meta_description', $site['description'] ?? '')

@section('content')
<main id="main">


<!-- ═══════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════ -->
<section class="hero" aria-labelledby="hero-heading">

  <div class="hero-bg" aria-hidden="true">
    <img
      src="{{ asset('assets/website/images/hero-bg.jpg') }}"
      alt="Sweeping aerial view of a championship golf course with rolling green fairways"
      width="1920" height="1080"
      loading="eager" fetchpriority="high" decoding="sync"
    />
  </div>

  <div class="hero-orb hero-orb-1" aria-hidden="true"></div>
  <div class="hero-orb hero-orb-2" aria-hidden="true"></div>

  <div class="container" style="width:100%">
    <div class="hero-inner">

      <!-- Left: copy -->
      <div class="hero-content">

        <div class="hero-badge" aria-label="Established 1990 — 35 plus years of field excellence">
          <div class="badge-dot" aria-hidden="true"></div>
          <span class="badge-text">Est. 1990 &nbsp;·&nbsp; 35+ Years of Excellence</span>
        </div>

        <h1 class="hero-title" id="hero-heading">
          We Build Where
          <span class="line2">Champions Play</span>
        </h1>

        <p class="hero-desc">
          Prime Field and Course Solutions LLC engineers championship golf courses and world-class athletic fields — graded, shaped, and built to perform for generations.
        </p>

        <div class="hero-actions">
          <a href="#portfolio" class="btn btn-gold btn-lg">
            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
            View Our Work
          </a>
          <a href="#contact" class="btn btn-ghost btn-lg">
            Request a Free Quote
          </a>
        </div>

        <div class="hero-trust" role="list" aria-label="Company statistics">
          <div class="trust-stat" role="listitem">
            <span class="trust-num" data-count="35">35</span>
            <span class="trust-lbl">Years in Business</span>
          </div>
          <div class="trust-sep" aria-hidden="true"></div>
          <div class="trust-stat" role="listitem">
            <span class="trust-num" data-count="450">450</span>
            <span class="trust-lbl">Projects Built</span>
          </div>
          <div class="trust-sep" aria-hidden="true"></div>
          <div class="trust-stat" role="listitem">
            <span class="trust-num" data-count="48">48</span>
            <span class="trust-lbl">States Served</span>
          </div>
          <div class="trust-sep" aria-hidden="true"></div>
          <div class="trust-stat" role="listitem">
            <span class="trust-num" data-count="100">100</span>
            <span class="trust-lbl">% Client Satisfaction</span>
          </div>
        </div>

      </div>

      <!-- Right: image stack (desktop only) -->
      <div class="hero-card-panel" aria-hidden="true">
        <div class="hero-img-main">
          <img
            src="{{ asset('assets/website/images/hero-main.jpg') }}"
            alt=""
            width="800" height="600"
            loading="eager" decoding="async"
          />
          <div class="float-badge" aria-hidden="true">
            <span class="float-badge-num">A+</span>
            <span class="float-badge-lbl">ASBA Certified</span>
          </div>
        </div>
        <div class="hero-cards-row">
          <div class="hero-mini-card">
            <img
              src="{{ asset('assets/website/images/hero-mini-1.jpg') }}"
              alt=""
              width="500" height="312"
              loading="lazy" decoding="async"
            />
          </div>
          <div class="hero-mini-card">
            <img
              src="{{ asset('assets/website/images/hero-mini-2.jpg') }}"
              alt=""
              width="500" height="312"
              loading="lazy" decoding="async"
            />
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="scroll-cue" aria-hidden="true">
    <span>Scroll</span>
    <div class="scroll-mouse"></div>
  </div>

</section>

<!-- ═══════════════════════════════════════════════════
     TRUST BAR
═══════════════════════════════════════════════════ -->
<div class="logo-bar" aria-label="Certifications and associations" role="complementary">
  <div class="container logo-bar-inner">
    <p class="logo-bar-label">Trusted &amp; Certified</p>
    <ul class="trust-logos" role="list">
      <li class="trust-logo-item">
        <span class="trust-logo-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        </span>
        <span class="trust-logo-text">ASBA Member</span>
      </li>
      <li class="trust-logo-item">
        <span class="trust-logo-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
        </span>
        <span class="trust-logo-text">35+ Years Experience</span>
      </li>
      <li class="trust-logo-item">
        <span class="trust-logo-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </span>
        <span class="trust-logo-text">Licensed &amp; Insured</span>
      </li>
      <li class="trust-logo-item">
        <span class="trust-logo-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
        </span>
        <span class="trust-logo-text">GCSAA Partner</span>
      </li>
      <li class="trust-logo-item">
        <span class="trust-logo-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </span>
        <span class="trust-logo-text">Nationwide Coverage</span>
      </li>
    </ul>
  </div>
</div>

<!-- ═══════════════════════════════════════════════════
     ABOUT
═══════════════════════════════════════════════════ -->
<section class="about section-pad" id="about" aria-labelledby="about-h">
  <div class="container">
    <div class="about-grid">

      <!-- Visual -->
      <div class="about-visual reveal from-left">
        <div class="about-main-img">
          <img
            src="{{ asset('assets/website/images/about-main.jpg') }}"
            alt="GreenMark construction crew performing precision grading on a new golf course fairway"
            width="900" height="675"
            loading="lazy" decoding="async"
          />
        </div>
        <div class="about-accent-img">
          <img
            src="{{ asset('assets/website/images/about-accent.jpg') }}"
            alt="Completed athletic field with fresh white yard markings"
            width="400" height="400"
            loading="lazy" decoding="async"
          />
        </div>
        <div class="about-cert-badge" aria-label="ASBA Certified Builder">
          <svg class="cert-icon" viewBox="0 0 24 24">
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
          </svg>
          <span class="cert-value">A+</span>
          <span class="cert-label">ASBA Certified</span>
        </div>
      </div>

      <!-- Content -->
      <div class="about-content">
        <div class="reveal d1">
          <span class="eyebrow">About Us</span>
          <h2 class="s-title" id="about-h" style="margin-top:var(--s3)">
            Built on Expertise.<br/>
            Driven by Precision.
          </h2>
        </div>

        <p class="s-sub reveal d2">
          Since 1990, Prime Field and Course Solutions LLC has been the go-to construction partner for golf clubs, universities, school districts, and municipalities that refuse to settle for anything less than extraordinary. We don't just grade land — we engineer playing surfaces built for performance and permanence.
        </p>

        <div class="pillars">
          <div class="pillar reveal d2">
            <div class="pillar-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <div class="pillar-body">
              <h4>Certified Specialists</h4>
              <p>Full ASBA certification with licensed civil engineers and agronomists on every single project, from the first stake to final inspection.</p>
            </div>
          </div>

          <div class="pillar reveal d3">
            <div class="pillar-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="pillar-body">
              <h4>On Schedule, On Budget</h4>
              <p>We have a 98% on-time delivery record across 450+ projects. Our transparent project management keeps you informed at every milestone.</p>
            </div>
          </div>

          <div class="pillar reveal d4">
            <div class="pillar-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div class="pillar-body">
              <h4>Comprehensive Warranty</h4>
              <p>Every field and course we build comes backed by our industry-leading construction warranty and dedicated post-project support team.</p>
            </div>
          </div>
        </div>

        <div class="reveal d5" style="margin-top:var(--s4)">
          <a href="#contact" class="btn btn-primary btn-lg">Talk to Our Team</a>
        </div>
      </div>

    </div>
  </div>
</section>

<div class="divider-bar"></div>

<!-- ═══════════════════════════════════════════════════
     SERVICES
═══════════════════════════════════════════════════ -->
<section class="services section-pad" id="services" aria-labelledby="svc-h">
  <div class="container">
    <div class="services-header">
      <span class="eyebrow reveal">What We Build</span>
      <h2 class="s-title reveal d1" id="svc-h" style="margin-top:var(--s3)">Construction Services</h2>
      <p class="s-sub reveal d2">Two specialties. One unwavering commitment to quality. From championship golf to multi-sport complexes — we build it right, the first time.</p>
    </div>

    <div class="svc-grid">
      @php
        $iconPaths = [
          'golf' => '<path d="M7 22V5" stroke-linecap="round"/><path d="M7 5l13 4.5L7 14" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 22h18" stroke-linecap="round"/>',
          'athletics' => '<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20M2 14h20M7 5v14M17 5v14" stroke-linecap="round"/>',
          'renovation' => '<path d="M23 4v6h-6"/><path d="M1 20v-6h6"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>',
        ];
      @endphp
      @forelse($services as $index => $service)
      <article class="svc-card reveal d{{ min($index + 1, 4) }}">
        <div class="svc-img">
          <span class="svc-tag">{{ $service->tag }}</span>
          <img
            src="{{ $service->image_url }}"
            alt="{{ $service->title }}"
            width="800" height="450"
            loading="lazy" decoding="async"
          />
        </div>
        <div class="svc-body">
          <div class="svc-icon-wrap" aria-hidden="true">
            <svg viewBox="0 0 24 24">{!! $iconPaths[$service->icon] ?? $iconPaths['golf'] !!}</svg>
          </div>
          <h3>{{ $service->title }}</h3>
          <p>{{ $service->description }}</p>
          @if(count($service->bullet_list))
          <ul class="svc-list" aria-label="{{ $service->title }} services include">
            @foreach($service->bullet_list as $bullet)
            <li>{{ $bullet }}</li>
            @endforeach
          </ul>
          @endif
          <a href="#contact" class="svc-cta" aria-label="Get a {{ strtolower($service->title) }} quote">
            Request a Quote
            <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
          </a>
        </div>
      </article>
      @empty
      <p class="text-center" style="grid-column:1/-1;color:var(--text-muted)">No services available.</p>
      @endforelse
    </div>
  </div>
</section>

<div class="divider-bar"></div>

<!-- ═══════════════════════════════════════════════════
     PROCESS
═══════════════════════════════════════════════════ -->
<section class="process section-pad" id="process" aria-labelledby="proc-h">
  <div class="container">
    <div class="process-header">
      <span class="eyebrow reveal" style="justify-content:center">How We Work</span>
      <h2 class="s-title reveal d1" id="proc-h" style="color:#fff;margin-top:var(--s3)">From Vision to Finished Field</h2>
      <p class="s-sub reveal d2" style="margin-left:auto;margin-right:auto;text-align:center">A proven 4-step process built on transparency, precision, and accountability — every single time.</p>
    </div>

    <div class="steps-grid">
      @forelse($processSteps as $index => $step)
      <div class="step reveal d{{ min($index + 1, 4) }}">
        <div class="step-num" aria-hidden="true">{{ $step->step_number ?? str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
        <div>
          <span class="step-label">{{ $step->phase_label }}</span>
          <h3>{{ $step->title }}</h3>
          <p>{{ $step->description }}</p>
        </div>
      </div>
      @empty
      <p style="grid-column:1/-1;text-align:center;color:rgba(255,255,255,.7)">Process steps coming soon.</p>
      @endforelse
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════
     PORTFOLIO
═══════════════════════════════════════════════════ -->
<section class="portfolio section-pad" id="portfolio" aria-labelledby="port-h">
  <div class="container">
    <div class="portfolio-header">
      <span class="eyebrow reveal" style="justify-content:center">Our Portfolio</span>
      <h2 class="s-title reveal d1" id="port-h" style="margin-top:var(--s3)">Projects We're Proud Of</h2>
      <p class="s-sub reveal d2">From private golf clubs to public school districts — every project we build becomes a landmark in its community.</p>
    </div>

    <div class="port-grid">
      @forelse($portfolioItems as $index => $item)
      @php
        $revealClass = $index === 0 ? 'from-left' : 'd' . min($index, 3);
      @endphp
      <article class="port-card reveal {{ $revealClass }}">
        <img
          src="{{ $item->image_url }}"
          alt="{{ $item->image_alt ?? $item->title }}"
          width="700" height="{{ $index === 0 ? 933 : ($index === 3 ? 514 : 394) }}"
          loading="lazy" decoding="async"
        />
        <div class="port-overlay">
          <span class="port-type">{{ $item->category_label }}</span>
          <h3>{{ $item->title }}</h3>
          <p>{{ $item->subtitle }}</p>
        </div>
        <div class="port-arrow" aria-hidden="true">
          <svg viewBox="0 0 24 24"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
        </div>
      </article>
      @empty
      <p style="grid-column:1/-1;text-align:center;color:var(--text-muted)">Portfolio projects coming soon.</p>
      @endforelse
    </div>

    <div class="port-footer reveal">
      <a href="#contact" class="btn btn-outline-grn btn-lg">
        Discuss Your Project
        <svg viewBox="0 0 24 24" aria-hidden="true" style="width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
    </div>

  </div>
</section>

<div class="divider-bar"></div>

<!-- ═══════════════════════════════════════════════════
     TESTIMONIALS
═══════════════════════════════════════════════════ -->
<section class="testimonials section-pad-sm" aria-labelledby="test-h">
  <div class="container">
    <div class="test-header">
      <span class="eyebrow reveal" style="justify-content:center">Client Stories</span>
      <h2 class="s-title reveal d1" id="test-h" style="margin-top:var(--s3)">What Our Clients Say</h2>
      <p class="s-sub reveal d2">Real words from the clubs, schools, and municipalities that trusted us with their most important playing surfaces.</p>
    </div>

    <div class="test-grid">
      @forelse($testimonials as $index => $testimonial)
      <article class="test-card reveal d{{ min($index + 1, 4) }}">
        <div class="test-stars" aria-label="5 out of 5 stars" role="img">
          @for($s = 0; $s < 5; $s++)
          <svg viewBox="0 0 24 24" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          @endfor
        </div>
        <blockquote class="test-quote">"{{ $testimonial->comment }}"</blockquote>
        <div class="test-author">
          <div class="test-avatar">
            <img src="{{ asset('admin/assets/images/testimonials/' . $testimonial->image) }}" alt="Portrait of {{ $testimonial->name }}" width="50" height="50" loading="lazy"/>
          </div>
          <div>
            <div class="test-name">{{ $testimonial->name }}</div>
            <div class="test-role">{{ $testimonial->designation }}</div>
          </div>
        </div>
      </article>
      @empty
      <p style="grid-column:1/-1;text-align:center;color:var(--text-muted)">Client testimonials coming soon.</p>
      @endforelse
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════
     CONTACT
═══════════════════════════════════════════════════ -->
<section class="contact section-pad" id="contact" aria-labelledby="contact-h">
  <div class="container">
    <div class="contact-grid">

      <!-- Info -->
      <div class="contact-info">
        <div class="reveal">
          <span class="eyebrow">Get in Touch</span>
          <h2 class="s-title" id="contact-h" style="margin-top:var(--s3)">
            Let's Build Your<br/>Next Field Together
          </h2>
        </div>

        <p class="s-sub reveal d1">
          Whether you're breaking ground on a new golf course or rebuilding an athletic field from the soil up — our team is ready to listen, plan, and deliver. Zero obligation.
        </p>

        <div class="c-methods reveal d2">

          <a href="tel:{{ $site['contact']['phone_href'] ?? '18005550190' }}" class="c-method" aria-label="Call Prime Field and Course Solutions at {{ $site['contact']['phone'] ?? '1-800-555-0190' }}">
            <div class="c-method-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 11.91 19.79 19.79 0 0 1 1.61 3.3 2 2 0 0 1 3.59 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.56a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.69 16l.31.92z" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div>
              <div class="c-method-lbl">Call Us Directly</div>
              <div class="c-method-val">{{ $site['contact']['phone'] ?? '1-800-555-0190' }}</div>
            </div>
          </a>

          <a href="mailto:{{ $site['contact']['email'] ?? 'info@primefieldcourse.com' }}" class="c-method" aria-label="Email us at info@primefieldcourse.com">
            <div class="c-method-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke-linecap="round"/><polyline points="22,6 12,13 2,6" stroke-linecap="round"/></svg>
            </div>
            <div>
              <div class="c-method-lbl">Email Us</div>
              <div class="c-method-val">{{ $site['contact']['email'] ?? 'info@primefieldcourse.com' }}</div>
            </div>
          </a>

          <div class="c-method" style="cursor:default;" aria-label="Our headquarters at {{ $site['contact']['address'] ?? '4820 Fairway Drive, Atlanta, GA 30301' }}">
            <div class="c-method-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" stroke-linecap="round"/><circle cx="12" cy="10" r="3" stroke-linecap="round"/></svg>
            </div>
            <div>
              <div class="c-method-lbl">Headquarters</div>
              <div class="c-method-val" style="font-size:.92rem">{{ $site['contact']['address'] ?? '4820 Fairway Drive, Atlanta, GA 30301' }}</div>
            </div>
          </div>

        </div>

        <!-- Hours -->
        <div class="hours-box reveal d3" aria-label="Office hours">
          <h4>
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Office Hours
          </h4>
          <div class="hours-row">
            <span class="hours-day">Monday – Friday</span>
            <span class="hours-time">8:00 AM – 6:00 PM</span>
          </div>
          <div class="hours-row">
            <span class="hours-day">Saturday</span>
            <span class="hours-time">9:00 AM – 2:00 PM</span>
          </div>
          <div class="hours-row">
            <span class="hours-day">Sunday</span>
            <span class="hours-closed">Closed</span>
          </div>
        </div>

      </div>

      <!-- Form -->
      <div class="form-panel reveal d2" role="region" aria-labelledby="form-h">
        <h3 id="form-h">Request a Free Quote</h3>
        <p>Fill out the form below and we'll respond within one business day with a no-obligation consultation.</p>

        <form novalidate action="{{ route('contactus.store') }}" method="post" aria-label="Project quote request form" id="quote-form">
          @csrf

          <div class="form-row-2">
            <div class="fld">
              <label for="fn">First Name<span class="req" aria-hidden="true">*</span></label>
              <input type="text" id="fn" name="first_name" placeholder="John" required autocomplete="given-name" aria-required="true"/>
            </div>
            <div class="fld">
              <label for="ln">Last Name<span class="req" aria-hidden="true">*</span></label>
              <input type="text" id="ln" name="last_name" placeholder="Smith" required autocomplete="family-name" aria-required="true"/>
            </div>
          </div>

          <div class="fld">
            <label for="em">Email Address<span class="req" aria-hidden="true">*</span></label>
            <input type="email" id="em" name="email" placeholder="john@example.com" required autocomplete="email" aria-required="true"/>
          </div>

          <div class="fld">
            <label for="ph">Phone Number</label>
            <input type="tel" id="ph" name="phone" placeholder="(555) 000-0000" autocomplete="tel"/>
          </div>

          <div class="fld">
            <label for="pt-trigger">Project Type<span class="req" aria-hidden="true">*</span></label>
            <div class="custom-select" data-custom-select>
              <select id="pt" name="project_type" class="custom-select-native" required aria-required="true" aria-hidden="true" tabindex="-1">
                <option value="" disabled selected>Select your project type…</option>
                <optgroup label="Golf Course">
                  <option value="golf-new">New Golf Course Construction</option>
                  <option value="golf-reno">Golf Course Renovation</option>
                  <option value="golf-green">Green Rebuild Only</option>
                </optgroup>
                <optgroup label="Athletic Fields">
                  <option value="field-new">New Athletic Field Construction</option>
                  <option value="field-reno">Athletic Field Renovation</option>
                  <option value="field-complex">Multi-Field Complex</option>
                </optgroup>
                <option value="other">Other / Not Sure Yet</option>
              </select>
            </div>
          </div>

          <div class="fld fld-message">
            <label for="msg">Tell Us About Your Project</label>
            <textarea id="msg" name="message" rows="4" placeholder="Project location, size, timeline, budget range, or any questions…"></textarea>
          </div>

          <div class="form-alert" id="form-alert" role="status" aria-live="polite" hidden></div>

          <button type="submit" class="btn btn-primary btn-lg submit-btn">
            <svg viewBox="0 0 24 24" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            Send My Quote Request
          </button>

          <p class="form-note">
            By submitting, you agree to our <a href="#">Privacy Policy</a>. We never share your information. Expect a response within 1 business day.
          </p>
        </form>
      </div>

    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════
     CTA STRIP
═══════════════════════════════════════════════════ -->
<section class="cta-strip section-pad-sm" aria-labelledby="cta-h">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-text reveal">
        <h2 id="cta-h">Ready to Break Ground?</h2>
        <p>Join 450+ satisfied clients who trusted Prime Field and Course Solutions to build their most important playing surfaces. Let's make yours next.</p>
      </div>
      <div class="cta-btns reveal d2">
        <a href="tel:{{ $site['contact']['phone_href'] ?? '18005550190' }}" class="btn btn-gold btn-lg">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 11.91 19.79 19.79 0 0 1 1.61 3.3 2 2 0 0 1 3.59 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.56a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.69 16l.31.92z" stroke-linecap="round"/></svg>
          Call {{ $site['contact']['phone'] ?? '1-800-555-0190' }}
        </a>
        <a href="#contact" class="btn btn-ghost btn-lg">Get a Free Quote</a>
      </div>
    </div>
  </div>
</section>


</main>
@endsection
