@extends('layouts.website.master')

@section('title', $page_title)
@section('meta_description', 'About ' . ($site['name'] ?? 'us'))

@section('content')
<div class="page">
    <section class="abt-hero mesh">
        <div class="c" style="position:relative;z-index:1">
            <span class="badge bp" style="margin-bottom:20px">About Us</span>
            <h1 style="font-family:var(--ff-display);font-weight:700;font-size:clamp(2.8rem,7vw,5rem);line-height:1.05;color:var(--text)">
                About <span class="gt">{{ $site['name'] ?? 'Us' }}</span>
            </h1>
        </div>
    </section>

    <div class="sec">
        <div class="c">
            <div class="abt-og">
                <div>
                    <span class="sl rev" style="display:block;margin-bottom:16px">Our Story</span>
                    <h2 class="sttl lg rev" data-delay="100" style="margin-bottom:24px">Your About Content Goes Here</h2>
                    <div class="ogp rev" data-delay="200">
                        <p>Add your client's brand story, mission, and values here when revamping their website.</p>
                        <p>This page pulls branding from <code style="color:var(--primary)">config/site.php</code> and can be extended with CMS content from the admin panel.</p>
                    </div>
                </div>
                <div class="rev" data-delay="300">
                    <div style="aspect-ratio:4/3;border-radius:20px;background:var(--bg2);display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,.06)">
                        <span style="font-family:var(--ff-mono);font-size:.85rem;color:var(--dim)">About Image</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
