'use strict';

/* â”€â”€ Sticky header â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
const hdr = document.getElementById('hdr');
const btt = document.getElementById('btt');

const onScroll = () => {
  const y = window.scrollY;
  if (hdr) hdr.classList.toggle('scrolled', y > 30);
  if (btt) btt.classList.toggle('visible', y > 500);
};
window.addEventListener('scroll', onScroll, {passive:true});
onScroll();

/* â”€â”€ Back to top â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
if (btt) btt.addEventListener('click', () => window.scrollTo({top:0,behavior:'smooth'}));

/* â”€â”€ Mobile hamburger / drawer â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
const ham     = document.getElementById('ham');
const drawer  = document.getElementById('drawer');
let drawerOpen = false;

function toggleDrawer(force) {
  drawerOpen = typeof force === 'boolean' ? force : !drawerOpen;
  ham.classList.toggle('open', drawerOpen);
  ham.setAttribute('aria-expanded', drawerOpen);
  drawer.setAttribute('aria-hidden', !drawerOpen);
  document.body.style.overflow = drawerOpen ? 'hidden' : '';

  if (drawerOpen) {
    drawer.style.display = 'flex';
    requestAnimationFrame(() => drawer.classList.add('open'));
  } else {
    drawer.classList.remove('open');
    setTimeout(() => {
      if (!drawerOpen) drawer.style.display = 'none';
    }, 320);
  }
}

if (ham && drawer) {
ham.addEventListener('click', () => toggleDrawer());

drawer.querySelectorAll('.drawer-link, .btn').forEach(el => {
  el.addEventListener('click', () => toggleDrawer(false));
});

document.addEventListener('keydown', e => {
  if (e.key === 'Escape' && drawerOpen) { toggleDrawer(false); ham.focus(); }
});
}

/* â”€â”€ Scroll reveal â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
const revEls = document.querySelectorAll('.reveal');
const revObs = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting) { e.target.classList.add('visible'); revObs.unobserve(e.target); }
  });
}, {threshold: 0.1, rootMargin:'0px 0px -30px 0px'});
revEls.forEach(el => revObs.observe(el));

/* â”€â”€ Animated counters â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
function animCount(el) {
  const raw   = parseInt(el.dataset.count, 10);
  const dur   = 1600;
  const start = performance.now();
  const tick  = now => {
    const p = Math.min((now - start) / dur, 1);
    const e = 1 - Math.pow(1 - p, 4); // ease out quart
    el.textContent = Math.round(e * raw);
    if (p < 1) requestAnimationFrame(tick);
    else el.textContent = raw;
  };
  requestAnimationFrame(tick);
}

const countObs = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      animCount(e.target);
      countObs.unobserve(e.target);
    }
  });
}, {threshold: 0.6});

document.querySelectorAll('.trust-num[data-count]').forEach(el => {
  el.textContent = '0';
  countObs.observe(el);
});

/* ── Active nav link tracking ── */
const navAnchors = document.querySelectorAll('.nav-links a, .drawer-link');
const navSectionIds = [...new Set(
  [...navAnchors]
    .map(a => (a.hash || '').replace(/^#/, ''))
    .filter(Boolean)
)];
const navSections = navSectionIds
  .map(id => document.getElementById(id))
  .filter(Boolean);

const setActiveNav = (id) => {
  navAnchors.forEach(a => {
    const linkId = (a.hash || '').replace(/^#/, '');
    a.classList.toggle('is-active', linkId === id);
  });
};

if (navSections.length) {
  const secObs = new IntersectionObserver(entries => {
    const visible = entries.filter(e => e.isIntersecting);
    if (!visible.length) return;
    const best = visible.sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
    setActiveNav(best.target.id);
  }, {
    threshold: [0.15, 0.35, 0.55, 0.75],
    rootMargin: '-15% 0px -50% 0px',
  });
  navSections.forEach(s => secObs.observe(s));

  const hashId = window.location.hash.replace(/^#/, '');
  if (hashId && navSectionIds.includes(hashId)) {
    setActiveNav(hashId);
  }
}

/* Custom select dropdowns */
function initCustomSelect(wrap) {
  const select = wrap.querySelector('select');
  if (!select || wrap.dataset.ready) return;
  wrap.dataset.ready = '1';
  select.classList.add('custom-select-native');

  const placeholderOpt = select.querySelector('option[disabled]') || select.querySelector('option[value=""]');
  const placeholder = placeholderOpt?.textContent?.trim() || 'Select…';

  const trigger = document.createElement('button');
  trigger.type = 'button';
  trigger.className = 'custom-select-trigger';
  trigger.id = `${select.id}-trigger`;
  trigger.setAttribute('aria-haspopup', 'listbox');
  trigger.setAttribute('aria-expanded', 'false');

  const valueEl = document.createElement('span');
  valueEl.className = 'custom-select-value is-placeholder';
  valueEl.textContent = placeholder;

  const chevron = document.createElement('span');
  chevron.className = 'custom-select-chevron';
  chevron.innerHTML = '<svg viewBox="0 0 24 24" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>';
  trigger.append(valueEl, chevron);

  const menu = document.createElement('div');
  menu.className = 'custom-select-menu';
  menu.setAttribute('role', 'listbox');
  menu.hidden = true;

  const createOption = (opt, solo = false) => {
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'custom-select-option' + (solo ? ' custom-select-option--solo' : '');
    btn.dataset.value = opt.value;
    btn.textContent = opt.textContent.trim();
    btn.setAttribute('role', 'option');
    btn.addEventListener('click', () => choose(opt.value, opt.textContent.trim()));
    return btn;
  };

  Array.from(select.children).forEach(child => {
    if (child.tagName === 'OPTGROUP') {
      const group = document.createElement('div');
      group.className = 'custom-select-group';
      const label = document.createElement('div');
      label.className = 'custom-select-group-label';
      label.textContent = child.label;
      group.appendChild(label);
      Array.from(child.children).forEach(opt => group.appendChild(createOption(opt)));
      menu.appendChild(group);
    } else if (child.tagName === 'OPTION' && !child.disabled) {
      menu.appendChild(createOption(child, true));
    }
  });

  const syncSelected = () => {
    menu.querySelectorAll('.custom-select-option').forEach(btn => {
      btn.classList.toggle('is-selected', btn.dataset.value === select.value);
      btn.setAttribute('aria-selected', btn.dataset.value === select.value ? 'true' : 'false');
    });
  };

  const choose = (value, text) => {
    select.value = value;
    valueEl.textContent = text;
    valueEl.classList.remove('is-placeholder');
    syncSelected();
    close();
    select.dispatchEvent(new Event('change', { bubbles: true }));
    select.dispatchEvent(new Event('input', { bubbles: true }));
  };

  let menuInBody = false;

  const positionMenu = () => {
    const rect = trigger.getBoundingClientRect();
    const gap = 4;
    const menuHeight = Math.min(280, window.innerHeight * 0.45);
    const spaceBelow = window.innerHeight - rect.bottom - gap;
    const spaceAbove = rect.top - gap;
    const openUp = spaceBelow < 180 && spaceAbove > spaceBelow;

    menu.style.width = `${rect.width}px`;
    menu.style.left = `${rect.left}px`;

    if (openUp) {
      menu.style.top = 'auto';
      menu.style.bottom = `${window.innerHeight - rect.top + gap}px`;
      menu.style.maxHeight = `${Math.min(menuHeight, spaceAbove - 8)}px`;
    } else {
      menu.style.bottom = 'auto';
      menu.style.top = `${rect.bottom + gap}px`;
      menu.style.maxHeight = `${Math.min(menuHeight, spaceBelow - 8)}px`;
    }
  };

  const mountMenu = () => {
    if (!menuInBody) {
      document.body.appendChild(menu);
      menuInBody = true;
    }
    positionMenu();
  };

  const unmountMenu = () => {
    if (menuInBody) {
      wrap.appendChild(menu);
      menuInBody = false;
      menu.style.top = '';
      menu.style.bottom = '';
      menu.style.left = '';
      menu.style.width = '';
      menu.style.maxHeight = '';
    }
  };

  const open = () => {
    document.querySelectorAll('.custom-select.is-open').forEach(el => {
      if (el !== wrap) el._closeCustomSelect?.();
    });
    mountMenu();
    menu.hidden = false;
    wrap.classList.add('is-open');
    trigger.setAttribute('aria-expanded', 'true');
  };

  const close = () => {
    menu.hidden = true;
    wrap.classList.remove('is-open');
    trigger.setAttribute('aria-expanded', 'false');
    unmountMenu();
  };

  wrap._closeCustomSelect = close;

  const onReposition = () => {
    if (wrap.classList.contains('is-open')) positionMenu();
  };

  window.addEventListener('resize', onReposition, { passive: true });

  trigger.addEventListener('click', () => {
    wrap.classList.contains('is-open') ? close() : open();
  });

  trigger.addEventListener('keydown', e => {
    if (e.key === 'Escape') close();
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      wrap.classList.contains('is-open') ? close() : open();
    }
  });

  document.addEventListener('click', e => {
    if (wrap.contains(e.target) || menu.contains(e.target)) return;
    close();
  });

  const resetDisplay = () => {
    select.selectedIndex = 0;
    valueEl.textContent = placeholder;
    valueEl.classList.add('is-placeholder');
    trigger.style.borderColor = '';
    trigger.style.boxShadow = '';
    syncSelected();
    close();
  };

  select.customSelectUI = { trigger, resetDisplay };
  wrap.append(trigger, menu);
  syncSelected();
}

document.querySelectorAll('[data-custom-select]').forEach(initCustomSelect);

if (!window.__customSelectScrollBound) {
  window.__customSelectScrollBound = true;
  const closeOpenSelects = () => {
    document.querySelectorAll('.custom-select.is-open').forEach(w => w._closeCustomSelect?.());
  };
  window.addEventListener('scroll', closeOpenSelects, { passive: true, capture: true });
}

/* Form validation & submit */
const form = document.querySelector('form[aria-label="Project quote request form"]');
if (form) {
  const alertBox = document.getElementById('form-alert');
  const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
  const defaultBtnHtml = `
    <svg viewBox="0 0 24 24" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
    Send My Quote Request`;

  const setField = (el, ok) => {
    const ui = el.customSelectUI?.trigger || el;
    ui.style.borderColor = ok ? 'var(--green-600)' : '#ef4444';
    ui.style.boxShadow   = ok ? '0 0 0 4px rgba(31,122,31,.10)' : '0 0 0 4px rgba(239,68,68,.12)';
  };

  const showAlert = (msg, type) => {
    if (!alertBox) return;
    alertBox.textContent = msg;
    alertBox.className = 'form-alert ' + type;
    alertBox.hidden = false;
  };

  const hideAlert = () => {
    if (!alertBox) return;
    alertBox.hidden = true;
    alertBox.textContent = '';
    alertBox.className = 'form-alert';
  };

  form.addEventListener('submit', async e => {
    e.preventDefault();
    hideAlert();
    let valid = true;
    form.querySelectorAll('[required]').forEach(f => {
      const ok = !!f.value.trim();
      setField(f, ok);
      if (!ok) valid = false;
    });

    if (!valid) {
      const invalid = [...form.querySelectorAll('[required]')].find(f => !f.value.trim());
      const focusEl = invalid?.customSelectUI?.trigger || invalid;
      if (focusEl) focusEl.focus();
      return;
    }

    const btn = form.querySelector('button[type="submit"]');
    const originalHtml = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = 'Sending…';

    try {
      const res = await fetch(form.action, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: new FormData(form)
      });

      const data = await res.json().catch(() => ({}));

      if (!res.ok) {
        const errMsg = data.message || (data.errors ? Object.values(data.errors).flat().join(' ') : 'Something went wrong. Please try again.');
        showAlert(errMsg, 'error');
        btn.innerHTML = originalHtml;
        btn.disabled = false;
        return;
      }

      btn.innerHTML = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="20" height="20" aria-hidden="true">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
        Quote Request Sent!`;
      btn.style.background = '#10b981';
      showAlert(data.message || 'Thank you! We will respond within one business day.', 'success');

      setTimeout(() => {
        btn.innerHTML = defaultBtnHtml;
        btn.style.background = '';
        btn.disabled = false;
        form.reset();
        hideAlert();
        form.querySelectorAll('[required]').forEach(f => {
          if (f.customSelectUI) f.customSelectUI.resetDisplay();
          else {
            f.style.borderColor = '';
            f.style.boxShadow   = '';
          }
        });
      }, 5000);
    } catch (err) {
      showAlert('Network error. Please check your connection and try again.', 'error');
      btn.innerHTML = originalHtml;
      btn.disabled = false;
    }
  });

  form.querySelectorAll('input,select,textarea').forEach(f => {
    f.addEventListener('input', () => {
      if (f.value.trim()) setField(f, true);
    });
  });
}

/* ── Hero image panel — subtle parallax tilt ── */
const heroPanel = document.querySelector('.hero-card-panel');
const heroSection = document.querySelector('.hero');
if (heroPanel && heroSection && !window.matchMedia('(prefers-reduced-motion: reduce)').matches && window.innerWidth > 1024) {
  let panelReady = false;
  let rafId = null;

  heroPanel.addEventListener('animationend', () => { panelReady = true; }, { once: true });
  setTimeout(() => { panelReady = true; }, 1600);

  const onHeroMove = (e) => {
    if (!panelReady) return;
    if (rafId) return;
    rafId = requestAnimationFrame(() => {
      const rect = heroPanel.getBoundingClientRect();
      const px = (e.clientX - rect.left) / rect.width - 0.5;
      const py = (e.clientY - rect.top) / rect.height - 0.5;
      heroPanel.style.transform = `rotateY(${px * 4}deg) rotateX(${-py * 3}deg)`;
      rafId = null;
    });
  };
  const resetHeroTilt = () => {
    if (!panelReady) return;
    heroPanel.style.transform = '';
  };
  heroSection.addEventListener('mousemove', onHeroMove);
  heroSection.addEventListener('mouseleave', resetHeroTilt);
}

const nlBtn = document.querySelector('.newsletter-row button');
const nlInp = document.getElementById('nl-email');
if (nlBtn && nlInp) {
  nlBtn.addEventListener('click', () => {
    if (nlInp.value.includes('@')) {
      nlBtn.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" width="18" height="18"><polyline points="20 6 9 17 4 12"/></svg>`;
      nlInp.value = '';
      nlInp.placeholder = 'You\'re subscribed!';
      setTimeout(() => { nlBtn.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" width="18" height="18"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>`; nlInp.placeholder = 'Your email address'; }, 3500);
    }
  });
}
