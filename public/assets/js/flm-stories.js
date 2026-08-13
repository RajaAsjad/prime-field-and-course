(function () {
  const feed = document.getElementById('flm-stories-feed');
  const wrapper = document.getElementById('flm-stories-wrapper');
  const updatedEl = document.getElementById('flm-stories-updated');
  const descEl = document.getElementById('flm-stories-desc');
  const controlsEl = feed?.querySelector('.flm-stories-controls');

  if (!feed || !wrapper) {
    return;
  }

  const endpoint = feed.dataset.endpoint;
  let refreshMs = Number(feed.dataset.refreshMs || 300000);
  let refreshTimer = null;
  let isFetching = false;
  let storiesSwiper = null;

  const escapeHtml = (value) => String(value)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');

  const renderCard = (story, index) => {
    const odd = index % 2 === 0;
    const bg = odd ? '#fdf8ec,#f5edcc' : '#edf7f0,#d4eddb';
    const tagClass = odd ? ' art-tag gold-tag' : ' art-tag';
    const image = story.image
      ? `<img src="${escapeHtml(story.image)}" alt="${escapeHtml(story.title || '')}" width="800" height="500" loading="lazy" decoding="async" />`
      : '';
    const tag = story.category
      ? `<span class="${tagClass}">${escapeHtml(story.category)}</span>`
      : '';

    return `
      <div class="swiper-slide">
        <a href="${escapeHtml(story.url || '#')}" class="art-card" style="text-decoration:none;color:inherit;">
          <div class="art-img" style="position:relative;background:linear-gradient(135deg,${bg})">
            ${image}
            ${tag}
          </div>
          <div class="art-body">
            <h3 class="art-title">${escapeHtml(story.title || '')}</h3>
            <p class="art-desc">${escapeHtml(story.excerpt || '')}</p>
          </div>
        </a>
      </div>
    `;
  };

  const syncNavButtons = (swiper, prevBtn, nextBtn) => {
    if (!swiper) {
      return;
    }

    const atStart = swiper.isBeginning;
    const atEnd = swiper.isEnd;

    if (prevBtn) {
      prevBtn.disabled = atStart;
      prevBtn.classList.toggle('is-disabled', atStart);
      prevBtn.setAttribute('aria-disabled', atStart ? 'true' : 'false');
    }

    if (nextBtn) {
      nextBtn.disabled = atEnd;
      nextBtn.classList.toggle('is-disabled', atEnd);
      nextBtn.setAttribute('aria-disabled', atEnd ? 'true' : 'false');
    }
  };

  const initSwiper = () => {
    const swiperEl = feed.querySelector('.flm-stories-swiper');
    const slides = wrapper.querySelectorAll('.swiper-slide .art-card');

    if (storiesSwiper) {
      storiesSwiper.destroy(true, true);
      storiesSwiper = null;
    }

    if (!swiperEl || slides.length === 0 || typeof Swiper === 'undefined') {
      if (controlsEl) {
        controlsEl.style.display = 'none';
      }

      return;
    }

    if (controlsEl) {
      controlsEl.style.display = '';
    }

    const prevBtn = feed.querySelector('.flm-stories-prev');
    const nextBtn = feed.querySelector('.flm-stories-next');

    storiesSwiper = new Swiper(swiperEl, {
      slidesPerView: 1,
      spaceBetween: 18,
      grabCursor: true,
      watchOverflow: true,
      pagination: {
        el: feed.querySelector('.flm-stories-pagination'),
        clickable: true,
        bulletClass: 'car-dot',
        bulletActiveClass: 'on',
      },
      navigation: {
        prevEl: prevBtn,
        nextEl: nextBtn,
        disabledClass: 'is-disabled',
      },
      breakpoints: {
        700: { slidesPerView: 2 },
        1100: { slidesPerView: 4 },
      },
      on: {
        init: (swiper) => syncNavButtons(swiper, prevBtn, nextBtn),
        slideChange: (swiper) => syncNavButtons(swiper, prevBtn, nextBtn),
        reachBeginning: (swiper) => syncNavButtons(swiper, prevBtn, nextBtn),
        reachEnd: (swiper) => syncNavButtons(swiper, prevBtn, nextBtn),
        fromEdge: (swiper) => syncNavButtons(swiper, prevBtn, nextBtn),
        resize: (swiper) => syncNavButtons(swiper, prevBtn, nextBtn),
      },
    });
  };

  const render = (payload) => {
    const items = Array.isArray(payload?.items) ? payload.items : [];

    if (items.length === 0) {
      wrapper.innerHTML = `<div class="swiper-slide"><p class="body-lg">${escapeHtml(payload?.error || 'No golf stories available right now.')}</p></div>`;
    } else {
      wrapper.innerHTML = items.map((story, index) => renderCard(story, index)).join('');
    }

    initSwiper();

    if (updatedEl) {
      if (payload?.error && items.length === 0) {
        updatedEl.textContent = payload.error;
      } else if (payload?.updated_at) {
        const date = new Date(payload.updated_at);
        updatedEl.textContent = `${items.length} stories · Updated ` + date.toLocaleTimeString(undefined, {
          hour: 'numeric',
          minute: '2-digit',
          second: '2-digit',
        });
      } else {
        updatedEl.textContent = 'Updating automatically…';
      }
    }

    if (descEl && payload?.refresh_seconds) {
      descEl.textContent = `Latest golf coverage from Field Level Media — previews, recaps, and news. Showing ${items.length} stories. Auto-refreshes every ${payload.refresh_seconds} seconds.`;
    }
  };

  const fetchStories = async () => {
    if (!endpoint || isFetching) {
      return;
    }

    isFetching = true;

    try {
      const response = await fetch(endpoint, {
        headers: { Accept: 'application/json' },
        cache: 'no-store',
      });

      if (!response.ok) {
        throw new Error('Request failed');
      }

      const payload = await response.json();
      render(payload);

      if (payload?.refresh_seconds) {
        refreshMs = Number(payload.refresh_seconds) * 1000;
      }
    } catch (error) {
      if (!wrapper.querySelector('.art-card')) {
        wrapper.innerHTML = '<div class="swiper-slide"><p class="body-lg">Unable to load golf stories right now.</p></div>';
        initSwiper();
      }

      if (updatedEl) {
        updatedEl.textContent = 'Unable to refresh Field Level Media stories right now.';
      }
    } finally {
      isFetching = false;
    }
  };

  initSwiper();
  fetchStories();
  refreshTimer = window.setInterval(fetchStories, refreshMs);
})();
