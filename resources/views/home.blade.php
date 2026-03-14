<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gomita - Plantillas Digitales</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,600;0,700;0,800;0,900;1,700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --pink:        #FF6B9D;
      --pink-dark:   #e5558a;
      --pink-light:  #FFE4EE;
      --pink-mid:    #FFB3CE;
      --peach:       #FFDDD2;
      --yellow:      #FFD166;
      --teal:        #06D6A0;
      --purple:      #9B5DE5;
      --text:        #3D2C35;
      --text-soft:   #9B7B87;
      --white:       #FFFFFF;
      --bg:          #FFF8FA;
      --shadow-sm:   0 2px 8px rgba(255,107,157,0.12);
      --shadow-md:   0 4px 20px rgba(255,107,157,0.18);
      --shadow-lg:   0 8px 40px rgba(255,107,157,0.22);
      --radius:      16px;
      --radius-sm:   10px;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Nunito', sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.5;
    }

    a { text-decoration: none; color: inherit; }

    /* ═══════════════════════════════════════
       TOP BAR
    ═══════════════════════════════════════ */
    .top-bar {
      background: linear-gradient(90deg, var(--pink) 0%, #FF9B6B 100%);
      text-align: center;
      padding: 8px 16px;
      font-size: 13px;
      font-weight: 700;
      color: white;
      letter-spacing: 0.2px;
    }
    .top-bar a {
      color: white;
      text-decoration: underline;
      margin-left: 6px;
      opacity: 0.9;
    }
    .top-bar a:hover { opacity: 1; }

    /* ═══════════════════════════════════════
       HEADER
    ═══════════════════════════════════════ */
    .header-main {
      background: white;
      border-bottom: 2px solid var(--pink-light);
      box-shadow: var(--shadow-md);
      position: sticky;
      top: 0;
      z-index: 200;
    }

    .header-inner {
      max-width: 1240px;
      margin: 0 auto;
      padding: 0 24px;
      display: grid;
      grid-template-columns: auto 1fr auto;
      align-items: center;
      gap: 20px;
      height: 72px;
    }

    /* Logo */
    .logo a {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .logo img {
      height: 50px;
      width: auto;
      transition: transform 0.3s ease;
    }
    .logo img:hover { transform: scale(1.06) rotate(-2deg); }
    .logo-fallback {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .logo-icon {
      width: 48px; height: 48px;
      background: linear-gradient(135deg, var(--pink), var(--pink-mid));
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 24px;
      box-shadow: 0 3px 10px rgba(255,107,157,0.35);
    }
    .logo-text {
      font-size: 24px;
      font-weight: 900;
      color: var(--pink);
      letter-spacing: -0.5px;
    }

    /* Search */
    .search-wrap {
      position: relative;
      max-width: 520px;
      width: 100%;
      justify-self: center;
    }
    .search-wrap input {
      width: 100%;
      padding: 11px 48px 11px 20px;
      border: 2px solid var(--pink-mid);
      border-radius: 50px;
      font-family: 'Nunito', sans-serif;
      font-size: 14px;
      font-weight: 600;
      color: var(--text);
      background: var(--pink-light);
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }
    .search-wrap input::placeholder { color: var(--text-soft); }
    .search-wrap input:focus {
      border-color: var(--pink);
      box-shadow: 0 0 0 4px rgba(255,107,157,0.12);
      background: white;
    }
    .search-btn {
      position: absolute;
      right: 7px; top: 50%;
      transform: translateY(-50%);
      background: var(--pink);
      border: none;
      border-radius: 50px;
      width: 34px; height: 34px;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background 0.2s, transform 0.15s;
    }
    .search-btn:hover { background: var(--pink-dark); transform: translateY(-50%) scale(1.1); }
    .search-btn svg { width: 16px; height: 16px; stroke: white; fill: none; stroke-width: 2.5; stroke-linecap: round; }

    /* Header Actions */
    .header-actions { display: flex; align-items: center; gap: 6px; }

    .btn-ghost {
      display: flex; align-items: center; gap: 6px;
      padding: 8px 14px;
      border-radius: 50px;
      border: 2px solid transparent;
      background: transparent;
      font-family: 'Nunito', sans-serif;
      font-size: 13px; font-weight: 700;
      color: var(--text-soft);
      cursor: pointer;
      transition: color 0.2s, background 0.2s;
      white-space: nowrap;
    }
    .btn-ghost:hover { color: var(--pink); background: var(--pink-light); }
    .btn-ghost svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; }

    .btn-cart {
      display: flex; align-items: center; gap: 7px;
      padding: 9px 20px;
      background: var(--pink);
      color: white;
      border: none; border-radius: 50px;
      font-family: 'Nunito', sans-serif;
      font-size: 13px; font-weight: 800;
      cursor: pointer;
      position: relative;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
      box-shadow: 0 3px 14px rgba(255,107,157,0.4);
    }
    .btn-cart:hover { background: var(--pink-dark); transform: translateY(-1px); box-shadow: 0 5px 20px rgba(255,107,157,0.45); }
    .btn-cart svg { width: 17px; height: 17px; stroke: white; fill: none; stroke-width: 2; stroke-linecap: round; }
    .cart-badge {
      position: absolute; top: -6px; right: -6px;
      background: var(--yellow);
      color: var(--text);
      font-size: 10px; font-weight: 900;
      width: 19px; height: 19px;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      border: 2px solid white;
    }

    /* ═══════════════════════════════════════
       NAV BAR
    ═══════════════════════════════════════ */
    .nav-bar {
      background: var(--pink-light);
      border-bottom: 1px solid var(--pink-mid);
    }
    .nav-inner {
      max-width: 1240px;
      margin: 0 auto;
      padding: 0 24px;
      display: flex;
      align-items: center;
      gap: 2px;
    }

    .dropdown { position: relative; }
    .dropdown-toggle {
      display: flex; align-items: center; gap: 6px;
      padding: 11px 16px;
      background: transparent;
      border: none;
      font-family: 'Nunito', sans-serif;
      font-size: 14px; font-weight: 700;
      color: var(--text);
      cursor: pointer;
      border-radius: var(--radius-sm) var(--radius-sm) 0 0;
      transition: background 0.2s, color 0.2s;
      white-space: nowrap;
    }
    .arrow { font-size: 10px; transition: transform 0.2s; display: inline-block; }
    .dropdown:hover .dropdown-toggle { background: white; color: var(--pink); }
    .dropdown:hover .arrow { transform: rotate(180deg); }

    .dropdown-menu {
      display: none;
      position: absolute; top: 100%; left: 0;
      background: white;
      border: 2px solid var(--pink-mid);
      border-radius: 0 var(--radius) var(--radius) var(--radius);
      min-width: 190px;
      box-shadow: var(--shadow-md);
      padding: 8px 0;
      z-index: 300;
      animation: fadeDown 0.15s ease;
    }
    @keyframes fadeDown { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:translateY(0); } }
    .dropdown:hover .dropdown-menu { display: block; }
    .dropdown-menu a {
      display: block;
      padding: 9px 18px;
      font-size: 13px; font-weight: 600;
      color: var(--text);
      transition: background 0.15s, color 0.15s, padding-left 0.15s;
    }
    .dropdown-menu a:hover { background: var(--pink-light); color: var(--pink); padding-left: 24px; }
    .menu-divider { height: 1px; background: var(--pink-light); margin: 5px 14px; }

    .nav-spacer { flex: 1; }
    .nav-promo {
      display: flex; align-items: center; gap: 6px;
      padding: 7px 16px;
      background: linear-gradient(135deg, var(--pink), #FF9B6B);
      color: white;
      border-radius: 50px;
      font-size: 13px; font-weight: 800;
      transition: transform 0.15s, box-shadow 0.2s;
      box-shadow: 0 3px 10px rgba(255,107,157,0.3);
      margin: 5px 0;
    }
    .nav-promo:hover { transform: translateY(-1px); box-shadow: 0 5px 16px rgba(255,107,157,0.4); }
    .nav-contact {
      display: flex; align-items: center; gap: 5px;
      padding: 7px 14px;
      color: var(--text-soft);
      font-size: 13px; font-weight: 700;
      border-radius: 50px;
      transition: color 0.2s, background 0.2s;
    }
    .nav-contact:hover { color: var(--pink); background: white; }

    /* ═══════════════════════════════════════
       HERO BANNER
    ═══════════════════════════════════════ */
    .hero {
      background: linear-gradient(135deg, #FFE4EE 0%, #FFF0E6 50%, #FFF8FA 100%);
      position: relative;
      overflow: hidden;
      min-height: 380px;
      display: flex;
      align-items: center;
    }
    .hero::before {
      content: '';
      position: absolute; inset: 0;
      background: radial-gradient(circle at 70% 50%, rgba(255,107,157,0.08) 0%, transparent 60%),
                  radial-gradient(circle at 20% 80%, rgba(255,179,206,0.15) 0%, transparent 50%);
    }
    .hero-inner {
      max-width: 1240px;
      margin: 0 auto;
      padding: 60px 24px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      align-items: center;
      position: relative;
      z-index: 1;
      width: 100%;
    }
    .hero-text { animation: fadeUp 0.6s ease; }
    @keyframes fadeUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
    .hero-tag {
      display: inline-flex; align-items: center; gap: 6px;
      background: var(--pink);
      color: white;
      padding: 5px 14px;
      border-radius: 50px;
      font-size: 12px; font-weight: 800;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      margin-bottom: 16px;
    }
    .hero h1 {
      font-size: 42px;
      font-weight: 900;
      line-height: 1.15;
      color: var(--text);
      margin-bottom: 14px;
    }
    .hero h1 span { color: var(--pink); }
    .hero p {
      font-size: 16px;
      color: var(--text-soft);
      font-weight: 600;
      margin-bottom: 28px;
      max-width: 420px;
    }
    .hero-btns { display: flex; gap: 12px; flex-wrap: wrap; }
    .btn-primary {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 13px 28px;
      background: var(--pink);
      color: white;
      border-radius: 50px;
      font-family: 'Nunito', sans-serif;
      font-size: 15px; font-weight: 800;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
      box-shadow: 0 4px 18px rgba(255,107,157,0.4);
    }
    .btn-primary:hover { background: var(--pink-dark); transform: translateY(-2px); box-shadow: 0 6px 24px rgba(255,107,157,0.45); }
    .btn-secondary {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 13px 24px;
      background: white;
      color: var(--pink);
      border-radius: 50px;
      font-family: 'Nunito', sans-serif;
      font-size: 15px; font-weight: 800;
      border: 2px solid var(--pink-mid);
      transition: background 0.2s, border-color 0.2s, transform 0.15s;
    }
    .btn-secondary:hover { background: var(--pink-light); border-color: var(--pink); transform: translateY(-2px); }

    .hero-visual {
      display: flex;
      align-items: center;
      justify-content: center;
      animation: fadeUp 0.6s ease 0.1s both;
    }
    .hero-cards-preview {
      display: grid;
      grid-template-columns: repeat(2, 140px);
      gap: 12px;
      transform: rotate(3deg);
    }
    .hero-card-mini {
      background: white;
      border-radius: 14px;
      padding: 14px;
      box-shadow: var(--shadow-md);
      text-align: center;
      font-size: 13px; font-weight: 700;
      color: var(--text);
      transition: transform 0.3s;
    }
    .hero-card-mini:hover { transform: scale(1.04) rotate(-1deg); }
    .hero-card-mini .emoji { font-size: 32px; display: block; margin-bottom: 6px; }
    .hero-card-mini:nth-child(2) { transform: translateY(10px); }
    .hero-card-mini:nth-child(4) { transform: translateY(10px); }
    .hero-stats {
      display: flex;
      gap: 24px;
      margin-top: 20px;
    }
    .hero-stat { text-align: left; }
    .hero-stat strong { display: block; font-size: 20px; font-weight: 900; color: var(--pink); }
    .hero-stat span { font-size: 12px; color: var(--text-soft); font-weight: 600; }

    /* ═══════════════════════════════════════
       SECTIONS SHARED
    ═══════════════════════════════════════ */
    .section-header {
      max-width: 1240px;
      margin: 0 auto;
      padding: 50px 24px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .section-header h2 {
      font-size: 24px;
      font-weight: 900;
      color: var(--text);
    }
    .section-header a {
      font-size: 13px; font-weight: 700;
      color: var(--pink);
      padding: 7px 16px;
      border: 2px solid var(--pink-mid);
      border-radius: 50px;
      transition: background 0.2s, border-color 0.2s;
    }
    .section-header a:hover { background: var(--pink-light); border-color: var(--pink); }

    /* Slider */
    .slider-outer {
      max-width: 1240px;
      margin: 0 auto;
      padding: 0 24px 10px;
      position: relative;
    }
    .slider-track {
      display: flex;
      gap: 16px;
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      -webkit-overflow-scrolling: touch;
      padding-bottom: 12px;
      scrollbar-width: none;
    }
    .slider-track::-webkit-scrollbar { display: none; }
    .slider-arrow {
      position: absolute;
      top: 50%; transform: translateY(-50%);
      width: 40px; height: 40px;
      background: white;
      border: 2px solid var(--pink-mid);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      font-size: 16px;
      color: var(--pink);
      box-shadow: var(--shadow-sm);
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
      z-index: 10;
    }
    .slider-arrow:hover { background: var(--pink); color: white; transform: translateY(-50%) scale(1.08); box-shadow: var(--shadow-md); }
    .slider-arrow.left { left: -16px; }
    .slider-arrow.right { right: -16px; }

    /* Product Card */
    .product-card {
      flex: 0 0 210px;
      scroll-snap-align: start;
      background: white;
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow-sm);
      transition: transform 0.25s, box-shadow 0.25s;
      position: relative;
      border: 2px solid transparent;
    }
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
      border-color: var(--pink-mid);
    }
    .product-card a { display: block; }
    .product-card .img-wrap {
      position: relative;
      background: var(--pink-light);
      height: 170px;
      display: flex; align-items: center; justify-content: center;
      overflow: hidden;
    }
    .product-card img {
      width: 100%; height: 100%;
      object-fit: cover;
      transition: transform 0.3s;
    }
    .product-card:hover img { transform: scale(1.04); }
    .product-card .img-placeholder {
      font-size: 52px;
      opacity: 0.4;
    }

    .product-badge {
      position: absolute;
      top: 10px; right: 10px;
      background: var(--pink);
      color: white;
      padding: 4px 10px;
      border-radius: 50px;
      font-size: 11px; font-weight: 800;
      z-index: 2;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
      letter-spacing: 0.3px;
    }
    .badge-popular  { background: #06D6A0; }
    .badge-sale     { background: #FF9B00; }
    .badge-editable { background: var(--purple); }
    .badge-free     { background: #00BCD4; }
    .badge-top1     { background: #FF5722; }
    .badge-top2     { background: #FF7043; }
    .badge-top3     { background: #FF8A65; }

    .card-body { padding: 14px; }
    .card-title {
      font-size: 14px; font-weight: 800;
      color: var(--text);
      margin-bottom: 4px;
      white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .card-sub {
      font-size: 12px; color: var(--text-soft); font-weight: 600;
      margin-bottom: 8px;
    }
    .card-footer { display: flex; align-items: center; justify-content: space-between; gap: 6px; }
    .card-price {
      font-size: 16px; font-weight: 900; color: var(--pink);
    }
    .card-price-old {
      font-size: 12px;
      text-decoration: line-through;
      color: var(--text-soft);
      font-weight: 600;
      margin-left: 4px;
    }
    .card-stars { font-size: 11px; color: var(--text-soft); font-weight: 700; }
    .card-stars span { color: #FFB800; }
    .btn-add {
      width: 32px; height: 32px;
      background: var(--pink-light);
      border: none; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      color: var(--pink);
      font-size: 18px; font-weight: 900;
      transition: background 0.2s, transform 0.15s;
      flex-shrink: 0;
    }
    .btn-add:hover { background: var(--pink); color: white; transform: scale(1.15); }

    /* ═══════════════════════════════════════
       CATEGORÍAS DESTACADAS
    ═══════════════════════════════════════ */
    .categorias-section { padding-bottom: 20px; }
    .categorias-grid {
      max-width: 1240px;
      margin: 0 auto;
      padding: 0 24px 20px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
    }
    .categoria-card {
      background: white;
      border-radius: var(--radius);
      padding: 28px 20px;
      text-align: center;
      box-shadow: var(--shadow-sm);
      border: 2px solid var(--pink-light);
      transition: transform 0.25s, box-shadow 0.25s, border-color 0.2s;
      cursor: pointer;
    }
    .categoria-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-md);
      border-color: var(--pink);
    }
    .categoria-card .cat-icon {
      font-size: 40px;
      display: block;
      margin-bottom: 10px;
    }
    .categoria-card .cat-name {
      font-size: 14px; font-weight: 800;
      color: var(--text);
      margin-bottom: 4px;
    }
    .categoria-card .cat-count {
      font-size: 12px; color: var(--text-soft); font-weight: 600;
    }

    /* ═══════════════════════════════════════
       TRUST BAR
    ═══════════════════════════════════════ */
    .trust-bar {
      background: var(--pink);
      padding: 18px 24px;
      margin: 40px 0 0;
    }
    .trust-inner {
      max-width: 1240px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
      text-align: center;
    }
    .trust-item {
      color: white;
    }
    .trust-item .t-icon { font-size: 24px; margin-bottom: 5px; }
    .trust-item strong { display: block; font-size: 14px; font-weight: 800; }
    .trust-item span { font-size: 12px; opacity: 0.85; font-weight: 600; }

    /* ═══════════════════════════════════════
       FOOTER
    ═══════════════════════════════════════ */
    footer {
      background: var(--text);
      color: rgba(255,255,255,0.85);
      padding: 50px 24px 0;
    }
    .footer-grid {
      max-width: 1240px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1.4fr 1fr 1fr 1fr;
      gap: 40px;
      padding-bottom: 40px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .footer-brand .logo-text-f {
      font-size: 22px; font-weight: 900;
      color: var(--pink);
      margin-bottom: 10px;
      display: block;
    }
    .footer-brand p { font-size: 13px; font-weight: 600; line-height: 1.7; opacity: 0.8; }
    .footer-badges { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 14px; }
    .footer-badge {
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.15);
      border-radius: 50px;
      padding: 5px 12px;
      font-size: 11px; font-weight: 700;
      color: rgba(255,255,255,0.7);
    }
    .footer-col h4 {
      font-size: 14px; font-weight: 800;
      color: white;
      margin-bottom: 14px;
    }
    .footer-col a {
      display: block;
      font-size: 13px; font-weight: 600;
      color: rgba(255,255,255,0.65);
      margin-bottom: 9px;
      transition: color 0.2s, padding-left 0.15s;
    }
    .footer-col a:hover { color: var(--pink); padding-left: 4px; }
    .footer-col p {
      font-size: 13px; font-weight: 600;
      color: rgba(255,255,255,0.65);
      margin-bottom: 8px;
    }
    .social-links { display: flex; gap: 10px; margin-top: 10px; }
    .social-link {
      width: 34px; height: 34px;
      background: rgba(255,255,255,0.1);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 16px;
      transition: background 0.2s, transform 0.15s;
    }
    .social-link:hover { background: var(--pink); transform: scale(1.12); }
    .footer-bottom {
      max-width: 1240px;
      margin: 0 auto;
      padding: 18px 0;
      text-align: center;
      font-size: 12px; font-weight: 600;
      color: rgba(255,255,255,0.4);
    }
  </style>
</head>
<body>

  <!-- TOP BAR -->
  <div class="top-bar">
    🎉 ¡Envío digital instantáneo! Todas las plantillas con descarga inmediata.
    <a href="#">Ver novedades →</a>
  </div>

  <!-- ═══ HEADER ═══ -->
  <header class="header-main">
    <div class="header-inner">

      <div class="logo">
        <a href="perfil.html">
          <img src="Assets/Logo/GomitaLogoCompleto.png" alt="Gomita"
               onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
          <div class="logo-fallback" style="display:none">
            <div class="logo-icon">🐻</div>
            <span class="logo-text">GOMITA</span>
          </div>
        </a>
      </div>

      <div class="search-wrap">
        <input type="text" placeholder="Busca plantillas, stickers, etiquetas...">
        <button class="search-btn" type="button" aria-label="Buscar">
          <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </button>
      </div>

      <div class="header-actions">
        <a href="login.html" class="btn-ghost">
          <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Mi cuenta
        </a>
        <a href="carrito.html" class="btn-cart">
          <svg viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          Carrito
          <span class="cart-badge">3</span>
        </a>
      </div>
    </div>

    <nav class="nav-bar" aria-label="Navegación principal">
      <div class="nav-inner">

        <div class="dropdown">
          <a href="categorias.html" class="dropdown-toggle">
            🎉 Categorías <span class="arrow">▾</span>
          </a>
          <div class="dropdown-menu">
            <a href="#">🎂 Cumpleaños</a>
            <a href="#">💍 Bodas</a>
            <a href="#">🎄 Navidad</a>
            <a href="#">🍼 Baby Shower</a>
            <div class="menu-divider"></div>
            <a href="categorias.html">Ver todas →</a>
          </div>
        </div>

        <div class="dropdown">
          <a href="#" class="dropdown-toggle">
            📦 Tipo de producto <span class="arrow">▾</span>
          </a>
          <div class="dropdown-menu">
            <a href="#">📦 Cajas</a>
            <a href="#">✨ Stickers</a>
            <a href="#">🏷️ Etiquetas</a>
            <a href="#">🎁 Kits completos</a>
          </div>
        </div>

        <div class="dropdown">
          <a href="#" class="dropdown-toggle">
            🎨 Estilos <span class="arrow">▾</span>
          </a>
          <div class="dropdown-menu">
            <a href="#">🦕 Dinosaurios</a>
            <a href="#">🤍 Minimalista</a>
            <a href="#">🌈 Infantil</a>
            <a href="#">🌸 Floral</a>
          </div>
        </div>

        <div class="nav-spacer"></div>

        <a href="#ofertas" class="nav-promo">🔥 Ofertas del día</a>
        <a href="contacto.html" class="nav-contact">🌟 Contáctanos</a>
      </div>
    </nav>
  </header>

  <!-- ═══ HERO ═══ -->
  <section class="hero">
    <div class="hero-inner">
      <div class="hero-text">
        <div class="hero-tag">✨ +2.000 plantillas disponibles</div>
        <h1>Plantillas que hacen tus <span>fiestas</span> únicas</h1>
        <p>Descarga, personaliza e imprime desde casa. Diseños kawaii para todas tus celebraciones.</p>
        <div class="hero-btns">
          <a href="categorias.html" class="btn-primary">🎉 Ver plantillas</a>
          <a href="#novedades" class="btn-secondary">✨ Novedades</a>
        </div>
        <div class="hero-stats">
          <div class="hero-stat"><strong>2.000+</strong><span>Plantillas</span></div>
          <div class="hero-stat"><strong>10K+</strong><span>Clientas felices</span></div>
          <div class="hero-stat"><strong>⭐ 4.9</strong><span>Calificación</span></div>
        </div>
      </div>
      <div class="hero-visual">
        <div class="hero-cards-preview">
          <div class="hero-card-mini"><span class="emoji">🦄</span>Unicornio</div>
          <div class="hero-card-mini"><span class="emoji">🎂</span>Cumpleaños</div>
          <div class="hero-card-mini"><span class="emoji">🌸</span>Baby Shower</div>
          <div class="hero-card-mini"><span class="emoji">✨</span>Stickers</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ PLANTILLAS NUEVAS ═══ -->
  <section id="novedades">
    <div class="section-header">
      <h2>✨ Plantillas Nuevas</h2>
      <a href="categorias.html">Ver todas →</a>
    </div>
    <div class="slider-outer">
      <button class="slider-arrow left" onclick="slide('slider-nuevas', -230)" aria-label="Anterior">&#10094;</button>
      <div class="slider-track" id="slider-nuevas">

        <div class="product-card">
          <a href="producto.html">
            <div class="img-wrap">
              <img src="Imagenes/Productos/no-results.png" alt="Kit Cumpleaños Unicornio"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
              <div class="img-placeholder" style="display:none">🦄</div>
              <div class="product-badge">NUEVO</div>
            </div>
            <div class="card-body">
              <div class="card-title">Kit Cumpleaños Unicornio</div>
              <div class="card-sub">Invitación + Etiquetas + Banderín</div>
              <div class="card-footer">
                <div>
                  <span class="card-price">$4.99</span>
                </div>
                <div>
                  <div class="card-stars"><span>★★★★★</span> (124)</div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="product-card">
          <a href="producto.html">
            <div class="img-wrap">
              <img src="Imagenes/Productos/no-results.png" alt="Baby Shower Safari"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
              <div class="img-placeholder" style="display:none">🦁</div>
              <div class="product-badge badge-popular">POPULAR</div>
            </div>
            <div class="card-body">
              <div class="card-title">Baby Shower Safari</div>
              <div class="card-sub">Kit completo imprimible</div>
              <div class="card-footer">
                <div><span class="card-price">$6.99</span></div>
                <div><div class="card-stars"><span>★★★★★</span> (89)</div></div>
              </div>
            </div>
          </a>
        </div>

        <div class="product-card">
          <a href="producto.html">
            <div class="img-wrap">
              <img src="Imagenes/Productos/no-results.png" alt="Stickers Kawaii"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
              <div class="img-placeholder" style="display:none">✨</div>
              <div class="product-badge badge-sale">-50%</div>
            </div>
            <div class="card-body">
              <div class="card-title">Pack 50 Stickers Kawaii</div>
              <div class="card-sub">Descarga inmediata</div>
              <div class="card-footer">
                <div>
                  <span class="card-price">$2.49</span>
                  <span class="card-price-old">$4.99</span>
                </div>
                <div><div class="card-stars"><span>★★★★★</span> (203)</div></div>
              </div>
            </div>
          </a>
        </div>

        <div class="product-card">
          <a href="producto.html">
            <div class="img-wrap">
              <img src="Imagenes/Productos/no-results.png" alt="Invitación Editable"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
              <div class="img-placeholder" style="display:none">🎨</div>
              <div class="product-badge badge-editable">EDITABLE</div>
            </div>
            <div class="card-body">
              <div class="card-title">Invitación Editable Canva</div>
              <div class="card-sub">Personaliza en Canva</div>
              <div class="card-footer">
                <div><span class="card-price">$3.99</span></div>
                <div><div class="card-stars"><span>★★★★★</span> (156)</div></div>
              </div>
            </div>
          </a>
        </div>

        <div class="product-card">
          <a href="producto.html">
            <div class="img-wrap">
              <img src="Imagenes/Productos/no-results.png" alt="Etiquetas Escolares"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
              <div class="img-placeholder" style="display:none">🏷️</div>
              <div class="product-badge badge-free">GRATIS</div>
            </div>
            <div class="card-body">
              <div class="card-title">Etiquetas Escolares</div>
              <div class="card-sub">Descarga gratuita</div>
              <div class="card-footer">
                <div><span class="card-price" style="color: #06D6A0;">Gratis</span></div>
                <div><div class="card-stars"><span>★★★★★</span> (412)</div></div>
              </div>
            </div>
          </a>
        </div>

      </div>
      <button class="slider-arrow right" onclick="slide('slider-nuevas', 230)" aria-label="Siguiente">&#10095;</button>
    </div>
  </section>

  <!-- ═══ MÁS DESCARGADAS ═══ -->
  <section id="ofertas">
    <div class="section-header">
      <h2>🔥 Más Descargadas</h2>
      <a href="categorias.html">Ver ranking →</a>
    </div>
    <div class="slider-outer">
      <button class="slider-arrow left" onclick="slide('slider-populares', -230)" aria-label="Anterior">&#10094;</button>
      <div class="slider-track" id="slider-populares">

        <div class="product-card">
          <a href="producto.html">
            <div class="img-wrap">
              <img src="Imagenes/Productos/no-results.png" alt="Kit Fiesta Unicornio"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
              <div class="img-placeholder" style="display:none">🦄</div>
              <div class="product-badge badge-top1">🥇 TOP 1</div>
            </div>
            <div class="card-body">
              <div class="card-title">Kit Fiesta Unicornio Completo</div>
              <div class="card-sub">+50 elementos incluidos</div>
              <div class="card-footer">
                <div><span class="card-price">$12.99</span></div>
                <div><div class="card-stars"><span>★★★★★</span> (534)</div></div>
              </div>
            </div>
          </a>
        </div>

        <div class="product-card">
          <a href="producto.html">
            <div class="img-wrap">
              <img src="Imagenes/Productos/no-results.png" alt="Planificador Mensual"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
              <div class="img-placeholder" style="display:none">📅</div>
              <div class="product-badge badge-top2">🥈 TOP 2</div>
            </div>
            <div class="card-body">
              <div class="card-title">Planificador Mensual 2025</div>
              <div class="card-sub">12 meses + extras</div>
              <div class="card-footer">
                <div><span class="card-price">$5.99</span></div>
                <div><div class="card-stars"><span>★★★★★</span> (421)</div></div>
              </div>
            </div>
          </a>
        </div>

        <div class="product-card">
          <a href="producto.html">
            <div class="img-wrap">
              <img src="Imagenes/Productos/no-results.png" alt="Toppers para Tortas"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
              <div class="img-placeholder" style="display:none">🎂</div>
              <div class="product-badge badge-top3">🥉 TOP 3</div>
            </div>
            <div class="card-body">
              <div class="card-title">Toppers para Tortas</div>
              <div class="card-sub">20 diseños variados</div>
              <div class="card-footer">
                <div><span class="card-price">$3.99</span></div>
                <div><div class="card-stars"><span>★★★★★</span> (389)</div></div>
              </div>
            </div>
          </a>
        </div>

      </div>
      <button class="slider-arrow right" onclick="slide('slider-populares', 230)" aria-label="Siguiente">&#10095;</button>
    </div>
  </section>

  <!-- ═══ CATEGORÍAS DESTACADAS ═══ -->
  <section class="categorias-section">
    <div class="section-header">
      <h2>🗂️ Categorías Populares</h2>
      <a href="categorias.html">Ver todas →</a>
    </div>
    <div class="categorias-grid">
      <a href="#" class="categoria-card">
        <span class="cat-icon">🎂</span>
        <div class="cat-name">Cumpleaños</div>
        <div class="cat-count">348 plantillas</div>
      </a>
      <a href="#" class="categoria-card">
        <span class="cat-icon">✨</span>
        <div class="cat-name">Stickers</div>
        <div class="cat-count">210 diseños</div>
      </a>
      <a href="#" class="categoria-card">
        <span class="cat-icon">💌</span>
        <div class="cat-name">Invitaciones</div>
        <div class="cat-count">185 plantillas</div>
      </a>
      <a href="#" class="categoria-card">
        <span class="cat-icon">🎁</span>
        <div class="cat-name">Regalos personalizados</div>
        <div class="cat-count">120 kits</div>
      </a>
    </div>
  </section>

  <!-- ═══ TRUST BAR ═══ -->
  <div class="trust-bar">
    <div class="trust-inner">
      <div class="trust-item">
        <div class="t-icon">📥</div>
        <strong>Descarga inmediata</strong>
        <span>Al instante de comprar</span>
      </div>
      <div class="trust-item">
        <div class="t-icon">🖨️</div>
        <strong>Imprime en casa</strong>
        <span>Formato A4 y carta</span>
      </div>
      <div class="trust-item">
        <div class="t-icon">✏️</div>
        <strong>100% Editable</strong>
        <span>Canva, Word, PDF</span>
      </div>
      <div class="trust-item">
        <div class="t-icon">💬</div>
        <strong>Soporte incluido</strong>
        <span>Te ayudamos siempre</span>
      </div>
    </div>
  </div>

  <!-- ═══ FOOTER ═══ -->
  <footer>
    <div class="footer-grid">
      <div class="footer-brand">
        <span class="logo-text-f">🐻 GOMITA</span>
        <p>Plantillas digitales descargables para hacer tus celebraciones únicas. Diseños originales listos para imprimir. Hecho con cariño en Colombia. ♥</p>
        <div class="footer-badges">
          <span class="footer-badge">📥 Descarga inmediata</span>
          <span class="footer-badge">🖨️ Imprime en casa</span>
          <span class="footer-badge">✂️ Edita fácilmente</span>
        </div>
        <div class="social-links" style="margin-top:16px">
          <a href="#" class="social-link" aria-label="Instagram">📸</a>
          <a href="#" class="social-link" aria-label="Pinterest">📌</a>
          <a href="#" class="social-link" aria-label="WhatsApp">💬</a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Información</h4>
        <a href="contacto.html">Cómo descargar</a>
        <a href="contacto.html">Cómo imprimir</a>
        <a href="contacto.html">Cómo editar</a>
        <a href="contacto.html">Preguntas frecuentes</a>
      </div>
      <div class="footer-col">
        <h4>Contacto</h4>
        <p>📧 contacto@gomita.com</p>
        <p>📸 <a href="#">@gomita.art</a></p>
        <p>📌 <a href="#">@gomitaplantillas</a></p>
      </div>
      <div class="footer-col">
        <h4>Legal</h4>
        <a href="#">Términos y condiciones</a>
        <a href="#">Política de privacidad</a>
        <a href="#">Licencia de uso</a>
      </div>
    </div>
    <div class="footer-bottom">
      © 2025 Gomita – Plantillas Digitales Descargables 🎨 Hecho con cariño en Colombia
    </div>
  </footer>

  <script>
    function slide(id, amount) {
      document.getElementById(id).scrollBy({ left: amount, behavior: 'smooth' });
    }
  </script>

</body>
</html>
