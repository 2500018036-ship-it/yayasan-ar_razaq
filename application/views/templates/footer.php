<!-- ============================================================ -->
<!-- FOOTER                                                        -->
<!-- ============================================================ -->
<footer class="bg-hijau-950 text-white relative overflow-visible">
    <!-- Top accent line -->
    <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-kuning-500/30 to-transparent"></div>
    <div class="absolute inset-0 pattern-bg opacity-[0.03]"></div>

    <div class="container mx-auto px-4 lg:px-8 pt-12 pb-20 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 reveal">
            <!-- Brand -->
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3 mb-6">
                    <?php if (isset($profil) && $profil && !empty($profil->logo)): ?>
                        <img src="<?= base_url('assets/images/uploads/profil/' . $profil->logo) ?>"
                            alt="Logo <?= isset($profil) && $profil ? $profil->nama_yayasan : 'Yayasan' ?>"
                            class="w-12 h-12 flex-shrink-0 object-contain">
                    <?php else: ?>
                        <div class="w-12 h-12 flex-shrink-0 bg-kuning-500 rounded-xl flex items-center justify-center shadow-lg shadow-kuning-500/20">
                            <span class="font-arabic text-hijau-950 text-xl font-bold">ر</span>
                        </div>
                    <?php endif; ?>
                    <div class="min-w-0">
                        <div class="font-display font-bold text-white text-lg leading-tight"><?= isset($profil) && $profil ? $profil->nama_yayasan : 'Yayasan Ar-Razaq' ?></div>
                        <div class="text-hijau-400/50 text-sm">Pesantren Modern Terpadu</div>
                    </div>
                </div>

                <!-- Decorative separator -->
                <div class="flex items-center gap-3 mb-5">
                    <div class="h-px w-8 bg-kuning-500/30"></div>
                    <div class="w-1 h-1 rounded-full bg-kuning-500/30"></div>
                    <div class="h-px w-4 bg-white/10"></div>
                </div>

                <p class="text-hijau-300/50 text-sm leading-relaxed mb-8 max-w-sm">
                    <?= isset($profil) && $profil ? $profil->deskripsi_singkat : 'Membentuk generasi Qurani yang berakhlak mulia dan berwawasan luas.' ?>
                </p>

                <!-- Social -->
                <div class="flex gap-2.5">
                    <?php if (isset($profil) && $profil): ?>
                        <?php if ($profil->facebook): ?>
                            <a href="<?= $profil->facebook ?>" target="_blank" class="w-10 h-10 bg-white/[0.04] hover:bg-kuning-500 rounded-xl flex items-center justify-center text-hijau-400/60 hover:text-hijau-950 transition-all duration-400 border border-white/[0.04] hover:border-kuning-400">
                                <i data-feather="facebook" class="w-4 h-4"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($profil->instagram): ?>
                            <a href="<?= $profil->instagram ?>" target="_blank" class="w-10 h-10 bg-white/[0.04] hover:bg-kuning-500 rounded-xl flex items-center justify-center text-hijau-400/60 hover:text-hijau-950 transition-all duration-400 border border-white/[0.04] hover:border-kuning-400">
                                <i data-feather="instagram" class="w-4 h-4"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($profil->youtube): ?>
                            <a href="<?= $profil->youtube ?>" target="_blank" class="w-10 h-10 bg-white/[0.04] hover:bg-kuning-500 rounded-xl flex items-center justify-center text-hijau-400/60 hover:text-hijau-950 transition-all duration-400 border border-white/[0.04] hover:border-kuning-400">
                                <i data-feather="youtube" class="w-4 h-4"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($profil->whatsapp): ?>
                            <a href="https://wa.me/<?= $profil->whatsapp ?>" target="_blank" class="w-10 h-10 bg-white/[0.04] hover:bg-kuning-500 rounded-xl flex items-center justify-center text-hijau-400/60 hover:text-hijau-950 transition-all duration-400 border border-white/[0.04] hover:border-kuning-400">
                                <i data-feather="message-circle" class="w-4 h-4"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($profil->tiktok)): ?>
                            <a href="<?= htmlspecialchars($profil->tiktok, ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/[0.04] hover:bg-kuning-500 rounded-xl flex items-center justify-center text-hijau-400/60 hover:text-hijau-950 transition-all duration-400 border border-white/[0.04] hover:border-kuning-400">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.96a8.22 8.22 0 0 0 4.81 1.54V7.07a4.85 4.85 0 0 1-1.04-.38z" />
                                </svg>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-display font-semibold text-kuning-400/70 mb-6 text-sm uppercase tracking-widest">Navigasi</h4>
                <ul class="space-y-3">
                    <?php
                    $links = [
                        [base_url('tentang-kami'), 'Tentang Kami'],
                        [base_url('struktur'), 'Struktur'],
                        [base_url('visi-misi'), 'Visi & Misi'],
                        [base_url('galeri'), 'Galeri'],
                        [base_url('ekskul'), 'Ekstrakurikuler'],
                        [base_url('berita'), 'Berita'],
                        [base_url('ppdb'), 'PPDB'],
                    ];
                    foreach ($links as $link):
                    ?>
                        <li>
                            <a href="<?= $link[0] ?>" class="text-hijau-300/45 hover:text-kuning-400 text-sm transition-colors duration-300 flex items-center gap-2 group">
                                <span class="w-1 h-1 bg-kuning-500/40 rounded-full group-hover:w-2 transition-all duration-300"></span>
                                <?= $link[1] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-display font-semibold text-kuning-400/70 mb-6 text-sm uppercase tracking-widest">Kontak Kami</h4>
                <ul class="space-y-4">
                    <?php if (isset($profil) && $profil): ?>
                        <?php if ($profil->alamat): ?>
                            <li class="flex gap-3">
                                <div class="w-8 h-8 bg-white/[0.04] rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 border border-white/[0.04]">
                                    <i data-feather="map-pin" class="w-3.5 h-3.5 text-kuning-400/60"></i>
                                </div>
                                <span class="text-hijau-300/45 text-sm leading-relaxed"><?= $profil->alamat ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if ($profil->telepon): ?>
                            <li class="flex gap-3 items-center">
                                <div class="w-8 h-8 bg-white/[0.04] rounded-lg flex items-center justify-center flex-shrink-0 border border-white/[0.04]">
                                    <i data-feather="phone" class="w-3.5 h-3.5 text-kuning-400/60"></i>
                                </div>
                                <a href="tel:<?= $profil->telepon ?>" class="text-hijau-300/45 hover:text-kuning-400 text-sm transition-colors"><?= $profil->telepon ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($profil->email): ?>
                            <li class="flex gap-3 items-center">
                                <div class="w-8 h-8 bg-white/[0.04] rounded-lg flex items-center justify-center flex-shrink-0 border border-white/[0.04]">
                                    <i data-feather="mail" class="w-3.5 h-3.5 text-kuning-400/60"></i>
                                </div>
                                <a href="mailto:<?= $profil->email ?>" class="text-hijau-300/45 hover:text-kuning-400 text-sm transition-colors"><?= $profil->email ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="mt-16 pt-8 border-t border-white/[0.05] flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-hijau-400/35 text-sm text-center">
                &copy; <?= date('Y') ?> <?= isset($profil) && $profil ? $profil->nama_yayasan : 'Yayasan Ar-Razaq' ?>. Hak Cipta Dilindungi.
            </p>
            <div class="flex items-center gap-2">
                <span class="text-2xl font-arabic text-kuning-400/30">الحمد لله</span>
            </div>
        </div>
    </div>
</footer>

<!-- Back to top -->
<button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 bg-hijau-800 text-white rounded-xl shadow-lg shadow-hijau-800/30 flex items-center justify-center opacity-0 invisible transition-all duration-500 hover:bg-hijau-700 hover:-translate-y-1 z-40 group">
    <i data-feather="arrow-up" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
</button>

<?php
$popup_data = isset($site_popup) ? $site_popup : null;
if ($popup_data && !empty($popup_data->gambar)):
    $popup_img_url = base_url('assets/images/uploads/popup/' . $popup_data->gambar);
    $popup_target_link = trim((string) $popup_data->target_link);
    $popup_target_mode = ($popup_data->target_mode === '_blank') ? '_blank' : '_self';
    $popup_state_key = 'popup_' . (int) $popup_data->id . '_' . md5((string) $popup_data->updated_at . '|' . (string) $popup_data->gambar . '|' . (string) $popup_data->target_link);
?>
    <!-- ============================================================ -->
    <!-- POPUP: Clean full-image, no background container             -->
    <!-- ============================================================ -->
    <div id="site-popup-overlay"
        class="fixed inset-0 z-[100] bg-black/70 backdrop-blur-[3px] hidden items-center justify-center p-4 sm:p-8"
        aria-hidden="true">

        <div class="relative inline-block" id="site-popup-inner">
            <!-- Close button — floating top-right of the image -->
            <button id="site-popup-close"
                type="button"
                class="absolute -top-4 -right-4 z-10 w-10 h-10 rounded-full bg-white/95 text-gray-600 shadow-lg hover:bg-white hover:text-gray-900 transition-all duration-200 flex items-center justify-center"
                aria-label="Tutup popup">
                <i data-feather="x" class="w-5 h-5"></i>
            </button>

            <!-- Pure image — no background wrapper, no container box -->
            <?php if ($popup_target_link !== ''): ?>
                <a href="<?= htmlspecialchars($popup_target_link, ENT_QUOTES, 'UTF-8') ?>"
                    target="<?= $popup_target_mode ?>"
                    <?= $popup_target_mode === '_blank' ? 'rel="noopener noreferrer"' : '' ?>
                    id="site-popup-image-link">
                    <img src="<?= $popup_img_url ?>"
                        alt="Popup Promosi"
                        class="block max-w-[90vw] max-h-[85vh] w-auto h-auto object-contain rounded-xl shadow-2xl"
                        style="box-shadow: 0 32px 64px rgba(0,0,0,0.5);">
                </a>
            <?php else: ?>
                <img src="<?= $popup_img_url ?>"
                    alt="Popup Promosi"
                    class="block max-w-[90vw] max-h-[85vh] w-auto h-auto object-contain rounded-xl shadow-2xl"
                    style="box-shadow: 0 32px 64px rgba(0,0,0,0.5);">
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<!-- ============================================================ -->
<!-- GLOBAL ANIMATION ENGINE — FIXED & OPTIMIZED                  -->
<!-- ============================================================ -->
<script>
    // Initialize Feather Icons
    feather.replace();

    // ============================================================
    // LENIS SMOOTH SCROLL
    // ============================================================
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const lowPowerDevice = !!(navigator.hardwareConcurrency && navigator.hardwareConcurrency <= 4);
    const hasVisiMisiSection = !!document.getElementById('visi-misi');
    const isVisiMisiPage = /(?:^|\/)visi-misi\/?$/.test(window.location.pathname);
    const perfMode = prefersReducedMotion || lowPowerDevice || isVisiMisiPage;

    const lenis = new Lenis({
        duration: perfMode ? 0.78 : 1.0,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        orientation: 'vertical',
        smoothWheel: !perfMode,
        lerp: perfMode ? 0.14 : 0.1,
        wheelMultiplier: 0.9,
        touchMultiplier: 1.8,
        infinite: false,
    });

    gsap.registerPlugin(ScrollTrigger);

    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);
    lenis.on('scroll', ScrollTrigger.update);

    // ============================================================
    // NAVBAR + TOPBAR HIDE ON SCROLL
    // ============================================================
    const navbar = document.getElementById('navbar');
    const topbar = document.getElementById('topbar');
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuToggleBtn = document.getElementById('menu-toggle');

    const TOPBAR_H = topbar ? topbar.offsetHeight : 44;
    const NAV_SCROLL_THRESHOLD = TOPBAR_H + 10;

    // Offset navbar top by topbar height initially
    if (navbar) {
        navbar.style.top = TOPBAR_H + 'px';
        navbar.style.transition = 'top 0.4s ease, padding 0.5s cubic-bezier(0.16,1,0.3,1)';
    }

    const updateNavbarState = (forcedScroll) => {
        const currentScroll = typeof forcedScroll === 'number' ? forcedScroll : window.scrollY;

        if (currentScroll > NAV_SCROLL_THRESHOLD) {
            navbar.classList.add('scrolled');
            // Hide topbar, move navbar to top
            if (topbar) {
                topbar.style.maxHeight = '0';
                topbar.style.opacity = '0';
                topbar.style.pointerEvents = 'none';
            }
            if (navbar) navbar.style.top = '0';
            if (menuToggleBtn) {
                menuToggleBtn.classList.remove('text-white', 'hover:bg-white/10');
                menuToggleBtn.classList.add('text-hijau-800', 'hover:bg-hijau-50');
            }
        } else {
            navbar.classList.remove('scrolled');
            // Restore topbar
            if (topbar) {
                topbar.style.maxHeight = '44px';
                topbar.style.opacity = '1';
                topbar.style.pointerEvents = '';
            }
            if (navbar) navbar.style.top = TOPBAR_H + 'px';
            if (menuToggleBtn) {
                menuToggleBtn.classList.add('text-white', 'hover:bg-white/10');
                menuToggleBtn.classList.remove('text-hijau-800', 'hover:bg-hijau-50');
            }
        }
    };

    lenis.on('scroll', ({
        scroll
    }) => updateNavbarState(scroll));
    updateNavbarState(window.scrollY);

    // Mobile menu toggle
    menuToggle?.addEventListener('click', () => {
        mobileMenu?.classList.toggle('open');
    });

    // ============================================================
    // HERO ENTRANCE ANIMATIONS
    // ============================================================
    window.addEventListener('load', () => {
        const heroArabic = document.getElementById('hero-arabic');
        const heroBadge = document.getElementById('hero-badge');
        const heroTitle = document.getElementById('hero-title');
        const heroDivider = document.getElementById('hero-divider');
        const heroTagline = document.getElementById('hero-tagline');
        const heroCta = document.getElementById('hero-cta');
        const scrollInd = document.getElementById('scroll-indicator');

        const tl = gsap.timeline({
            delay: 0.2
        });

        if (heroArabic) tl.to(heroArabic, {
            opacity: 1,
            y: 0,
            duration: 0.7,
            ease: 'power2.out'
        }, 0);
        if (heroBadge) tl.to(heroBadge, {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: 'power2.out'
        }, 0.15);
        if (heroTitle) {
            // SplitType word reveal
            try {
                const split = new SplitType(heroTitle, {
                    types: 'words'
                });
                gsap.set(heroTitle, {
                    opacity: 1
                });
                tl.from(split.words, {
                    y: 30,
                    opacity: 0,
                    duration: 0.65,
                    stagger: 0.06,
                    ease: 'power3.out'
                }, 0.25);
            } catch (e) {
                tl.to(heroTitle, {
                    opacity: 1,
                    duration: 0.7,
                    ease: 'power2.out'
                }, 0.25);
            }
        }
        if (heroDivider) tl.to(heroDivider, {
            opacity: 1,
            duration: 0.5,
            ease: 'power2.out'
        }, 0.5);
        if (heroTagline) tl.to(heroTagline, {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: 'power2.out'
        }, 0.55);
        if (heroCta) tl.to(heroCta, {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: 'power3.out'
        }, 0.7);
        if (scrollInd) tl.to(scrollInd, {
            opacity: 1,
            duration: 0.8,
            ease: 'power2.out'
        }, 1.1);
    });

    // ============================================================
    // SCROLL REVEAL (sections)
    // ============================================================
    const revealConfig = {
        threshold: 0.12,
        rootMargin: '0px 0px -40px 0px'
    };

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                gsap.to(entry.target, {
                    opacity: 1,
                    y: 0,
                    x: 0,
                    scale: 1,
                    duration: 0.75,
                    ease: 'power3.out'
                });
                revealObserver.unobserve(entry.target);
            }
        });
    }, revealConfig);

    document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(el => {
        revealObserver.observe(el);
    });

    // Stagger children
    const staggerObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const children = entry.target.querySelectorAll('.stagger-child');
                gsap.to(children, {
                    opacity: 1,
                    y: 0,
                    x: 0,
                    scale: 1,
                    duration: 0.65,
                    ease: 'power3.out',
                    stagger: 0.1
                });
                // Set initial state
                gsap.set(children, {});
                staggerObserver.unobserve(entry.target);
            }
        });
    }, revealConfig);

    document.querySelectorAll('.stagger-parent').forEach(el => {
        const children = el.querySelectorAll('.stagger-child');
        gsap.set(children, {
            opacity: 0,
            y: 30
        });
        staggerObserver.observe(el);
    });

    // ============================================================
    // COUNTER ANIMATION
    // ============================================================
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const target = parseInt(el.getAttribute('data-count'), 10) || 0;
            const duration = 1800;
            const start = performance.now();
            const update = (now) => {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                el.textContent = Math.round(eased * target).toLocaleString('id-ID');
                if (progress < 1) requestAnimationFrame(update);
                else el.textContent = target.toLocaleString('id-ID');
            };
            requestAnimationFrame(update);
            counterObserver.unobserve(el);
        });
    }, {
        threshold: 0.5
    });

    document.querySelectorAll('.counter-number[data-count]').forEach(el => {
        counterObserver.observe(el);
    });

    // ============================================================
    // SPLIT TEXT REVEAL (section headings)
    // ============================================================
    document.querySelectorAll('[data-split-reveal]').forEach(el => {
        try {
            const split = new SplitType(el, {
                types: 'words'
            });
            gsap.set(split.words, {
                opacity: 0,
                y: 20
            });
            const obs = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        gsap.to(split.words, {
                            opacity: 1,
                            y: 0,
                            duration: 0.55,
                            stagger: 0.07,
                            ease: 'power3.out'
                        });
                        obs.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2
            });
            obs.observe(el);
        } catch (e) {}
    });

    // ============================================================
    // TIMELINE LINE ANIMATION
    // ============================================================
    const timelineLine = document.getElementById('timeline-line');
    if (timelineLine) {
        ScrollTrigger.create({
            trigger: '#sejarah',
            start: 'top 70%',
            end: 'bottom 30%',
            onUpdate: (self) => {
                gsap.set(timelineLine, {
                    scaleY: self.progress
                });
            }
        });
    }

    // ============================================================
    // BACK TO TOP
    // ============================================================
    const backToTop = document.getElementById('back-to-top');
    if (backToTop) {
        lenis.on('scroll', ({
            scroll
        }) => {
            if (scroll > 500) {
                backToTop.classList.remove('opacity-0', 'invisible');
                backToTop.classList.add('opacity-100', 'visible');
            } else {
                backToTop.classList.add('opacity-0', 'invisible');
                backToTop.classList.remove('opacity-100', 'visible');
            }
        });
        backToTop.addEventListener('click', () => {
            lenis.scrollTo(0, {
                duration: 1.4,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t))
            });
        });
    }

    // ============================================================
    // GALLERY HORIZONTAL SCROLL (GSAP-driven)
    // ============================================================
    const galleryWrapper = document.getElementById('gallery-scroll-wrapper');
    if (galleryWrapper) {
        const gallerySection = document.getElementById('gallery-scroll-section');
        const maxScroll = galleryWrapper.scrollWidth - galleryWrapper.parentElement.offsetWidth;

        if (maxScroll > 0 && !perfMode) {
            gsap.to(galleryWrapper, {
                x: -maxScroll,
                ease: 'none',
                scrollTrigger: {
                    trigger: gallerySection,
                    start: 'top top',
                    end: `+=${maxScroll * 1.2}`,
                    pin: true,
                    scrub: 1.5,
                    anticipatePin: 1,
                }
            });
        } else {
            // Fallback: native horizontal scroll
            galleryWrapper.style.overflowX = 'auto';
            galleryWrapper.style.paddingBottom = '12px';
        }
    }

    // ============================================================
    // VISI-MISI PARTICLES
    // ============================================================
    const particleContainer = document.getElementById('visi-particles');
    if (particleContainer && !perfMode) {
        const particleCount = 10;
        for (let i = 0; i < particleCount; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            const size = Math.random() * 3 + 1.5;
            p.style.cssText = `
                width: ${size}px;
                height: ${size}px;
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                background: rgba(250, 204, 21, ${Math.random() * 0.25 + 0.05});
            `;
            particleContainer.appendChild(p);
            gsap.to(p, {
                y: -(Math.random() * 80 + 30),
                x: (Math.random() - 0.5) * 40,
                opacity: 0,
                duration: Math.random() * 6 + 5,
                repeat: -1,
                ease: 'power1.inOut',
                delay: Math.random() * 6,
                yoyo: false
            });
        }
    }

    // ============================================================
    // 3D CARD TILT EFFECT
    // ============================================================
    if (!('ontouchstart' in window)) {
        document.querySelectorAll('.card-3d').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width;
                const y = (e.clientY - rect.top) / rect.height;
                const rotateX = (y - 0.5) * -6;
                const rotateY = (x - 0.5) * 6;
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.015, 1.015, 1.015)`;
            }, {
                passive: true
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
            });
        });
    }

    // ============================================================
    // SMOOTH ANCHOR SCROLLING (via Lenis)
    // ============================================================
    const normalizePath = (path) => (path || '').replace(/\/+$/, '') || '/';

    document.querySelectorAll('a[data-scroll-top="1"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const rawHref = this.getAttribute('href');
            if (!rawHref) return;

            const targetUrl = new URL(rawHref, window.location.href);
            const sameOrigin = targetUrl.origin === window.location.origin;
            const samePath = normalizePath(targetUrl.pathname) === normalizePath(window.location.pathname);
            const hasHash = !!targetUrl.hash;

            if (sameOrigin && samePath && !hasHash) {
                e.preventDefault();
                lenis.scrollTo(0, {
                    duration: 1.2
                });
                const cleanPath = targetUrl.pathname + (targetUrl.search || '');
                if (window.location.hash) {
                    history.replaceState(null, '', cleanPath);
                }
                if (mobileMenu) mobileMenu.classList.remove('open');
            }
        });
    });

    document.querySelectorAll('a[href*="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const rawHref = this.getAttribute('href');
            if (!rawHref || rawHref === '#') return;

            const targetUrl = new URL(rawHref, window.location.href);
            const targetHash = targetUrl.hash || '';
            if (!targetHash || targetHash === '#') return;

            const sameOrigin = targetUrl.origin === window.location.origin;
            const samePath = normalizePath(targetUrl.pathname) === normalizePath(window.location.pathname);
            if (!sameOrigin || !samePath) return;

            const target = document.querySelector(targetHash);
            if (target) {
                e.preventDefault();
                lenis.scrollTo(target, {
                    offset: -80,
                    duration: 1.8
                });
                history.replaceState(null, '', targetHash);
                if (mobileMenu) mobileMenu.classList.remove('open');
            }
        });
    });

    window.addEventListener('load', () => {
        if (!window.location.hash || window.location.hash === '#') return;
        const target = document.querySelector(window.location.hash);
        if (target) {
            setTimeout(() => {
                lenis.scrollTo(target, {
                    offset: -80,
                    duration: 1.8
                });
            }, 120);
        }
    });

    // ============================================================
    // REFRESH SCROLLTRIGGER ON WINDOW RESIZE (debounced)
    // ============================================================
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            ScrollTrigger.refresh();
        }, 250);
    }, {
        passive: true
    });

    // ============================================================
    // POPUP
    // ============================================================
    (function() {
        const overlay = document.getElementById('site-popup-overlay');
        if (!overlay) return;

        const closeBtn = document.getElementById('site-popup-close');
        const popupStateKey = '<?= isset($popup_state_key) ? $popup_state_key : '' ?>';

        const closePopup = () => {
            gsap.to(overlay.querySelector('#site-popup-inner'), {
                scale: 0.94,
                opacity: 0,
                duration: 0.25,
                ease: 'power2.in',
                onComplete: () => {
                    overlay.classList.add('hidden');
                    overlay.classList.remove('flex');
                    document.body.classList.remove('popup-open');
                    gsap.set(overlay.querySelector('#site-popup-inner'), {
                        scale: 1,
                        opacity: 1
                    });
                }
            });
            gsap.to(overlay, {
                opacity: 0,
                duration: 0.3,
                ease: 'power2.in'
            });
        };

        const openPopup = () => {
            if (popupStateKey && sessionStorage.getItem(popupStateKey) === '1') return;
            if (popupStateKey) sessionStorage.setItem(popupStateKey, '1');
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            document.body.classList.add('popup-open');
            feather.replace();

            // Entrance animation
            const inner = overlay.querySelector('#site-popup-inner');
            gsap.fromTo(overlay, {
                opacity: 0
            }, {
                opacity: 1,
                duration: 0.35,
                ease: 'power2.out'
            });
            gsap.fromTo(inner, {
                scale: 0.90,
                opacity: 0,
                y: 20
            }, {
                scale: 1,
                opacity: 1,
                y: 0,
                duration: 0.45,
                ease: 'power3.out',
                delay: 0.05
            });
        };

        closeBtn?.addEventListener('click', closePopup);
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) closePopup();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && overlay.classList.contains('flex')) {
                closePopup();
            }
        });

        window.addEventListener('load', () => {
            setTimeout(openPopup, 600);
        }, {
            once: true
        });
    })();
</script>
<style>
    body.popup-open {
        overflow: hidden;
    }
</style>
</body>

</html>