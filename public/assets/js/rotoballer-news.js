(function () {
  const feed = document.getElementById('rotoballer-news-feed');
  const wrapper = document.getElementById('rb-news-swiper-wrapper');
  const updatedEl = document.getElementById('rotoballer-news-updated');
  const descEl = document.getElementById('rotoballer-news-desc');
  const controlsEl = feed?.querySelector('.rb-news-controls');

  if (!feed || !wrapper) {
    return;
  }

  const endpoint = feed.dataset.endpoint;
  let refreshMs = Number(feed.dataset.refreshMs || 300000);
  let refreshTimer = null;
  let isFetching = false;
  let newsSwiper = null;

  const escapeHtml = (value) => String(value)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');

  const formatDate = (iso) => {
    if (!iso) {
      return '';
    }

    return new Date(iso).toLocaleString(undefined, {
      month: 'short',
      day: 'numeric',
      year: 'numeric',
      hour: 'numeric',
      minute: '2-digit',
    });
  };

  const formatCategory = (category) => category.replace(/-/g, ' ');

  const truncate = (text, limit) => {
    if (!text || text.length <= limit) {
      return text || '';
    }

    return text.slice(0, limit).trim() + '…';
  };

  const renderCard = (item) => {
    const category = item.category
      ? `<span class="rb-news-tag">${escapeHtml(formatCategory(item.category))}</span>`
      : '';
    const date = item.updated_at
      ? `<time class="rb-news-date" datetime="${escapeHtml(item.updated_at)}">${escapeHtml(formatDate(item.updated_at))}</time>`
      : '';
    const link = item.detail_url
      ? `<a href="${escapeHtml(item.detail_url)}" class="read-more">Read full story &rarr;</a>`
      : '';

    return `
      <div class="swiper-slide">
        <article class="rb-news-card">
          <div class="rb-news-card__top">
            ${category}
            ${date}
          </div>
          <h3 class="rb-news-title">${escapeHtml(item.title || 'Untitled')}</h3>
          <p class="rb-news-excerpt">${escapeHtml(truncate(item.content, 220))}</p>
          <div class="rb-news-card__foot">
            <span class="rb-news-source">${escapeHtml(item.source || 'RotoBaller')}</span>
            ${link}
          </div>
        </article>
      </div>
    `;
  };

  const initSwiper = () => {
    const swiperEl = feed.querySelector('.rb-news-swiper');
    const slides = wrapper.querySelectorAll('.swiper-slide .rb-news-card');

    if (newsSwiper) {
      newsSwiper.destroy(true, true);
      newsSwiper = null;
    }

    if (!swiperEl || slides.length === 0 || typeof Swiper === 'undefined') {
      if (controlsEl) {
        controlsEl.style.display = 'none';
      }

      return;
    }

    if (controlsEl) {
      controlsEl.style.display = slides.length > 1 ? '' : 'none';
    }

    newsSwiper = new Swiper(swiperEl, {
      slidesPerView: 1,
      spaceBetween: 20,
      grabCursor: true,
      watchOverflow: true,
      pagination: {
        el: feed.querySelector('.rb-news-pagination'),
        clickable: true,
        bulletClass: 'car-dot',
        bulletActiveClass: 'on',
      },
      breakpoints: {
        600: {
          slidesPerView: 2,
        },
        900: {
          slidesPerView: 3,
        },
      },
    });

    const prevBtn = feed.querySelector('.rb-news-prev');
    const nextBtn = feed.querySelector('.rb-news-next');

    if (prevBtn) {
      prevBtn.onclick = () => newsSwiper?.slidePrev();
    }

    if (nextBtn) {
      nextBtn.onclick = () => newsSwiper?.slideNext();
    }
  };

  const renderItems = (items) => {
    const latestItems = Array.isArray(items) ? items.slice(0, 6) : [];

    if (latestItems.length === 0) {
      wrapper.innerHTML = `
        <div class="swiper-slide">
          <p class="body-lg rb-news-empty">No RotoBaller news available right now.</p>
        </div>
      `;

      initSwiper();

      return;
    }

    wrapper.innerHTML = latestItems.map(renderCard).join('');
    initSwiper();
  };

  const renderUpdated = (payload) => {
    if (!updatedEl) {
      return;
    }

    if (payload.error) {
      updatedEl.textContent = payload.error;

      return;
    }

    const when = payload.updated_at
      ? new Date(payload.updated_at).toLocaleTimeString(undefined, { hour: 'numeric', minute: '2-digit' })
      : 'just now';

    updatedEl.textContent = `Last updated ${when}. Auto-refreshing every ${Math.round(refreshMs / 1000)} seconds.`;
  };

  const updateDesc = (seconds) => {
    if (!descEl || !seconds) {
      return;
    }

    descEl.textContent = `Latest PGA Tour player news and matchup outlooks from RotoBaller. Auto-refreshes every ${seconds} seconds.`;
  };

  const fetchNews = async () => {
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
        throw new Error('News request failed');
      }

      const payload = await response.json();

      if (payload.refresh_seconds) {
        refreshMs = Number(payload.refresh_seconds) * 1000;
        feed.dataset.refreshMs = String(refreshMs);
        updateDesc(payload.refresh_seconds);
      }

      renderItems(payload.items || []);
      renderUpdated(payload);
    } catch (error) {
      if (updatedEl) {
        updatedEl.textContent = 'Unable to refresh RotoBaller news right now.';
      }
    } finally {
      isFetching = false;
    }
  };

  const scheduleRefresh = () => {
    if (refreshTimer) {
      clearInterval(refreshTimer);
    }

    refreshTimer = setInterval(fetchNews, refreshMs);
  };

  initSwiper();
  fetchNews();
  scheduleRefresh();
})();
