(function () {
  function initHomeGallery() {
    var el = document.querySelector('.home-gallery-swiper');
    if (!el || typeof Swiper === 'undefined') {
      return;
    }

    var slideCount = el.querySelectorAll('.swiper-slide').length;

    new Swiper(el, {
      slidesPerView: 1,
      spaceBetween: 12,
      loop: slideCount > 1,
      speed: 650,
      watchOverflow: true,
      grabCursor: true,
      resistanceRatio: 0.65,
      autoplay: slideCount > 1 ? {
        delay: 4500,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      } : false,
      breakpoints: {
        480: {
          slidesPerView: 1,
          spaceBetween: 14,
        },
        640: {
          slidesPerView: Math.min(2, slideCount),
          spaceBetween: 16,
          loop: slideCount > 2,
        },
        992: {
          slidesPerView: Math.min(3, slideCount),
          spaceBetween: 20,
          loop: slideCount > 3,
        },
      },
      navigation: {
        nextEl: '.home-gallery-next',
        prevEl: '.home-gallery-prev',
      },
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHomeGallery);
  } else {
    initHomeGallery();
  }
})();
