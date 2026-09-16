@if ($gallerySlides->isNotEmpty())
  <section id="gallery-slider" class="home-gallery">
    <div class="wrap">
      <div class="swiper home-gallery-swiper">
        <div class="swiper-wrapper">
          @foreach ($gallerySlides as $slide)
            <div class="swiper-slide">
              @if ($slide->link_url)
                <a href="{{ $slide->link_url }}" class="home-gallery__link" target="_blank" rel="noopener noreferrer">
                  <img
                    src="{{ $slide->imageUrl() }}"
                    alt="{{ $slide->title ?: 'Gallery image' }}"
                    class="home-gallery__img"
                    loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                    decoding="async"
                  />
                </a>
              @else
                <img
                  src="{{ $slide->imageUrl() }}"
                  alt="{{ $slide->title ?: 'Gallery image' }}"
                  class="home-gallery__img"
                  loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                  decoding="async"
                />
              @endif
              @if ($slide->title)
                <span class="home-gallery__caption">{{ $slide->title }}</span>
              @endif
            </div>
          @endforeach
        </div>
      </div>
      <div class="home-gallery__controls">
        <button type="button" class="car-btn home-gallery-prev" aria-label="Previous gallery image">&#9664;</button>
        <button type="button" class="car-btn home-gallery-next" aria-label="Next gallery image">&#9654;</button>
      </div>
    </div>
  </section>
@endif
