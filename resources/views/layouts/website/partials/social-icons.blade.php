@php
    $size = $size ?? 15;
    $social = $site['social'] ?? [];
    $icons = [
        'spotify' => ['class' => 'sp', 'label' => 'Spotify', 'path' => 'M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.36-.66.48-1.021.24-2.82-1.74-6.36-2.1-10.561-1.14-.418.12-.779-.18-.899-.54-.12-.42.18-.78.54-.9 4.56-1.02 8.52-.6 11.64 1.32.42.18.479.66.301 1.02z'],
        'instagram' => ['class' => 'ig', 'label' => 'Instagram', 'stroke' => true],
        'youtube' => ['class' => 'yt', 'label' => 'YouTube', 'path' => 'M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z'],
        'facebook' => ['class' => 'fb', 'label' => 'Facebook', 'path' => 'M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z'],
        'twitter' => ['class' => 'fb', 'label' => 'Twitter/X', 'path' => 'M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z'],
        'linkedin' => ['class' => 'fb', 'label' => 'LinkedIn', 'path' => 'M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zM4 6a2 2 0 1 0 0-4 2 2 0 0 0 0 4z'],
        'tiktok' => ['class' => 'ig', 'label' => 'TikTok', 'path' => 'M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5'],
    ];
@endphp

@foreach ($icons as $key => $icon)
    @if (!empty($social[$key]))
        <a class="sb {{ $icon['class'] }}" href="{{ $social[$key] }}" target="_blank" rel="noopener" aria-label="{{ $icon['label'] }}">
            @if (!empty($icon['stroke']))
                <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
            @elseif ($key === 'youtube')
                <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="currentColor">
                    <path d="{{ $icon['path'] }}"></path>
                    <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="var(--bg0)"></polygon>
                </svg>
            @else
                <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="currentColor">
                    <path d="{{ $icon['path'] }}"></path>
                </svg>
            @endif
        </a>
    @endif
@endforeach
