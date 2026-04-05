<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Yayasan Ar-Razaq</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'hijau': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                            950: '#052e16'
                        },
                        'kuning': {
                            300: '#fde047',
                            400: '#facc15',
                            500: '#eab308',
                            600: '#ca8a04'
                        }
                    },
                    fontFamily: {
                        'arabic': ['Scheherazade New', 'serif'],
                        'display': ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&family=Scheherazade+New:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-display {
            font-family: 'Playfair Display', serif;
        }

        .font-arabic {
            font-family: 'Scheherazade New', serif;
        }

        .pattern-bg {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Left panel animations */
        @keyframes float-slow {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-18px) rotate(3deg);
            }
        }

        @keyframes float-med {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-12px) rotate(-2deg);
            }
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.95);
                opacity: 0.6;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.3;
            }

            100% {
                transform: scale(0.95);
                opacity: 0.6;
            }
        }

        @keyframes drift {

            0%,
            100% {
                transform: translate(0, 0);
            }

            33% {
                transform: translate(10px, -15px);
            }

            66% {
                transform: translate(-8px, 8px);
            }
        }

        .float-slow {
            animation: float-slow 6s ease-in-out infinite;
        }

        .float-med {
            animation: float-med 4.5s ease-in-out infinite 0.8s;
        }

        .pulse-ring {
            animation: pulse-ring 3s ease-in-out infinite;
        }

        .drift {
            animation: drift 8s ease-in-out infinite;
        }

        /* Form input focus */
        .input-field {
            transition: border-color 0.25s ease, box-shadow 0.25s ease, background-color 0.2s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: #166534;
            box-shadow: 0 0 0 3px rgba(22, 101, 52, 0.12);
            background-color: #ffffff;
        }

        /* Button */
        .btn-login {
            background: linear-gradient(135deg, #052e16 0%, #166534 60%, #15803d 100%);
            transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
        }

        .btn-login:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(5, 46, 22, 0.35);
        }

        .btn-login:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Page entrance */
        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-up {
            animation: slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .slide-up-delay-1 {
            animation: slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.1s both;
        }

        .slide-up-delay-2 {
            animation: slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.2s both;
        }

        .slide-up-delay-3 {
            animation: slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.3s both;
        }

        .slide-up-delay-4 {
            animation: slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.4s both;
        }

        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .spin-slow {
            animation: spin-slow 20s linear infinite;
        }

        .spin-reverse {
            animation: spin-slow 15s linear infinite reverse;
        }

        /* Alert animation */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-6px);
            }

            40% {
                transform: translateX(6px);
            }

            60% {
                transform: translateX(-4px);
            }

            80% {
                transform: translateX(4px);
            }
        }

        .shake {
            animation: shake 0.4s ease-out;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex overflow-hidden">

    <!-- ============================================================ -->
    <!-- LEFT PANEL — Dark Branding -->
    <!-- ============================================================ -->
    <div class="hidden lg:flex lg:w-[58%] xl:w-[62%] relative bg-hijau-950 flex-col overflow-hidden">

        <!-- Islamic pattern overlay -->
        <div class="absolute inset-0 pattern-bg opacity-100"></div>

        <!-- Gradient layers -->
        <div class="absolute inset-0 bg-gradient-to-br from-hijau-950 via-hijau-900/90 to-hijau-800/70"></div>

        <!-- Decorative blobs -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-hijau-700/20 rounded-full blur-[120px] drift"></div>
        <div class="absolute bottom-0 -right-20 w-80 h-80 bg-kuning-500/10 rounded-full blur-[100px]" style="animation: drift 10s ease-in-out infinite 2s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-hijau-600/5 rounded-full blur-[180px]"></div>

        <!-- Spinning geometric ornaments -->
        <div class="absolute top-16 right-24 opacity-[0.07] spin-slow">
            <svg width="100" height="100" viewBox="0 0 120 120" fill="none">
                <path d="M60 0L67 53L120 60L67 67L60 120L53 67L0 60L53 53L60 0Z" fill="#facc15" />
            </svg>
        </div>
        <div class="absolute bottom-28 left-20 opacity-[0.05] spin-reverse">
            <svg width="70" height="70" viewBox="0 0 120 120" fill="none">
                <path d="M60 0L67 53L120 60L67 67L60 120L53 67L0 60L53 53L60 0Z" fill="#4ade80" />
            </svg>
        </div>

        <!-- Floating geometric shapes -->
        <div class="absolute top-1/3 right-16 w-20 h-20 border border-kuning-400/20 rotate-45 float-slow opacity-40"></div>
        <div class="absolute bottom-1/3 left-24 w-14 h-14 border border-hijau-400/20 rotate-12 float-med opacity-30"></div>
        <div class="absolute top-3/4 right-1/3 w-3 h-3 bg-kuning-400/40 rounded-full float-med"></div>
        <div class="absolute top-1/4 left-1/3 w-2 h-2 bg-hijau-400/40 rounded-full float-slow"></div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col justify-between h-full p-12 xl:p-16">

            <!-- Logo top-left -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-kuning-400 to-kuning-600 rounded-xl flex items-center justify-center shadow-lg shadow-kuning-500/20">
                    <span class="font-arabic text-hijau-950 text-lg font-bold">ر</span>
                </div>
                <div>
                    <div class="font-display text-white font-bold text-sm leading-tight">Yayasan Ar-Razaq</div>
                    <div class="text-hijau-400/60 text-xs">Pesantren Modern Terpadu</div>
                </div>
            </div>

            <!-- Main headline -->
            <div class="max-w-lg">
                <!-- Arabic bismillah -->
                <div class="font-arabic text-kuning-400/70 text-3xl mb-8 block">بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيمِ</div>

                <h1 class="font-display text-white text-4xl xl:text-5xl font-bold leading-tight mb-5">
                    Kelola website<br>
                    <span style="background: linear-gradient(135deg, #facc15, #86efac); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">dengan mudah.</span>
                </h1>

                <p class="text-hijau-300/60 text-base leading-relaxed mb-10 max-w-sm">
                    Panel administrasi Yayasan Ar-Razaq. Kelola konten, berita, galeri, dan informasi PPDB dalam satu dasbor terpadu.
                </p>

                <!-- Feature list -->
                <ul class="space-y-3">
                    <?php
                    $features = [
                        ['icon' => 'M12 20h9', 'icon2' => 'M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z', 'text' => 'Manajemen konten & berita'],
                        ['icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14', 'icon2' => null, 'text' => 'Upload galeri & dokumentasi'],
                        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0', 'icon2' => null, 'text' => 'Pendaftaran santri baru (PPDB)'],
                    ];
                    foreach ($features as $f):
                    ?>
                        <li class="flex items-center gap-3 text-sm text-hijau-300/70">
                            <div class="w-5 h-5 rounded-full bg-hijau-800/50 border border-hijau-700/40 flex items-center justify-center flex-shrink-0">
                                <svg class="w-2.5 h-2.5 text-kuning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <?= $f['text'] ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Bottom copyright -->
            <div class="text-hijau-400/30 text-xs">
                &copy; <?= date('Y') ?> Yayasan Ar-Razaq &mdash; Hak Cipta Dilindungi
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- RIGHT PANEL — Login Form -->
    <!-- ============================================================ -->
    <div class="flex-1 flex items-center justify-center p-6 sm:p-10 bg-white relative">

        <!-- Subtle top-right decoration -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-hijau-50 rounded-full blur-[100px] opacity-60 -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-kuning-50 rounded-full blur-[80px] opacity-40 translate-y-1/2 -translate-x-1/2"></div>

        <div class="w-full max-w-md relative z-10">

            <!-- Mobile logo (shown only on mobile) -->
            <div class="lg:hidden flex items-center gap-3 mb-10 slide-up">
                <div class="w-10 h-10 bg-gradient-to-br from-hijau-800 to-hijau-600 rounded-xl flex items-center justify-center">
                    <span class="font-arabic text-white text-lg font-bold">ر</span>
                </div>
                <div class="font-display font-bold text-hijau-900 text-sm">Yayasan Ar-Razaq</div>
            </div>

            <!-- Heading -->
            <div class="mb-10 slide-up-delay-1">
                <p class="text-xs font-semibold text-hijau-600 tracking-[0.15em] uppercase mb-2">Panel Administrator</p>
                <h2 class="font-display text-3xl xl:text-4xl font-bold text-gray-900 mb-2">Masuk ke Admin</h2>
                <p class="text-gray-400 text-sm">Masukkan kredensial akun administrator Anda.</p>
            </div>

            <!-- Alert -->
            <div id="alert-msg" class="hidden mb-6 slide-up-delay-2"></div>

            <!-- Form -->
            <div class="space-y-5 slide-up-delay-2">

                <!-- Username -->
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-[0.1em] mb-2">Username</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <input
                            type="text" id="username" autocomplete="username"
                            placeholder="Masukkan username"
                            class="input-field w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-[0.1em] mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                        <input
                            type="password" id="password" autocomplete="current-password"
                            placeholder="Masukkan password"
                            class="input-field w-full pl-11 pr-12 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300">
                        <button type="button" id="togglePwd" class="absolute right-3.5 top-1/2 -translate-y-1/2 p-1 text-gray-300 hover:text-gray-500 transition-colors rounded-lg">
                            <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="slide-up-delay-3">
                    <button id="btnLogin" type="button" onclick="doLogin()"
                        class="btn-login w-full text-white py-4 rounded-xl font-semibold text-sm flex items-center justify-center gap-2.5 mt-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk Sekarang
                    </button>
                </div>
            </div>

            <!-- Default credential hint -->
            <p class="text-center text-xs text-gray-300 mt-8 slide-up-delay-4">
                &copy; <?= date('Y') ?> Yayasan Ar-Razaq &mdash; Sistem Manajemen Internal
            </p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const pwd = document.getElementById('password');
        document.getElementById('togglePwd').addEventListener('click', function() {
            const isHidden = pwd.type === 'password';
            pwd.type = isHidden ? 'text' : 'password';
            document.getElementById('eye-icon').innerHTML = isHidden ?
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>` :
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        });

        // Enter key on password
        pwd.addEventListener('keydown', e => {
            if (e.key === 'Enter') doLogin();
        });
        document.getElementById('username').addEventListener('keydown', e => {
            if (e.key === 'Enter') document.getElementById('password').focus();
        });

        // Alert helper
        function showAlert(msg, success) {
            const el = document.getElementById('alert-msg');
            el.className = `mb-6 px-4 py-3.5 rounded-xl text-sm font-medium flex items-start gap-3 ${
                success
                    ? 'bg-green-50 text-green-700 border border-green-200'
                    : 'bg-red-50 text-red-600 border border-red-200 shake'
            }`;
            el.innerHTML = `
                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${
                        success
                            ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
                            : 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
                    }"/>
                </svg>
                <span>${msg}</span>
            `;
            el.classList.remove('hidden');

            // Re-trigger shake animation for errors
            if (!success) {
                void el.offsetWidth; // reflow
                el.classList.add('shake');
            }
        }

        // ============================================================
        // LOGIN — posts to the standard CI login method
        // (Admin::login() handles POST data directly via $this->input->post())
        // The view also supports the do-login JSON endpoint if it exists.
        // ============================================================
        async function doLogin() {
            const btn = document.getElementById('btnLogin');
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;

            if (!username || !password) {
                showAlert('Username dan password wajib diisi.', false);
                return;
            }

            // Loading state
            btn.disabled = true;
            btn.innerHTML = `
                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                Memverifikasi...
            `;

            const fd = new FormData();
            fd.append('username', username);
            fd.append('password', password);

            try {
                // *** FIX: Posting to the correct 'login' endpoint (not 'do-login')
                // Admin::login() checks $this->input->post() and responds via redirect.
                // We use fetch so we can detect success by checking the final URL.
                const res = await fetch('<?= base_url('panel-admin/login') ?>', {
                    method: 'POST',
                    body: fd,
                    redirect: 'manual' // Catch redirect without following
                });

                // CI redirects to dashboard on success (302 to panel-admin/dashboard)
                // and redirects back to login on failure (302 to panel-admin/login)
                if (res.type === 'opaqueredirect' || res.status === 302 || res.status === 200) {
                    // Check Location header when redirect is manual
                    const location = res.headers.get('Location') || '';
                    if (location.includes('dashboard')) {
                        showAlert('Login berhasil! Mengalihkan ke dashboard…', true);
                        setTimeout(() => window.location.href = '<?= base_url('panel-admin/dashboard') ?>', 800);
                    } else if (res.type === 'opaqueredirect') {
                        // Can't read headers due to CORS — just navigate directly
                        // and let the server handle session check
                        showAlert('Memproses login…', true);
                        setTimeout(() => window.location.href = '<?= base_url('panel-admin/dashboard') ?>', 600);
                    } else {
                        // Redirect back to login = wrong credentials
                        showAlert('Username atau password salah!', false);
                        resetBtn();
                    }
                } else {
                    showAlert('Terjadi kesalahan. Silakan coba lagi.', false);
                    resetBtn();
                }
            } catch (e) {
                // Fallback: submit form normally (no-JS approach)
                // This handles the case where fetch is blocked by CORS in same-origin CI
                submitFormNormally(username, password);
            }
        }

        function resetBtn() {
            const btn = document.getElementById('btnLogin');
            btn.disabled = false;
            btn.innerHTML = `
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk Sekarang
            `;
        }

        // Graceful fallback: create a hidden real form and submit it
        // This guarantees compatibility with all CI session/redirect flows
        function submitFormNormally(username, password) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?= base_url('panel-admin/login') ?>';

            const u = document.createElement('input');
            u.type = 'hidden';
            u.name = 'username';
            u.value = username;
            form.appendChild(u);

            const p = document.createElement('input');
            p.type = 'hidden';
            p.name = 'password';
            p.value = password;
            form.appendChild(p);

            document.body.appendChild(form);
            form.submit();
        }

        // Check flashdata error on page load (CI sets it on failed login)
        // If the URL has ?err=1, it means we were redirected back after failed login
        window.addEventListener('DOMContentLoaded', () => {
            <?php if ($this->session->flashdata('error')): ?>
                showAlert('<?= $this->session->flashdata('error') ?>', false);
            <?php endif; ?>
        });
    </script>

</body>

</html>