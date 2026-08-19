<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h3>@yield('title', 'Dashboard')</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">
                        <svg class="stroke-icon">
                            <use href="/assets/admin/svg/icon-sprite.svg#stroke-home"></use>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item active">@yield('title', 'Dashboard')</li>
            </ol>
        </div>
    </div>
</div>
