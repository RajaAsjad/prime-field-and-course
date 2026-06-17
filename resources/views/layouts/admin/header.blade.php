<header class="main-header admin-header">
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" aria-label="Toggle sidebar">
            <i class="fa fa-bars" aria-hidden="true"></i>
            <span class="sr-only">Toggle navigation</span>
        </a>
        <span class="admin-panel-title">{{ $site['admin']['panel_title'] ?? 'Admin Panel' }}</span>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ url('/') }}" target="_blank" class="nav-visit-website"><i class="fa fa-globe"></i> <span class="nav-visit-text">Visit Website</span></a>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (Auth::user()->image)
                            <img src="{{ asset('admin/assets/img') }}/{{ Auth::user()->image }}" class="user-image" alt="user photo">
                        @else
                            <img src="{{ asset('admin/assets/img/dummy-user.png') }}" class="user-image" alt="user photo">
                        @endif
                        <span class="hidden-xs"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="user-footer">
                            <div>
                                <a class="dropdown-item btn btn-default btn-flat" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <a href="{{ route('dashboard') }}" class="header-logo-link" aria-label="{{ $site['name'] ?? 'Admin' }} home">
        @if (!empty($home_page_data['header_logo']))
            <img id="header-logo" class="admin-header-logo-img"
                src="{{ asset('admin/assets/images/page/' . $home_page_data['header_logo']) }}"
                alt="{{ $site['name'] ?? 'Admin' }}">
        @else
            <span class="admin-header-logo-fallback">
                <span class="admin-header__mark" aria-hidden="true">{{ $site['short_name'] ?? 'AD' }}</span>
                <span class="admin-header__name">{{ $site['name'] ?? 'Admin' }}</span>
            </span>
        @endif
    </a>
</header>

<style>
    .hide-logo { display: none !important; }

    .page-header {
        margin: 0px 0 20px 0 !important;
        font-size: 22px;
    }

    /* Hide logo on scroll only on mobile */
    @media (max-width: 767px) {
        .admin-header.header-scrolled .header-logo-link {
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
        }
    }

    /* Navbar + toggle on top; logo sits in sidebar column below bar */
    .admin-header {
        position: relative;
    }

    .admin-header .header-logo-link {
        position: absolute;
        left: 0;
        top: 50px;
        width: 230px;
        height: 88px;
        display: flex;
        align-items: center;
        padding-left: 10px;
        z-index: 810;
        pointer-events: none;
        transition: visibility 0.2s ease, opacity 0.2s ease;
    }

    .admin-header .header-logo-link img,
    .admin-header .admin-header-logo-fallback {
        pointer-events: auto;
    }

    .admin-header #header-logo,
    .admin-header .admin-header-logo-fallback {
        width: 210px;
        max-width: calc(100% - 10px);
        height: 80px;
        object-fit: contain;
        object-position: left center;
        position: relative;
        top: auto;
        left: auto;
    }

    .admin-header .admin-header-logo-fallback {
        display: flex;
        align-items: center;
        gap: 10px;
        object-fit: unset;
    }

    .admin-header__mark {
        flex-shrink: 0;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--dash-font-display, Montserrat, sans-serif);
        font-weight: 800;
        font-size: 0.95rem;
        color: #fff;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--admin-pink), var(--admin-orange));
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .admin-header__name {
        font-weight: 700;
        font-size: 1.05rem;
        color: #fff;
        letter-spacing: -0.02em;
        line-height: 1.15;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
    }
    .admin-header .navbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        min-height: 50px;
        position: relative;
        z-index: 1032;
        width: 100%;
    }

    .admin-header .sidebar-toggle {
        padding: 12px 15px;
        margin: 0;
        min-width: 50px;
        min-height: 50px;
        text-align: center;
        position: relative;
        z-index: 1033;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff !important;
        font-size: 18px;
        line-height: 1;
    }

    .admin-header .sidebar-toggle:hover,
    .admin-header .sidebar-toggle:focus {
        color: #fff !important;
        background: color-mix(in srgb, var(--admin-orange, #ffd700) 18%, transparent);
    }
    .admin-header .admin-panel-title {
        float: left;
        line-height: 50px;
        color: #fff;
        padding-left: 10px;
        font-size: 18px;
        font-weight: 600;
    }
    .admin-header .navbar-custom-menu { margin-left: auto; }
    .admin-header .navbar-custom-menu .nav > li > a {
        padding: 15px 12px;
        min-height: 50px;
        display: flex;
        align-items: center;
    }
    .admin-header .nav-visit-website { white-space: nowrap; }
    .admin-header .user-image { max-width: 100%; height: auto; }
    .admin-header .dropdown-menu-right { right: 0; left: auto; }
    .admin-header .user-footer .btn { display: block; width: 100%; text-align: center; padding: 10px 15px; }

    @media (max-width: 768px) {
        .admin-header .navbar { padding-left: 0; padding-right: 0; }
        .admin-header .header-logo-link {
            width: 180px;
            height: 64px;
            padding-left: 8px;
        }

        .admin-header #header-logo,
        .admin-header .admin-header-logo-fallback {
            width: 140px;
            height: 56px;
        }

        .admin-header__mark {
            width: 38px;
            height: 38px;
            font-size: 0.85rem;
        }

        .admin-header__name {
            font-size: 0.95rem;
        }
        .admin-header .admin-panel-title { font-size: 15px; padding-left: 8px; }
        .admin-header .nav-visit-text { display: none; }
        .admin-header .nav-visit-website { padding: 15px 14px !important; font-size: 18px; }
        .admin-header .navbar-custom-menu .nav > li > a { padding: 15px 10px; }
        .admin-header .user-menu .user-image { width: 32px; height: 32px; }
    }
    @media (max-width: 576px) {
        .admin-header .header-logo-link {
            width: 150px;
            height: 52px;
            padding-left: 6px;
        }

        .admin-header #header-logo,
        .admin-header .admin-header-logo-fallback {
            width: 110px;
            height: 44px;
        }

        .admin-header__mark {
            width: 32px;
            height: 32px;
            font-size: 0.75rem;
        }

        .admin-header__name {
            font-size: 0.85rem;
        }
        .admin-header .admin-panel-title { font-size: 13px; padding-left: 6px; }
        .admin-header .sidebar-toggle { padding: 10px 12px; min-width: 44px; min-height: 44px; font-size: 16px; }
        .admin-header .navbar-custom-menu .nav > li > a { padding: 12px 8px; }
        .admin-header .user-menu .user-image { width: 28px; height: 28px; }
    }
    @media (max-width: 380px) {
        .admin-header .header-logo-link {
            width: 130px;
            height: 46px;
        }

        .admin-header #header-logo,
        .admin-header .admin-header-logo-fallback {
            width: 95px;
            height: 38px;
        }

        .admin-header__mark {
            width: 28px;
            height: 28px;
            font-size: 0.7rem;
        }

        .admin-header__name {
            font-size: 0.78rem;
        }

        .admin-header .admin-panel-title {
            font-size: 12px;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var header = document.querySelector('.admin-header');
        var toggle = document.querySelector('.sidebar-toggle');
        var logo = document.getElementById('header-logo')
            || document.querySelector('.admin-header-logo-fallback');
        var logoLink = document.querySelector('.header-logo-link');

        if (toggle && logoLink) {
            toggle.addEventListener('click', function() {
                logoLink.classList.toggle('hide-logo');
            });
        }

        function onScroll() {
            if (!header) return;
            var w = window.innerWidth;
            var is768 = (w >= 767 && w <= 769);
            if (!is768 && window.scrollY > 60) {
                header.classList.add('header-scrolled');
            } else {
                header.classList.remove('header-scrolled');
            }
        }
        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll);
        onScroll();
    });
</script>
