(function () {
  const feed = document.getElementById('rotoballer-news-feed');
  const wrapper = document.getElementById('rb-news-wrapper');
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
          <p class="rb-news-excerpt">${escapeHtml(truncate(item.content, 160))}</p>
          <div class="rb-news-card__foot">
            <span class="rb-news-source">${escapeHtml(item.source || 'RotoBaller')}</span>
            ${link}
          </div>
        </article>
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
      controlsEl.style.display = '';
    }

    const prevBtn = feed.querySelector('.rb-news-prev');
    const nextBtn = feed.querySelector('.rb-news-next');

    newsSwiper = new Swiper(swiperEl, {
      slidesPerView: 1,
      spaceBetween: 18,
      grabCursor: true,
      watchOverflow: true,
      pagination: {
        el: feed.querySelector('.rb-news-pagination'),
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
        1100: { slidesPerView: 3 },
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

  const renderItems = (items) => {
    const latestItems = Array.isArray(items) ? items : [];

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

    if (payload.error && !(payload.items || []).length) {
      updatedEl.textContent = payload.error;
      return;
    }

    const count = Array.isArray(payload.items) ? payload.items.length : 0;
    const when = payload.updated_at
      ? new Date(payload.updated_at).toLocaleTimeString(undefined, { hour: 'numeric', minute: '2-digit' })
      : 'just now';

    updatedEl.textContent = `${count} stories · Last updated ${when}. Auto-refreshing every ${Math.round(refreshMs / 1000)} seconds.`;
  };

  const updateDesc = (seconds, count) => {
    if (!descEl) {
      return;
    }

    const countText = count ? ` Showing ${count} PGA stories from the last 2 weeks.` : '';
    descEl.textContent = `Latest PGA Tour player news and matchup outlooks from RotoBaller.${countText} Auto-refreshes every ${seconds} seconds.`;
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
      }

      renderItems(payload.items || []);
      renderUpdated(payload);
      updateDesc(payload.refresh_seconds || Math.round(refreshMs / 1000), (payload.items || []).length);
    } catch (error) {
      if (!wrapper.querySelector('.rb-news-card')) {
        wrapper.innerHTML = '<div class="swiper-slide"><p class="body-lg rb-news-empty">Unable to refresh RotoBaller news right now.</p></div>';
        initSwiper();
      }

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
