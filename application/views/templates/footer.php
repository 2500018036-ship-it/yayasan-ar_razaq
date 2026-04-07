<!-- ============================================================ -->
<!-- FOOTER -->
<!-- ============================================================ -->
<footer class="bg-hijau-950 text-white relative overflow-visible">
    <div class="absolute inset-0 pattern-bg opacity-[0.03]"></div>

    <!-- Wave top — rendered as a BLOCK element with negative top margin so it
         pulls up and overlaps the preceding section regardless of its height.
         JS detects the preceding section's bg color and writes it into the fill
         so the wave always matches, on every single page. -->
    <div id="footer-wave-wrap" style="display:block; line-height:0; margin-top:-79px; position:relative; z-index:5; pointer-events:none;">
        <svg id="footer-wave-svg" viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
            style="display:block; width:100%; height:80px;">
            <path id="footer-wave-path"
                d="M0,24 C240,4 480,44 720,24 C960,4 1200,44 1440,24 L1440,0 L0,0 Z"
                fill="#ffffff" />
        </svg>
    </div>
    <script>
        // Detect preceding section's background color and apply to wave fill.
        // Runs inline (before paint) to avoid any flash.
        (function() {
            var BG_MAP = {
                'bg-white': '#ffffff',
                'bg-gray-50': '#f9fafb',
                'bg-gray-100': '#f3f4f6',
                'bg-hijau-50': '#f0fdf4',
                'bg-hijau-900': '#14532d',
                'bg-hijau-950': '#052e16',
            };

            function resolveColor(el) {
                if (!el || el === document.documentElement) return '#ffffff';
                var cls = (el.className || '').toString();
                for (var key in BG_MAP) {
                    if (cls.indexOf(key) !== -1) return BG_MAP[key];
                }
                try {
                    var bg = window.getComputedStyle(el).backgroundColor;
                    if (bg && bg !== 'rgba(0, 0, 0, 0)' && bg !== 'transparent') {
                        var m = bg.match(/\d+/g);
                        if (m && m.length >= 3) {
                            return '#' + [m[0], m[1], m[2]].map(function(v) {
                                return ('0' + parseInt(v).toString(16)).slice(-2);
                            }).join('');
                        }
                    }
                } catch (e) {}
                return resolveColor(el.parentElement);
            }

            function apply() {
                var footer = document.querySelector('footer');
                if (!footer) return;
                // The wave wrap itself is now INSIDE footer — so look at footer's
                // preceding sibling in the DOM.
                var prev = footer.previousElementSibling;
                while (prev && (prev.tagName === 'SCRIPT' || prev.tagName === 'NOSCRIPT' || prev.tagName === 'STYLE')) {
                    prev = prev.previousElementSibling;
                }
                var color = (prev ? resolveColor(prev) : null) || '#ffffff';
                var path = document.getElementById('footer-wave-path');
                if (path) path.setAttribute('fill', color);
            }

            apply();
            // Also re-apply after full load (Tailwind CDN finishes computing styles)
            window.addEventListener('load', apply);
        })();
    </script>

    <div class="container mx-auto px-4 lg:px-8 pt-8 pb-20 relative z-10">
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
                <p class="text-hijau-300/50 text-sm leading-relaxed mb-8 max-w-sm">
                    <?= isset($profil) && $profil ? $profil->deskripsi_singkat : 'Membentuk generasi Qurani yang berakhlak mulia dan berwawasan luas.' ?>
                </p>
                <!-- Social -->
                <div class="flex gap-3">
                    <?php if (isset($profil) && $profil): ?>
                        <?php if ($profil->facebook): ?>
                            <a href="<?= $profil->facebook ?>" target="_blank" class="w-10 h-10 bg-white/[0.04] hover:bg-kuning-500 rounded-xl flex items-center justify-center text-hijau-400/60 hover:text-hijau-950 transition-all duration-500">
                                <i data-feather="facebook" class="w-4 h-4"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($profil->instagram): ?>
                            <a href="<?= $profil->instagram ?>" target="_blank" class="w-10 h-10 bg-white/[0.04] hover:bg-kuning-500 rounded-xl flex items-center justify-center text-hijau-400/60 hover:text-hijau-950 transition-all duration-500">
                                <i data-feather="instagram" class="w-4 h-4"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($profil->youtube): ?>
                            <a href="<?= $profil->youtube ?>" target="_blank" class="w-10 h-10 bg-white/[0.04] hover:bg-kuning-500 rounded-xl flex items-center justify-center text-hijau-400/60 hover:text-hijau-950 transition-all duration-500">
                                <i data-feather="youtube" class="w-4 h-4"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($profil->whatsapp): ?>
                            <a href="https://wa.me/<?= $profil->whatsapp ?>" target="_blank" class="w-10 h-10 bg-white/[0.04] hover:bg-kuning-500 rounded-xl flex items-center justify-center text-hijau-400/60 hover:text-hijau-950 transition-all duration-500">
                                <i data-feather="message-circle" class="w-4 h-4"></i>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-display font-semibold text-kuning-400/80 mb-6 text-base">Navigasi</h4>
                <ul class="space-y-3">
                    <?php
                    $links = [
                        ['#sejarah', 'Profil Yayasan'],
                        ['#visi-misi', 'Visi & Misi'],
                        ['#galeri', 'Galeri'],
                        ['#ekskul', 'Ekstrakurikuler'],
                        [base_url('berita'), 'Berita'],
                        [base_url('ppdb'), 'PPDB'],
                    ];
                    foreach ($links as $link):
                    ?>
                        <li>
                            <a href="<?= $link[0] ?>" class="text-hijau-300/50 hover:text-kuning-400 text-sm transition-colors duration-300 flex items-center gap-2 group">
                                <span class="w-1 h-1 bg-kuning-500/50 rounded-full group-hover:w-2 transition-all duration-300"></span>
                                <?= $link[1] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-display font-semibold text-kuning-400/80 mb-6 text-base">Kontak Kami</h4>
                <ul class="space-y-4">
                    <?php if (isset($profil) && $profil): ?>
                        <?php if ($profil->alamat): ?>
                            <li class="flex gap-3">
                                <div class="w-8 h-8 bg-white/[0.04] rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-feather="map-pin" class="w-3.5 h-3.5 text-kuning-400/60"></i>
                                </div>
                                <span class="text-hijau-300/50 text-sm leading-relaxed"><?= $profil->alamat ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if ($profil->telepon): ?>
                            <li class="flex gap-3 items-center">
                                <div class="w-8 h-8 bg-white/[0.04] rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-feather="phone" class="w-3.5 h-3.5 text-kuning-400/60"></i>
                                </div>
                                <a href="tel:<?= $profil->telepon ?>" class="text-hijau-300/50 hover:text-kuning-400 text-sm transition-colors"><?= $profil->telepon ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($profil->email): ?>
                            <li class="flex gap-3 items-center">
                                <div class="w-8 h-8 bg-white/[0.04] rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-feather="mail" class="w-3.5 h-3.5 text-kuning-400/60"></i>
                                </div>
                                <a href="mailto:<?= $profil->email ?>" class="text-hijau-300/50 hover:text-kuning-400 text-sm transition-colors"><?= $profil->email ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="mt-16 pt-8 border-t border-white/[0.05] flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-hijau-400/40 text-sm text-center">
                &copy; <?= date('Y') ?> <?= isset($profil) && $profil ? $profil->nama_yayasan : 'Yayasan Ar-Razaq' ?>. Hak Cipta Dilindungi.
            </p>
            <div class="flex items-center gap-2">
                <span class="text-2xl font-arabic text-kuning-400/40">بِسْمِ اللهِ</span>
            </div>
        </div>
    </div>
</footer>

<!-- Back to top -->
<button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 bg-hijau-800 text-white rounded-xl shadow-lg shadow-hijau-800/30 flex items-center justify-center opacity-0 invisible transition-all duration-500 hover:bg-hijau-700 hover:-translate-y-1 z-40 group">
    <i data-feather="arrow-up" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
</button>

<!-- ============================================================ -->
<!-- GLOBAL ANIMATION ENGINE — FIXED & OPTIMIZED                  -->
<!-- ============================================================ -->
<script>
    // Initialize Feather Icons
    feather.replace();

    // ============================================================
    // LENIS SMOOTH SCROLL
    // *** FIX: Remove double-tick. Only ONE of these two patterns
    //     should drive Lenis. We use the GSAP ticker exclusively
    //     (recommended by both Lenis and GSAP docs for GSAP projects).
    //     The standalone requestAnimationFrame(raf) loop has been removed.
    // ============================================================
    const lenis = new Lenis({
        duration: 1.0,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        orientation: 'vertical',
        smoothWheel: true,
        lerp: 0.1,
        wheelMultiplier: 0.9,
        touchMultiplier: 1.8,
        infinite: false,
    });

    // Register GSAP plugin first
    gsap.registerPlugin(ScrollTrigger);

    // *** FIX: Use ONLY the GSAP ticker to drive Lenis
    //     (previously both RAF + gsap.ticker were running, causing double frames)
    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });

    // Disable GSAP's default lag smoothing to keep Lenis in full control
    gsap.ticker.lagSmoothing(0);

    // Sync ScrollTrigger with Lenis
    lenis.on('scroll', ScrollTrigger.update);

    // ============================================================
    // NAVBAR
    // ============================================================
    const navbar = document.getElementById('navbar');
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    const menuToggleBtn = document.getElementById('menu-toggle');

    const NAV_SCROLL_THRESHOLD = 42;

    const updateNavbarState = (forcedScroll) => {
        const currentScroll = typeof forcedScroll === 'number' ? forcedScroll : window.scrollY;

        if (currentScroll > NAV_SCROLL_THRESHOLD) {
            navbar.classList.add('scrolled');
            if (menuToggleBtn) {
                menuToggleBtn.classList.remove('text-white', 'hover:bg-white/10');
                menuToggleBtn.classList.add('text-hijau-800', 'hover:bg-hijau-50');
            }
        } else {
            navbar.classList.remove('scrolled');
            if (menuToggleBtn) {
                menuToggleBtn.classList.add('text-white', 'hover:bg-white/10');
                menuToggleBtn.classList.remove('text-hijau-800', 'hover:bg-hijau-50');
            }
        }

        // Back to top button
        const backTop = document.getElementById('back-to-top');
        if (backTop) {
            if (currentScroll > 500) {
                backTop.classList.remove('opacity-0', 'invisible');
                backTop.classList.add('opacity-100', 'visible');
            } else {
                backTop.classList.add('opacity-0', 'invisible');
                backTop.classList.remove('opacity-100', 'visible');
            }
        }
    };

    // Keep navbar state in sync with Lenis virtual scroll position
    lenis.on('scroll', (evt) => {
        const nextScroll = evt && typeof evt.scroll === 'number' ? evt.scroll : window.scrollY;
        updateNavbarState(nextScroll);
    });

    // Keep state correct on hard refresh / history navigation
    updateNavbarState(window.scrollY);

    // Mobile menu toggle
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });
    }

    // Back to top
    document.getElementById('back-to-top')?.addEventListener('click', () => {
        lenis.scrollTo(0, {
            duration: 2
        });
    });

    // ============================================================
    // HERO ENTRANCE ANIMATION
    // ============================================================
    window.addEventListener('load', () => {
        const heroTl = gsap.timeline({
            delay: 0.3
        });

        try {
            const heroTitleSplit = new SplitType('#hero-title', {
                types: 'chars'
            });
            heroTl
                .to('#hero-arabic', {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    ease: 'power3.out'
                })
                .to('#hero-badge', {
                    opacity: 1,
                    y: 0,
                    duration: 0.7,
                    ease: 'power3.out'
                }, '-=0.5')
                .from(heroTitleSplit.chars, {
                    opacity: 0,
                    y: 60,
                    rotateX: -40,
                    stagger: 0.03,
                    duration: 0.8,
                    ease: 'power3.out'
                }, '-=0.3')
                .set('#hero-title', {
                    opacity: 1
                }, '<')
                .to('#hero-tagline', {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: 'power3.out'
                }, '-=0.4')
                .to('#hero-cta', {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: 'power3.out'
                }, '-=0.5')
                .to('#scroll-indicator', {
                    opacity: 1,
                    duration: 1,
                    ease: 'power3.out'
                }, '-=0.3');
        } catch (e) {
            heroTl
                .to('#hero-arabic', {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    ease: 'power3.out'
                })
                .to('#hero-badge', {
                    opacity: 1,
                    y: 0,
                    duration: 0.7,
                    ease: 'power3.out'
                }, '-=0.5')
                .to('#hero-title', {
                    opacity: 1,
                    y: 0,
                    duration: 0.9,
                    ease: 'power3.out'
                }, '-=0.3')
                .to('#hero-tagline', {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: 'power3.out'
                }, '-=0.5')
                .to('#hero-cta', {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: 'power3.out'
                }, '-=0.4')
                .to('#scroll-indicator', {
                    opacity: 1,
                    duration: 1,
                    ease: 'power3.out'
                }, '-=0.3');
        }

        // Hero parallax — content fades out as scrolled
        gsap.to('#hero-content', {
            y: -80,
            opacity: 0,
            ease: 'none',
            scrollTrigger: {
                trigger: '#hero',
                start: 'top top',
                end: '70% top',
                scrub: 1.5
            }
        });

        // Scroll indicator fades
        gsap.to('#scroll-indicator', {
            opacity: 0,
            y: 20,
            scrollTrigger: {
                trigger: '#hero',
                start: '10% top',
                end: '30% top',
                scrub: true
            }
        });
    });

    // ============================================================
    // PARALLAX BACKGROUNDS
    // ============================================================
    gsap.utils.toArray('[data-parallax-bg]').forEach(el => {
        const speed = parseFloat(el.dataset.parallaxBg) || 0.2;
        gsap.to(el, {
            yPercent: speed * 80,
            ease: 'none',
            scrollTrigger: {
                trigger: el.closest('section') || el.parentElement,
                start: 'top bottom',
                end: 'bottom top',
                scrub: 1
            }
        });
    });

    // ============================================================
    // REVEAL ANIMATIONS
    // *** FIX: Use BatchPlugin-style grouping via markers:false to
    //     reduce the number of active ScrollTrigger instances.
    //     Also use will-change only during animation, not permanently.
    // ============================================================
    ScrollTrigger.batch('.reveal', {
        onEnter: (elements) => {
            gsap.to(elements, {
                opacity: 1,
                y: 0,
                duration: 0.9,
                ease: 'power3.out',
                stagger: 0.08,
                overwrite: true
            });
        },
        start: 'top 88%',
        once: true // Only trigger once, saves memory
    });

    ScrollTrigger.batch('.reveal-left', {
        onEnter: (elements) => {
            gsap.to(elements, {
                opacity: 1,
                x: 0,
                duration: 1,
                ease: 'power3.out',
                stagger: 0.1,
                overwrite: true
            });
        },
        start: 'top 88%',
        once: true
    });

    ScrollTrigger.batch('.reveal-right', {
        onEnter: (elements) => {
            gsap.to(elements, {
                opacity: 1,
                x: 0,
                duration: 1,
                ease: 'power3.out',
                stagger: 0.1,
                overwrite: true
            });
        },
        start: 'top 88%',
        once: true
    });

    ScrollTrigger.batch('.reveal-scale', {
        onEnter: (elements) => {
            gsap.to(elements, {
                opacity: 1,
                scale: 1,
                duration: 0.7,
                ease: 'back.out(1.7)',
                stagger: 0.08,
                overwrite: true
            });
        },
        start: 'top 88%',
        once: true
    });

    // ============================================================
    // STAGGER CHILDREN — Visi Misi cards & nilai
    // *** FIX: Use a single ScrollTrigger per parent, not per child.
    //     Reduced stagger for smoother, faster cascade.
    //     Added will-change cleanup after animation completes.
    // ============================================================
    gsap.utils.toArray('.stagger-parent').forEach(parent => {
        const children = parent.querySelectorAll('.stagger-child');
        if (!children.length) return;

        // Set initial state without relying on CSS (more predictable)
        gsap.set(children, {
            opacity: 0,
            y: 40,
            willChange: 'transform, opacity'
        });

        gsap.to(children, {
            opacity: 1,
            y: 0,
            duration: 0.65, // Shorter = feels snappier, less lag
            stagger: {
                each: 0.1, // 100ms between each card — smooth, not jarring
                from: 'start',
                ease: 'power2.out'
            },
            ease: 'power3.out',
            scrollTrigger: {
                trigger: parent,
                start: 'top 82%',
                once: true,
                onComplete: () => {
                    // Release will-change to free GPU memory after animation
                    gsap.set(children, {
                        willChange: 'auto'
                    });
                }
            }
        });
    });

    // ============================================================
    // SPLIT TEXT REVEALS (section headers)
    // *** FIX: Add reducedMotion check + limit character count to
    //     avoid performance issues with many chars.
    // ============================================================
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!prefersReducedMotion) {
        try {
            gsap.utils.toArray('[data-split-reveal]').forEach(el => {
                const split = new SplitType(el, {
                    types: 'chars, words'
                });
                const chars = split.chars;

                // Skip if too many characters (performance threshold)
                if (!chars || chars.length > 80) return;

                gsap.set(el, {
                    opacity: 1
                }); // Make wrapper visible
                gsap.from(chars, {
                    opacity: 0,
                    y: 35,
                    rotateX: -25,
                    stagger: 0.02,
                    duration: 0.6,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 85%',
                        once: true
                    }
                });
            });
        } catch (e) {
            // SplitType unavailable — let the text show normally
            gsap.utils.toArray('[data-split-reveal]').forEach(el => {
                gsap.set(el, {
                    opacity: 1
                });
            });
        }
    } else {
        // Respect user's reduced motion preference
        gsap.utils.toArray('[data-split-reveal]').forEach(el => {
            gsap.set(el, {
                opacity: 1
            });
        });
        gsap.utils.toArray('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(el => {
            gsap.set(el, {
                opacity: 1,
                y: 0,
                x: 0,
                scale: 1
            });
        });
    }

    // ============================================================
    // COUNTER ANIMATION (Statistics)
    // ============================================================
    gsap.utils.toArray('.counter-number').forEach(counter => {
        const target = counter.dataset.count;
        const isNumber = !isNaN(parseFloat(target)) && isFinite(target);

        if (isNumber) {
            const obj = {
                val: 0
            };
            gsap.to(obj, {
                val: parseFloat(target),
                duration: 2.5,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: counter,
                    start: 'top 85%',
                    once: true
                },
                onUpdate: () => {
                    counter.textContent = Math.floor(obj.val).toLocaleString('id-ID');
                }
            });
        } else {
            ScrollTrigger.create({
                trigger: counter,
                start: 'top 85%',
                once: true,
                onEnter: () => {
                    counter.textContent = target;
                }
            });
        }
    });

    // ============================================================
    // HORIZONTAL GALLERY SCROLL
    // ============================================================
    const galleryWrapper = document.getElementById('gallery-scroll-wrapper');
    const gallerySection = document.getElementById('gallery-scroll-section');

    if (galleryWrapper && gallerySection && window.innerWidth > 768) {
        const totalScrollWidth = galleryWrapper.scrollWidth - window.innerWidth + 200;

        gsap.to(galleryWrapper, {
            x: () => -totalScrollWidth,
            ease: 'none',
            scrollTrigger: {
                trigger: gallerySection,
                start: 'top 20%',
                end: () => '+=' + totalScrollWidth,
                pin: true,
                scrub: 1.5,
                invalidateOnRefresh: true,
                anticipatePin: 1
            }
        });
    }

    // ============================================================
    // TIMELINE GROWING LINE
    // ============================================================
    const timelineLine = document.getElementById('timeline-line');
    if (timelineLine) {
        gsap.to(timelineLine, {
            scaleY: 1,
            ease: 'none',
            scrollTrigger: {
                trigger: '#sejarah',
                start: 'top 60%',
                end: 'bottom 40%',
                scrub: 1.5
            }
        });
    }

    // ============================================================
    // FLOATING PARTICLES (Visi Misi section)
    // *** FIX: Reduce particle count on mobile, use CSS animation
    //     instead of GSAP for static floaters to reduce JS overhead.
    // ============================================================
    const particleContainer = document.getElementById('visi-particles');
    if (particleContainer) {
        if (!document.getElementById('vm-particle-style')) {
            const style = document.createElement('style');
            style.id = 'vm-particle-style';
            style.textContent = `
                @keyframes vmParticleFloat {
                    0% { transform: translate3d(0, 0, 0); opacity: .18; }
                    50% { transform: translate3d(var(--vm-x), var(--vm-y), 0); opacity: .48; }
                    100% { transform: translate3d(0, 0, 0); opacity: .18; }
                }
            `;
            document.head.appendChild(style);
        }

        const prefersReduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const lowPowerDevice = (navigator.hardwareConcurrency && navigator.hardwareConcurrency <= 4);
        if (prefersReduce || lowPowerDevice) {
            particleContainer.innerHTML = '';
        } else {
        const isMobile = window.innerWidth < 768;
        const particleCount = isMobile ? 5 : 9;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            const size = Math.random() * 3 + 1;
            const isGold = Math.random() > 0.5;
            const delay = (Math.random() * 2.4).toFixed(2);
            const dur = (Math.random() * 3.2 + 4.8).toFixed(2);
            const driftX = (Math.random() * 24 - 12).toFixed(1) + 'px';
            const driftY = (Math.random() * 42 - 21).toFixed(1) + 'px';

            particle.style.cssText = `
                width: ${size}px;
                height: ${size}px;
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                background: ${isGold ? 'rgba(234, 179, 8, 0.35)' : 'rgba(74, 222, 128, 0.25)'};
                opacity: ${(Math.random() * 0.4 + 0.15).toFixed(2)};
                position: absolute;
                border-radius: 50%;
                pointer-events: none;
                --vm-x: ${driftX};
                --vm-y: ${driftY};
                animation: vmParticleFloat ${dur}s ease-in-out ${delay}s infinite;
            `;
            particleContainer.appendChild(particle);
        }
      }
    }

    // ============================================================
    // MAGNETIC BUTTON EFFECT (Desktop only)
    // ============================================================
    if (window.innerWidth > 1024) {
        document.querySelectorAll('.magnetic-btn').forEach(btn => {
            btn.addEventListener('mousemove', (e) => {
                const rect = btn.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                btn.style.transform = `translate(${x * 0.12}px, ${y * 0.12}px)`;
            }, {
                passive: true
            });

            btn.addEventListener('mouseleave', () => {
                gsap.to(btn, {
                    x: 0,
                    y: 0,
                    duration: 0.4,
                    ease: 'elastic.out(1, 0.5)'
                });
                btn.style.transform = '';
            });
        });
    }

    // ============================================================
    // 3D CARD TILT ON HOVER (Desktop only)
    // ============================================================
    if (window.innerWidth > 1024) {
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

    // Beranda click: if still on current page, smooth scroll to top (no reload)
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
</script>
</body>

</html>
