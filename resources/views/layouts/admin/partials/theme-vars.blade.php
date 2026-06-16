@php
    $adminTheme = $site['admin']['theme'] ?? [];
    $primary = $adminTheme['primary'] ?? '#1f7a1f';
    $secondary = $adminTheme['secondary'] ?? '#ffd700';
    $primaryDark = $adminTheme['primary_dark'] ?? '#145214';
    $shell = $adminTheme['shell'] ?? '#0d2e0d';
    $surface = $adminTheme['surface'] ?? '#f0faf0';
    $surfaceMid = $adminTheme['surface_mid'] ?? '#eef5ee';
    $text = $adminTheme['text'] ?? '#0d1a0d';
    $displayFont = $site['theme']['fonts']['display'] ?? 'Montserrat, sans-serif';
    $bodyFont = $site['theme']['fonts']['body'] ?? 'Poppins, sans-serif';
@endphp
<style>
    :root {
        --admin-shell: {{ $shell }};
        --admin-pink: {{ $primary }};
        --admin-pink-deep: {{ $primaryDark }};
        --admin-orange: {{ $secondary }};
        --admin-cream: {{ $surface }};
        --admin-cream-mid: {{ $surfaceMid }};
        --admin-text: {{ $text }};

        --auth-surface: {{ $surface }};
        --auth-card: #ffffff;
        --auth-brand-500: {{ $primary }};
        --auth-brand-600: {{ $primaryDark }};
        --auth-accent: {{ $secondary }};
        --auth-text: {{ $text }};
        --auth-muted: #6a7a6a;
        --auth-border: color-mix(in srgb, {{ $primary }} 15%, transparent);
        --auth-font-display: {{ $displayFont }};
        --auth-font-body: {{ $bodyFont }};

        --dash-surface: {{ $surface }};
        --dash-surface-mid: {{ $surfaceMid }};
        --dash-primary: {{ $primary }};
        --dash-primary-dark: {{ $primaryDark }};
        --dash-secondary: {{ $secondary }};
        --dash-text: {{ $text }};
        --dash-muted: #6a7a6a;
        --dash-font-display: {{ $displayFont }};
        --dash-font-body: {{ $bodyFont }};
    }
</style>
