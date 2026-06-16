const T = [
  { id: 't1', title: 'Neon Cascade', artist: 'Lectrolab', cover: 'https://images.unsplash.com/photo-1614149162883-504ce4d13909?w=400&q=80', bpm: 128, key: 'F# Min', genre: 'Electronic', price: 29.99, tags: ['synth', 'dark'], plays: 14320, isNew: true, isFeatured: true, isPick: true },
  { id: 't2', title: 'Midnight Protocol', artist: 'Lectrolab', cover: 'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?w=400&q=80', bpm: 90, key: 'C Min', genre: 'Hip-Hop', price: 24.99, tags: ['dark', 'boom bap'], plays: 9870, isFeatured: true },
  { id: 't3', title: 'Solar Drift', artist: 'Lectrolab', cover: 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=400&q=80', bpm: 75, key: 'G Maj', genre: 'Lo-Fi', price: 19.99, tags: ['chill', 'study'], plays: 22150, isFeatured: true },
  { id: 't4', title: 'Pulse Circuit', artist: 'Lectrolab', cover: 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=400&q=80', bpm: 140, key: 'A Min', genre: 'Electronic', price: 34.99, tags: ['techno'], plays: 7640, isNew: true },
  { id: 't5', title: 'Ghost Signal', artist: 'Lectrolab', cover: 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400&q=80', bpm: 85, key: 'D Min', genre: 'Trap', price: 27.99, tags: ['808'], plays: 18900 },
  { id: 't6', title: 'Amber Frequency', artist: 'Lectrolab', cover: 'https://images.unsplash.com/photo-1571330735066-03aaa9429d89?w=400&q=80', bpm: 95, key: 'Bb Maj', genre: 'R&B', price: 22.99, tags: ['smooth'], plays: 11450, isNew: true },
  { id: 't7', title: 'Deep Space Archive', artist: 'Lectrolab', cover: 'https://images.unsplash.com/photo-1419242902214-272b3f66ee7a?w=400&q=80', bpm: 60, key: 'E Min', genre: 'Ambient', price: null, tags: ['free', 'atmospheric'], plays: 31200 },
  { id: 't8', title: 'Voltage Rush', artist: 'Lectrolab', cover: 'https://images.unsplash.com/photo-1504898770365-14faca6a7320?w=400&q=80', bpm: 155, key: 'F Min', genre: 'Electronic', price: 39.99, tags: ['rave'], plays: 6380, isNew: true },
  { id: 't9', title: 'Rain & Cyphers', artist: 'Lectrolab', cover: 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=400&q=80', bpm: 88, key: 'C# Min', genre: 'Hip-Hop', price: 24.99, tags: ['lyrical'], plays: 13760 }
];
const GC = { Electronic: 'bl', 'Hip-Hop': 'bp', 'Lo-Fi': 'bg', Ambient: 'bn', Trap: 'be', 'R&B': 'be' };

window.addEventListener('scroll', () => {
  const nav = document.getElementById('nav');
  if (nav) nav.classList.toggle('s', scrollY > 20);
}, { passive: true });

function tmm() {
  const m = document.getElementById('mm');
  if (!m) return;
  m.classList.toggle('open');
  document.body.style.overflow = m.classList.contains('open') ? 'hidden' : '';
}

function initMarquee() {
  const el = document.getElementById('mqt');
  if (!el) return;
  const items = ['🎛 Music Production', '🎧 Global Licensing', '🔊 Studio Quality', '🎵 Instant Download', '📀 Full Ownership', '🌍 120+ Countries'];
  const all = [...items, ...items];
  el.innerHTML = all.map(i => `<span class="mq-i">${i}<span style="color:rgba(255,107,168,.3);margin-left:32px">·</span></span>`).join('');
}

function tch(t, i) {
  const gc = GC[t.genre] || 'be';
  const bdg = `${t.isPick ? '<span class="badge bg" style="font-size:.6rem;padding:3px 8px">⭐ Pick</span>' : ''}${t.isNew ? '<span class="badge bn" style="font-size:.6rem;padding:3px 8px">New</span>' : ''}${t.price === null ? '<span class="badge bl" style="font-size:.6rem;padding:3px 8px">Free</span>' : ''}`;
  const buy = t.price !== null
    ? `<button class="trkbuy" type="button" onclick="event.stopPropagation()">🛒 $${t.price}</button>`
    : `<button class="trkfree" type="button" onclick="event.stopPropagation()">Free</button>`;
  return `<div class="trk rev" data-delay="${i * 60}"><div class="trkcov"><img src="${t.cover}" alt="${t.title}" loading="lazy"/><div class="trkol"><button type="button" class="pbtn" onclick="pt2('${t.id}')">▶</button></div><div class="trkbdg">${bdg}</div></div><div class="trkinf"><div class="trkttl">${t.title}</div><div class="trkar">${t.artist}</div><div class="trkmeta"><span class="badge ${gc}" style="font-size:.65rem;padding:3px 10px">${t.genre}</span><span class="trkbpm">${t.bpm} BPM</span><span class="trkbpm">${t.key}</span><span class="trkbpm" style="margin-left:auto">${t.plays > 999 ? (t.plays / 1000).toFixed(1) + 'k' : t.plays}</span></div><div class="trkact"><button type="button" class="trkpbtn" onclick="pt2('${t.id}')">▶ Preview</button>${buy}</div></div></div>`;
}

function rht() {
  const el = document.getElementById('homeTracks');
  if (!el) return;
  el.innerHTML = T.filter(t => t.isFeatured).map((t, i) => tch(t, i)).join('');
  ir();
}

let ag = 'All';

function rmg() {
  const q = (document.getElementById('srch')?.value || '').toLowerCase();
  const srt = document.getElementById('srt')?.value || 'popular';
  let r = [...T];
  if (ag !== 'All') r = r.filter(t => t.genre === ag);
  if (q) r = r.filter(t => t.title.toLowerCase().includes(q) || t.genre.toLowerCase().includes(q) || t.tags.some(x => x.toLowerCase().includes(q)) || String(t.bpm).includes(q));
  if (srt === 'popular') r.sort((a, b) => b.plays - a.plays);
  if (srt === 'price-asc') r.sort((a, b) => (a.price || 0) - (b.price || 0));
  if (srt === 'price-desc') r.sort((a, b) => (b.price || 0) - (a.price || 0));
  if (srt === 'bpm') r.sort((a, b) => a.bpm - b.bpm);
  const g = document.getElementById('mg');
  const e = document.getElementById('emp');
  const res = document.getElementById('mres');
  if (!g || !e || !res) return;
  if (!r.length) {
    g.innerHTML = '';
    g.style.display = 'none';
    e.style.display = 'block';
  } else {
    g.style.display = 'grid';
    e.style.display = 'none';
    g.innerHTML = r.map((t, i) => tch(t, i)).join('');
    res.innerHTML = `<span>${r.length}</span> tracks found${q ? ` for "<span style="color:var(--evie)">${q}</span>"` : ''}`;
    ir();
  }
}

function ftk() {
  const cl = document.getElementById('scl');
  if (cl) cl.style.display = document.getElementById('srch')?.value ? 'block' : 'none';
  rmg();
}

function clrs() {
  const s = document.getElementById('srch');
  if (s) s.value = '';
  const cl = document.getElementById('scl');
  if (cl) cl.style.display = 'none';
  rmg();
}

function sg(b) {
  ag = b.dataset.genre;
  document.querySelectorAll('.fb').forEach(x => x.classList.remove('act'));
  b.classList.add('act');
  rmg();
}

function sgn(n) {
  ag = n;
  document.querySelectorAll('.fb').forEach(b => b.classList.toggle('act', b.dataset.genre === n));
  rmg();
}

let PS = { playing: false, id: null, idx: 0, prog: 0, vol: 0.8, tmr: null };

function pt2(id) {
  const t = T.find(x => x.id === id);
  if (!t) return;
  PS.id = id;
  PS.idx = T.findIndex(x => x.id === id);
  PS.playing = true;
  PS.prog = 0;
  document.getElementById('pttl').textContent = t.title;
  document.getElementById('part').textContent = t.artist;
  document.getElementById('pt').src = t.cover;
  document.getElementById('plyr').classList.add('vis');
  document.getElementById('ppb').textContent = '⏸';
  sprg();
}

function sprg() {
  clearInterval(PS.tmr);
  PS.tmr = setInterval(() => {
    if (!PS.playing) return;
    PS.prog = Math.min(100, PS.prog + 0.25);
    document.getElementById('pf').style.width = PS.prog + '%';
    if (PS.prog >= 100) {
      clearInterval(PS.tmr);
      pn();
    }
  }, 150);
}

function tp() {
  if (!PS.id) return;
  PS.playing = !PS.playing;
  document.getElementById('ppb').textContent = PS.playing ? '⏸' : '▶';
  if (PS.playing) sprg();
}

function pn() {
  PS.idx = (PS.idx + 1) % T.length;
  pt2(T[PS.idx].id);
}

function pv() {
  if (PS.prog > 10) {
    PS.prog = 0;
    document.getElementById('pf').style.width = '0%';
    return;
  }
  PS.idx = (PS.idx - 1 + T.length) % T.length;
  pt2(T[PS.idx].id);
}

function sk(e) {
  const r = document.getElementById('pp').getBoundingClientRect();
  PS.prog = ((e.clientX - r.left) / r.width) * 100;
  document.getElementById('pf').style.width = PS.prog + '%';
}

function sv(v) {
  PS.vol = parseFloat(v);
}

function tm() {
  PS.vol = PS.vol > 0 ? 0 : 0.8;
}

function sbf(e) {
  e.preventDefault();
  let v = true;
  const n = document.getElementById('fn');
  const em = document.getElementById('fe');
  const m = document.getElementById('fm');
  [n, em, m].forEach(f => f.classList.remove('err'));
  document.querySelectorAll('.ferr').forEach(x => { x.style.display = 'none'; });
  if (!n.value.trim()) {
    n.classList.add('err');
    document.getElementById('fne').style.display = 'block';
    v = false;
  }
  if (!em.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em.value)) {
    em.classList.add('err');
    document.getElementById('fee').style.display = 'block';
    v = false;
  }
  if (m.value.trim().length < 20) {
    m.classList.add('err');
    document.getElementById('fme').style.display = 'block';
    v = false;
  }
  if (!v) return;
  const b = document.getElementById('fsb');
  b.disabled = true;
  b.innerHTML = '<span style="width:16px;height:16px;border:2px solid rgba(255,255,255,.4);border-top-color:#fff;border-radius:9999px;animation:spin .6s linear infinite;display:inline-block;vertical-align:middle;margin-right:6px"></span>Sending...';
  setTimeout(() => {
    document.getElementById('fv').style.display = 'none';
    document.getElementById('sv').style.display = 'block';
  }, 1800);
}

function rsf() {
  document.getElementById('cf').reset();
  document.getElementById('fv').style.display = 'block';
  document.getElementById('sv').style.display = 'none';
  const b = document.getElementById('fsb');
  b.disabled = false;
  b.innerHTML = '✉ Send Message';
}

function ir() {
  const obs = new IntersectionObserver(entries => {
    entries.forEach(en => {
      if (en.isIntersecting) {
        const el = en.target;
        const d = parseInt(el.dataset.delay || '0', 10);
        setTimeout(() => el.classList.add('vis'), d);
        obs.unobserve(el);
      }
    });
  }, { threshold: 0.1 });
  document.querySelectorAll('.rev:not(.vis)').forEach(el => obs.observe(el));
}

function is() {
  const obs = new IntersectionObserver(entries => {
    entries.forEach(en => {
      if (!en.isIntersecting) return;
      const el = en.target;
      const tgt = parseInt(el.dataset.count, 10);
      const sfx = el.dataset.suffix || '';
      const st = performance.now();
      const dur = 2000;
      function tick(now) {
        const p = Math.min((now - st) / dur, 1);
        const ease = 1 - Math.pow(1 - p, 3);
        el.textContent = Math.floor(ease * tgt).toLocaleString() + sfx;
        if (p < 1) requestAnimationFrame(tick);
        else el.textContent = tgt.toLocaleString() + sfx;
      }
      requestAnimationFrame(tick);
      obs.unobserve(el);
    });
  }, { threshold: 0.5 });
  document.querySelectorAll('[data-count]').forEach(el => obs.observe(el));
}

document.addEventListener('DOMContentLoaded', () => {
  initMarquee();
  rht();
  rmg();
  ir();
  is();
});
