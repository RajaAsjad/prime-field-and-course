<style>
  .content-page {
    padding-top: var(--nav-h);
  }

  .content-hero {
    padding: 40px 0 32px;
    background: #fff;
    border-bottom: 1px solid var(--bdr);
  }

  .content-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 22px;
    font-size: .82rem;
    font-weight: 700;
    color: var(--g-600);
    transition: color .2s;
  }

  .content-back:hover {
    color: var(--g-700);
  }

  .content-kicker {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 16px;
  }

  .content-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 3.6vw, 2.75rem);
    font-weight: 900;
    line-height: 1.15;
    letter-spacing: -.02em;
    color: var(--tx-h);
    margin-bottom: 14px;
  }

  .content-subtitle {
    font-size: clamp(1rem, 2vw, 1.2rem);
    color: var(--tx-m);
    font-weight: 600;
    margin-bottom: 16px;
  }

  .content-intro {
    font-size: 1.05rem;
    line-height: 1.75;
    color: #3a4f3e;
    max-width: 720px;
  }

  .content-body-section {
    padding: 40px 0 88px;
  }

  .content-paper {
    background: #fff;
    border: 1.5px solid var(--bdr);
    border-radius: 20px;
    padding: clamp(24px, 4vw, 44px);
    box-shadow: 0 16px 40px rgba(13, 30, 16, .06);
  }

  .content-related {
    margin-top: 40px;
  }

  .content-related h2 {
    font-family: 'Playfair Display', serif;
    font-size: 1.35rem;
    font-weight: 900;
    color: var(--tx-h);
    margin-bottom: 16px;
  }

  .content-related-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 14px;
  }

  .content-related-card {
    display: block;
    background: #fff;
    border: 1.5px solid var(--bdr);
    border-radius: 14px;
    padding: 18px;
    transition: transform .25s var(--ease-expo), box-shadow .25s var(--ease-expo), border-color .25s;
  }

  .content-related-card:hover {
    transform: translateY(-3px);
    border-color: #78c98a;
    box-shadow: 0 12px 28px rgba(26, 92, 40, .08);
  }

  .content-related-card .content-related-eyebrow {
    display: inline-block;
    font-size: .68rem;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--au-500);
    margin-bottom: 8px;
  }

  .content-related-card h3 {
    font-size: .95rem;
    font-weight: 800;
    line-height: 1.35;
    color: var(--tx-h);
    margin-bottom: 8px;
  }

  .content-related-card p {
    font-size: .8rem;
    color: var(--tx-m);
    line-height: 1.55;
  }

  @media (max-width: 768px) {
    .content-related-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
