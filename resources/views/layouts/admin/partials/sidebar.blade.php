@php
    $modules = dynamic_sidebar();
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
                        $activePattern = str_ends_with($module->route_name, '.index')
                            ? preg_replace('/\.index$/', '.*', $module->route_name)
                            : (str_ends_with($module->route_name, '.edit')
                                ? preg_replace('/\.edit$/', '.*', $module->route_name)
                                : $module->route_name);
                        $isActive = str_contains($activePattern, '*')
                            ? request()->routeIs($activePattern)
                            : request()->routeIs($module->route_name);
                    @endphp

                    <li class="sidebar-list">
                        <a
                            href="{{ $hasChildren ? '#' : (Route::has($module->route_name) ? route($module->route_name) : '#') }}"
                            class="sidebar-link sidebar-title {{ $hasChildren ? '' : 'link-nav' }} {{ $isActive ? 'active' : '' }}"
                            @if ($hasChildren) aria-expanded="false" @endif
                        >
                            <span class="theme-icons">
                                <i class="{{ $module->icon }}"></i>
                            </span>

                            <span>{{ $module->name }}</span>

                            @if ($hasChildren)
                                <div class="according-menu">
                                    <i class="fa-solid fa-angle-right"></i>
                                </div>
                            @endif
                        </a>

                        @if ($hasChildren)
                            <ul class="sidebar-submenu">
                                @foreach ($module->children as $child)
                                    <li>
                                        <a href="{{ Route::has($child->route_name) ? route($child->route_name) : '#' }}">
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
