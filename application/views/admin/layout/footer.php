</main>
<!-- /Page content -->

</div>
<!-- /main-content -->

<!-- Toast container -->
<div id="toast-container"></div>

<script>
    feather.replace();
    window.ADMIN_PERMS = <?= json_encode(isset($permission_codes) && is_array($permission_codes) ? $permission_codes : []) ?>;
    window.adminCan = function(code) {
        return Array.isArray(window.ADMIN_PERMS) && window.ADMIN_PERMS.includes(code);
    };

    // Sidebar toggle — desktop: collapse, mobile: slide
    function toggleSidebar() {
        const s = document.getElementById('sidebar');
        const o = document.getElementById('sidebar-overlay');
        if (window.innerWidth >= 768) {
            // Desktop: collapse/expand
            s.classList.toggle('collapsed');
            document.body.classList.toggle('sidebar-collapsed');
            localStorage.setItem('sidebar_collapsed', s.classList.contains('collapsed') ? '1' : '0');
        } else {
            // Mobile: slide in/out
            s.classList.toggle('-translate-x-full');
            o.classList.toggle('hidden');
        }
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.add('hidden');
    }

    // On load: restore sidebar state
    (function() {
        const s = document.getElementById('sidebar');
        if (window.innerWidth < 768) {
            s.classList.add('-translate-x-full');
        } else {
            if (localStorage.getItem('sidebar_collapsed') === '1') {
                s.classList.add('collapsed');
                document.body.classList.add('sidebar-collapsed');
            }
        }
    })();

    // Sidebar group menu (Profil Yayasan -> child menus)
    (function() {
        const toggles = document.querySelectorAll('[data-nav-group-toggle="1"]');
        if (!toggles.length) return;

        const closeOtherGroups = (exceptId) => {
            toggles.forEach((btn) => {
                const id = btn.getAttribute('data-submenu-id');
                if (!id || id === exceptId) return;
                const submenu = document.getElementById(id);
                btn.classList.remove('open');
                if (submenu) submenu.classList.remove('open');
            });
        };

        toggles.forEach((btn) => {
            btn.addEventListener('click', () => {
                const sidebar = document.getElementById('sidebar');
                if (sidebar && sidebar.classList.contains('collapsed') && window.innerWidth >= 768) {
                    const firstUri = btn.getAttribute('data-first-uri');
                    if (firstUri) window.location.href = firstUri;
                    return;
                }

                const id = btn.getAttribute('data-submenu-id');
                if (!id) return;
                const submenu = document.getElementById(id);
                if (!submenu) return;

                const nextOpen = !submenu.classList.contains('open');
                closeOtherGroups(id);
                submenu.classList.toggle('open', nextOpen);
                btn.classList.toggle('open', nextOpen);
            });
        });
    })();

    // ============================================================
    // TOAST SYSTEM
    // ============================================================
    function showToast(msg, type = 'success', duration = 3500) {
        const c = document.getElementById('toast-container');
        const icons = {
            success: 'check-circle',
            error: 'x-circle',
            info: 'info'
        };
        const t = document.createElement('div');
        t.className = `toast ${type}`;
        t.innerHTML = `
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success'
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                    : type === 'error'
                        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                        : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                }
            </svg>
            <span>${msg}</span>`;
        c.appendChild(t);
        setTimeout(() => {
            t.style.animation = 'toast-out 0.3s ease forwards';
            setTimeout(() => t.remove(), 300);
        }, duration);
    }

    // ============================================================
    // UNIVERSAL AJAX HELPER
    // ============================================================
    async function ajaxPost(url, formData) {
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        });
        const text = await res.text();
        try {
            return JSON.parse(text);
        } catch (e) {
            // Server mengembalikan respons bukan JSON (misalnya error PHP)
            console.error('Non-JSON response:', text.substring(0, 500));
            throw new Error('Server mengembalikan respons tidak valid. Periksa log server.');
        }
    }

    async function ajaxSubmit(url, formData, onSuccess) {
        try {
            const d = await ajaxPost(url, formData);
            if (d && d.data && d.data.redirect && d.status === 'error') {
                showToast(d.message || 'Sesi berakhir, mengarahkan ke login.', 'error');
                setTimeout(() => {
                    window.location.href = d.data.redirect;
                }, 900);
                return;
            }
            showToast(d.message, d.status === 'success' ? 'success' : 'error');
            if (d.status === 'success' && typeof onSuccess === 'function') {
                onSuccess(d);
            }
        } catch (e) {
            showToast(e.message || 'Terjadi kesalahan pada server.', 'error');
        }
    }

    // ============================================================
    // MODAL HELPERS
    // ============================================================
    function openModal(id) {
        const m = document.getElementById(id);
        if (m) {
            if (m.classList.contains('hidden')) {
                m.classList.remove('hidden');
            }
            m.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(id) {
        const m = document.getElementById(id);
        if (m) {
            m.classList.remove('open');
            if (m.hasAttribute('data-modal')) {
                m.classList.add('hidden');
            }
            document.body.style.overflow = '';
        }
    }

    // Close modal on overlay click
    document.querySelectorAll('.modal-overlay, [data-modal]').forEach(m => {
        m.addEventListener('click', e => {
            if (e.target === m) closeModal(m.id);
        });
    });

    // ============================================================
    // IMAGE PREVIEW HELPER
    // ============================================================
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (!preview) return;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.innerHTML = `<img src="${e.target.result}" class="max-h-28 rounded-xl object-cover mx-auto">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // ============================================================
    // DELETE CONFIRM
    // ============================================================
    function confirmDelete(url, label) {
        if (confirm(`Hapus "${label}"? Tindakan ini tidak dapat dibatalkan.`)) {
            fetch(url, {
                    method: 'POST'
                })
                .then(r => r.json())
                .then(d => {
                    showToast(d.message, d.status === 'success' ? 'success' : 'error');
                    if (d.status === 'success') setTimeout(() => location.reload(), 900);
                })
                .catch(() => showToast('Terjadi kesalahan.', 'error'));
        }
    }

    function showConfirm(message, onConfirm) {
        if (!confirm(message)) return;
        if (typeof onConfirm === 'function') onConfirm();
    }

    function confirmLogout(event) {
        const ok = confirm('Yakin ingin keluar dari dashboard admin?');
        if (!ok && event) event.preventDefault();
        return ok;
    }

    // ============================================================
    // STATUS TOGGLE
    // ============================================================
    function toggleStatus(url, btn) {
        fetch(url, {
                method: 'POST'
            })
            .then(r => r.json())
            .then(d => {
                showToast(d.message, 'success');
                setTimeout(() => location.reload(), 700);
            })
            .catch(() => showToast('Gagal mengubah status.', 'error'));
    }
</script>
</body>

</html>
