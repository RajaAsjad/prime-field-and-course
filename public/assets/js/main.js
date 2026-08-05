    const nav = document.getElementById('nav');
    const forceSolidNav = nav?.dataset.forceSolid === '1';
    window.addEventListener('scroll', () => {
      if (!nav) return;
      if (forceSolidNav) {
        nav.classList.add('solid');
        return;
      }
      nav.classList.toggle('solid', window.scrollY > 16);
    }, { passive: true });

    const nvLinks = document.querySelectorAll('.nv');
    const allSections = document.querySelectorAll('section[id]');
    const activeObs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          nvLinks.forEach(l => l.classList.remove('active'));
          const a = document.querySelector(`.nv[href="#${e.target.id}"]`);
          if (a) a.classList.add('active');
        }
      });
    }, { rootMargin: '-38% 0px -38% 0px' });
    allSections.forEach(s => activeObs.observe(s));

    const ham = document.getElementById('ham'), mob = document.getElementById('mob'), mobLinks = document.querySelectorAll('.mob-nv');
    let mobOpen = false;
    const toggleMob = () => {
      mobOpen = !mobOpen;
      ham.classList.toggle('open', mobOpen);
      mob.classList.toggle('open', mobOpen);
      document.body.style.overflow = mobOpen ? 'hidden' : '';
    };
    ham.addEventListener('click', toggleMob);
    mobLinks.forEach(l => l.addEventListener('click', () => { if (mobOpen) toggleMob() }));

    const revEls = document.querySelectorAll('.rev');
    const revObs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('on'); revObs.unobserve(e.target) }
      });
    }, { threshold: .08, rootMargin: '0px 0px -36px 0px' });
    revEls.forEach(el => revObs.observe(el));

    /* Carousel */
    const cInner = document.getElementById('c-inner'), cPrev = document.getElementById('c-prev'), cNext = document.getElementById('c-next'), cDots = document.querySelectorAll('.car-dot');
    let cIdx = 0;
    const cCards = () => document.querySelectorAll('.t-card').length;
    const cW = () => { const c = cInner.querySelector('.t-card'); return c ? (c.offsetWidth + 20) : 0 };
    const goTo = i => {
      const total = cCards();
      cIdx = Math.max(0, Math.min(i, total - 1));
      cInner.style.transform = `translateX(-${cIdx * cW()}px)`;
      cDots.forEach((d, j) => { d.classList.toggle('on', j === cIdx) });
    };
    cPrev.addEventListener('click', () => goTo(cIdx - 1));
    cNext.addEventListener('click', () => goTo(cIdx + 1));
    cDots.forEach((d, i) => d.addEventListener('click', () => goTo(i)));

    /* FAQ */
    document.querySelectorAll('.faq-q').forEach(btn => {
      btn.addEventListener('click', () => {
        const item = btn.closest('.faq-item');
        const isOpen = item.classList.contains('open');

        document.querySelectorAll('.faq-item.open').forEach(i => {
          i.classList.remove('open');
          const openBtn = i.querySelector('.faq-q');
          if (openBtn) openBtn.setAttribute('aria-expanded', 'false');
        });

        if (!isOpen) {
          item.classList.add('open');
          btn.setAttribute('aria-expanded', 'true');
        }
      });
    });

    /* Forms */
    document.querySelectorAll('form').forEach(form => {
      form.addEventListener('submit', e => {
        e.preventDefault();
        const btn = form.querySelector('button[type="submit"]');
        if (!btn) return;
        const orig = btn.innerHTML;
        btn.innerHTML = 'âœ“ Check your inbox!';
        btn.disabled = true;
        setTimeout(() => { btn.innerHTML = orig; btn.disabled = false; form.reset() }, 3500);
      });
    });

    /* Logo load animation */
    const navLogo = document.querySelector('.nav-logo');
    if (navLogo) {
      navLogo.style.opacity = '0';
      navLogo.style.transform = 'translateY(-6px)';
      navLogo.style.transition = 'opacity .8s cubic-bezier(.34,1.56,.64,1), transform .8s cubic-bezier(.34,1.56,.64,1)';
      setTimeout(() => { navLogo.style.opacity = '1'; navLogo.style.transform = 'none' }, 200);
    }
    const footLogo = document.querySelector('.foot-logo');
    if (footLogo) {
      footLogo.style.opacity = '0';
      footLogo.style.transform = 'translateY(6px)';
      footLogo.style.transition = 'opacity .8s cubic-bezier(.34,1.56,.64,1), transform .8s cubic-bezier(.34,1.56,.64,1)';
      setTimeout(() => { footLogo.style.opacity = '1'; footLogo.style.transform = 'none' }, 300);
    }
