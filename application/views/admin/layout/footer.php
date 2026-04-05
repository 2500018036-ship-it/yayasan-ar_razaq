</main>
<!-- /Page content -->

</div>
<!-- /main-content -->

<!-- Toast container -->
<div id="toast-container"></div>

<script>
    feather.replace();

    // Sidebar mobile
    function toggleSidebar() {
        const s = document.getElementById('sidebar');
        const o = document.getElementById('sidebar-overlay');
        s.classList.toggle('-translate-x-full');
        o.classList.toggle('hidden');
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.add('hidden');
    }

    // On mobile, hide sidebar by default
    if (window.innerWidth < 768) {
        document.getElementById('sidebar').classList.add('-translate-x-full');
    }

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
            body: formData
        });
        return res.json();
    }

    // ============================================================
    // MODAL HELPERS
    // ============================================================
    function openModal(id) {
        const m = document.getElementById(id);
        if (m) {
            m.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(id) {
        const m = document.getElementById(id);
        if (m) {
            m.classList.remove('open');
            document.body.style.overflow = '';
        }
    }

    // Close modal on overlay click
    document.querySelectorAll('.modal-overlay').forEach(m => {
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