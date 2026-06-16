# Revamp Template — Usage Guide

Yeh project ek **reusable Laravel website revamp template** hai. Jab bhi kisi client ki website revamp karni ho, is project ko us website ke mutabiq customize karo.

## Quick Start (Nayi Website Revamp)

Jab user URL bheje aur kahe **"isy revamp krr do"**, yeh steps follow karo:

### 1. Website Analyze Karo
- User ka diya hua URL kholo aur poori site dekho
- Brand name, colors, fonts, logo, pages, content, contact info note karo
- Admin panel mein kya manage hona chahiye decide karo

### 2. Config Update Karo — `config/site.php` + `.env`

```env
SITE_NAME="Client Brand Name"
SITE_SHORT_NAME="CBN"
SITE_TAGLINE="Their tagline"
SITE_DESCRIPTION="SEO description"
SITE_SOURCE_URL="https://original-website.com"
SITE_EMAIL=contact@client.com
SITE_PHONE="(555) 123-4567"
SITE_COLOR_PRIMARY="#hex"
SITE_COLOR_SECONDARY="#hex"
SITE_COLOR_ACCENT="#hex"
```

`config/site.php` mein:
- `pages` array — navigation pages add/remove
- `social` links
- `features` — audio player, testimonials, etc. enable/disable
- `nav_cta` — header button

### 3. Routes Update Karo — `routes/web.php`

Naye pages ke liye route + WebController method add karo:

```php
Route::get('services', [WebController::class, 'Services'])->name('services');
```

### 4. Views Banayo — `resources/views/website/`

Har page ke liye Blade view banao jo `layouts.website.master` extend kare:

```blade
@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
    {{-- Page content --}}
@endsection
```

### 5. CSS/JS Customize Karo

| File | Purpose |
|------|---------|
| `public/assets/website/css/site.css` | Frontend theme & components |
| `public/assets/website/js/site.js` | Nav, forms, animations |
| `resources/views/layouts/website/master.blade.php` | Master layout (auto-reads config) |

Theme colors `config/site.php` → `theme` se auto-inject hote hain master layout mein.

### 6. Admin Dashboard Set Karo

Admin automatically `$site` config se branding leta hai:
- Login page → site name + short name
- Header → logo / brand name
- Dashboard → welcome message

Admin sidebar modules `resources/views/layouts/admin/sidebar.blade.php` mein hain.
Feature flags se enable karo jo client ko chahiye:

```php
'features' => [
    'video_gallery' => true,
    'testimonials' => true,
    'banners' => false,
],
```

### 7. CMS Content — Admin Panel

Page settings admin se manage hoti hain:
- Logo, favicon → Settings → Header/Footer
- Page content → Page Settings
- Videos, Contact forms → respective modules

---

## Project Structure

```
config/site.php          ← Single source of truth (brand, theme, pages, features)
routes/web.php           ← Public + admin routes
app/Http/Controllers/
  WebController.php      ← Public page controller
  admin/                 ← CMS CRUD controllers
resources/views/
  layouts/website/       ← Master, header, footer (config-driven)
  layouts/admin/         ← Admin panel layouts
  website/               ← Public pages (index, about, contact, ...)
  admin/                 ← Admin CRUD views
public/assets/website/
  css/site.css           ← Frontend theme
  js/site.js             ← Frontend interactions
  favicon.svg            ← Default favicon
```

## Shared Variables (All Views)

| Variable | Source |
|----------|--------|
| `$site` | `config/site.php` |
| `$home_page_data` | CMS PageSettings (database) |

Helper: `site('name')`, `site('contact.email')`, etc.

## Default Pages

| Route | View | Description |
|-------|------|-------------|
| `/` | `website.index` | Homepage placeholder |
| `/about` | `website.about` | About page placeholder |
| `/contact` | `website.contact` | Contact form |

## Admin Access

- URL: `/admin/login`
- Default seeder: check `database/seeders/AdminUserSeeder.php`

---

## Revamp Checklist

- [ ] `config/site.php` + `.env` updated with client brand
- [ ] Original URL saved in `SITE_SOURCE_URL`
- [ ] Navigation pages match client site
- [ ] Routes added for all pages
- [ ] Views created with client content & design
- [ ] `site.css` themed to match client colors/layout
- [ ] `site.js` updated for page-specific features
- [ ] Admin branding matches client
- [ ] Admin modules enabled per client needs
- [ ] Contact form wired to backend (if needed)
- [ ] Favicon/logo uploaded via admin or assets folder
- [ ] Legacy/orphan views removed
