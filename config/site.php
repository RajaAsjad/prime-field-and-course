<?php

/**
 * Site configuration — Prime Field and Course Solutions LLC
 */
return [

    'name' => env('SITE_NAME', 'Prime Field and Course Solutions LLC'),
    'short_name' => env('SITE_SHORT_NAME', 'Prime Field'),
    'tagline' => env('SITE_TAGLINE', 'Golf Course & Athletic Field Construction'),
    'description' => env('SITE_DESCRIPTION', 'Prime Field and Course Solutions LLC — Expert golf course and athletic field construction since 1990. Serving clubs, schools, and municipalities nationwide.'),
    'source_url' => env('SITE_SOURCE_URL', ''),

    'contact' => [
        'email' => env('SITE_EMAIL', 'info@primefieldcourse.com'),
        'phone' => env('SITE_PHONE', '1-800-555-0190'),
        'phone_href' => env('SITE_PHONE_HREF', '18005550190'),
        'response_note' => env('SITE_RESPONSE_NOTE', 'We respond within one business day'),
        'address' => env('SITE_ADDRESS', '4820 Fairway Drive, Atlanta, GA 30301'),
    ],

    'social' => [
        'facebook' => env('SITE_FACEBOOK', '#'),
        'instagram' => env('SITE_INSTAGRAM', '#'),
        'twitter' => env('SITE_TWITTER', ''),
        'linkedin' => env('SITE_LINKEDIN', '#'),
        'youtube' => env('SITE_YOUTUBE', '#'),
        'spotify' => env('SITE_SPOTIFY', ''),
        'tiktok' => env('SITE_TIKTOK', ''),
    ],

    'pages' => [
        ['label' => 'About', 'url' => '/#about'],
        ['label' => 'Services', 'url' => '/#services'],
        ['label' => 'Process', 'url' => '/#process'],
        ['label' => 'Portfolio', 'url' => '/#portfolio'],
        ['label' => 'Contact', 'url' => '/#contact'],
    ],

    'nav_cta' => [
        'enabled' => true,
        'label' => 'Get a Free Quote',
        'url' => '/#contact',
    ],

    'footer' => [
        'about_text' => env('SITE_FOOTER_TEXT', 'Building championship golf courses and world-class athletic fields since 1990. Licensed, certified, and built to last.'),
        'copyright' => env('SITE_COPYRIGHT', ''),
    ],

    'agency' => [
        'enabled' => env('SITE_AGENCY_ENABLED', false),
        'name' => env('SITE_AGENCY_NAME', 'US Design Agency'),
        'url' => env('SITE_AGENCY_URL', 'https://www.usdesignagency.com/'),
    ],

    'theme' => [
        'mode' => env('SITE_THEME_MODE', 'light'),
        'primary' => env('SITE_COLOR_PRIMARY', '#1f7a1f'),
        'secondary' => env('SITE_COLOR_SECONDARY', '#ffd700'),
        'accent' => env('SITE_COLOR_ACCENT', '#268c26'),
        'background' => env('SITE_COLOR_BG', '#ffffff'),
        'theme_color' => env('SITE_THEME_COLOR', '#1a5c1a'),
        'fonts' => [
            'display' => 'Montserrat, sans-serif',
            'heading' => 'Montserrat, sans-serif',
            'body' => 'Poppins, sans-serif',
            'mono' => 'Poppins, sans-serif',
        ],
        'google_fonts' => 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700&family=Poppins:wght@300;400;500;600&display=swap',
        'fontshare' => '',
    ],

    'admin' => [
        'panel_title' => env('SITE_ADMIN_PANEL_TITLE', 'Prime Field Admin'),
        'welcome_message' => env('SITE_ADMIN_WELCOME', ''),
        'dashboard_subtitle' => env('SITE_ADMIN_DASHBOARD_SUBTITLE', 'Manage your website content'),
        'theme' => [
            'primary' => env('SITE_ADMIN_PRIMARY', '#1f7a1f'),
            'secondary' => env('SITE_ADMIN_SECONDARY', '#ffd700'),
            'primary_dark' => env('SITE_ADMIN_PRIMARY_DARK', '#145214'),
            'shell' => env('SITE_ADMIN_SHELL', '#0d2e0d'),
            'surface' => env('SITE_ADMIN_SURFACE', '#f0faf0'),
            'surface_mid' => env('SITE_ADMIN_SURFACE_MID', '#eef5ee'),
            'text' => env('SITE_ADMIN_TEXT', '#0d1a0d'),
        ],
    ],

    'features' => [
        'audio_player' => false,
        'marquee' => false,
        'testimonials' => false,
        'video_gallery' => true,
        'photo_gallery' => false,
        'banners' => false,
        'home_slider' => false,
        'shop_contact' => false,
    ],

    'assets' => [
        'css' => 'assets/website/css/site.css',
        'js' => 'assets/website/js/site.js',
        'favicon' => 'assets/website/favicon.svg',
        'logo_icon' => '',
    ],

];
