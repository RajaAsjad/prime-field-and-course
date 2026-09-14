@php
    $settings = $siteSettings ?? site_settings();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>@yield('title', $settings->displaySiteName() . ' & Promotions')</title>
  <meta name="description"
    content="@yield('meta_description', 'Golf betting tips, expert picks, exclusive sportsbook bonuses, live odds comparison.')" />
  @include('partials.favicon')
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="/assets/css/style.css?v={{ filemtime(public_path('assets/css/style.css')) }}" />
  @stack('styles')
  <meta name="google-site-verification" content="HzOShKEpv67djcRg0bgRNWDXYPgmGkYNdvxMRLW6g4o" />
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-YXZ35PRPRP"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-YXZ35PRPRP');
  </script>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-56Z87DLZ');</script>
  <!-- End Google Tag Manager -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@type": "WebSite",
    "name": "Pinshot",
    "url": "https://pinshot.com/",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "https://pinshot.com/{search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }
  </script>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Pinshot",
    "alternateName": "Golf Betting Site",
    "url": "https://pinshot.com/",
    "logo": "https://pinshot.com/storage/site-settings/uQGJATtbzOXPikAHkimUTXmmp2Xq2qFTfDw8NO19.png",
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "(636) 579-0718",
      "contactType": "customer service",
      "areaServed": "US",
      "availableLanguage": "en"
    }
  }
  </script>
  <meta name="geo.region" content="US" />
  <meta name="geo.position" content="39.78373;-100.445882" />
  <meta name="ICBM" content="39.78373, -100.445882" />
</head>

<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-56Z87DLZ"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  {{-- Header include --}}
  @include('partials.header')

  @yield('content')

  {{-- Footer include --}}
  @include('partials.footer')

  {{-- Global scripts --}}
  <script src="/assets/js/main.js"></script>
  @stack('scripts')
</body>

</html>
