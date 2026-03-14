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
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
            </button>
        </div>

        <div class="header-actions">
            <a href="login.html" class="btn-ghost">
                <svg viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Mi cuenta
            </a>
            <a href="carrito.html" class="btn-cart">
                <svg viewBox="0 0 24 24">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <path d="M16 10a4 4 0 0 1-8 0" />
                </svg>
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
