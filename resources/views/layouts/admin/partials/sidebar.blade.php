@php
    $modules = dynamic_sidebar();

    $isRouteActive = function (string $routeName): bool {
        $pattern = str_ends_with($routeName, '.index')
            ? preg_replace('/\.index$/', '.*', $routeName)
            : (str_ends_with($routeName, '.edit')
                ? preg_replace('/\.edit$/', '.*', $routeName)
                : $routeName);

        return str_contains($pattern, '*')
            ? request()->routeIs($pattern)
            : request()->routeIs($routeName);
    };

    $routePath = function (string $routeName): string {
        if (! Route::has($routeName)) {
            return '#';
        }

        return parse_url(route($routeName), PHP_URL_PATH) ?: '#';
    };
@endphp

<div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
    <div class="logo-wrapper">
        <a href="{{ route('admin.dashboard') }}" class="admin-brand-logo" aria-label="Prime Field &amp; Course Solutions LLC">
            @include('partials.brand-logo')
        </a>

        <div class="back-btn">
            <i class="fa-solid fa-angle-left"></i>
        </div>
    </div>

    <nav class="sidebar-main">
        <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn">
                    <div class="mobile-back text-end">
                        <span>Back</span>
                        <i class="fa-solid fa-angle-right ps-2" aria-hidden="true"></i>
                    </div>
                </li>

                @foreach ($modules as $module)
                    @php
                        $hasChildren = $module->children && $module->children->count() > 0;
                        $isActive = $hasChildren
                            ? $module->children->contains(fn ($child) => $isRouteActive($child->route_name))
                            : $isRouteActive($module->route_name);
                    @endphp

                    <li class="sidebar-list {{ $isActive && $hasChildren ? 'active' : '' }}">
                        <a
                            href="{{ $hasChildren ? '#' : $routePath($module->route_name) }}"
                            class="sidebar-link sidebar-title {{ $hasChildren ? '' : 'link-nav' }} {{ $isActive ? 'active' : '' }}"
                            @if ($hasChildren) aria-expanded="{{ $isActive ? 'true' : 'false' }}" @endif
                        >
                            <span class="theme-icons">
                                <i class="{{ $module->icon }}"></i>
                            </span>

                            <span>{{ $module->name }}</span>

                            @if ($hasChildren)
                                <div class="according-menu">
                                    <i class="fa-solid fa-angle-{{ $isActive ? 'down' : 'right' }}"></i>
                                </div>
                            @endif
                        </a>

                        @if ($hasChildren)
                            <ul class="sidebar-submenu" @if ($isActive) style="display: block;" @endif>
                                @foreach ($module->children as $child)
                                    @php
                                        $childIsActive = $isRouteActive($child->route_name);
                                    @endphp
                                    <li>
                                        <a
                                            href="{{ $routePath($child->route_name) }}"
                                            class="{{ $childIsActive ? 'active' : '' }}"
                                        >
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
</div>
