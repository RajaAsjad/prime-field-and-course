@php
    $pgPrimary = $site['admin']['theme']['primary'] ?? '#1f7a1f';
    $pgPrimaryDark = $site['admin']['theme']['primary_dark'] ?? '#145214';
    $pgSecondary = $site['admin']['theme']['secondary'] ?? '#ffd700';
    $pgSurface = $site['admin']['theme']['surface'] ?? '#f0faf0';
    $pgText = $site['admin']['theme']['text'] ?? '#0d1a0d';
@endphp
.page-admin {
    --pg-pink: {{ $pgPrimary }};
    --pg-pink-deep: {{ $pgPrimaryDark }};
    --pg-orange: {{ $pgSecondary }};
    --pg-cream: {{ $pgSurface }};
    --pg-text: {{ $pgText }};
}
