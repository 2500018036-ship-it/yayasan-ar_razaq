<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' — ' : '' ?>Panel Admin Ar-Razaq</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        hijau: {
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
                        kuning: {
                            300: '#fde047',
                            400: '#facc15',
                            500: '#eab308',
                            600: '#ca8a04'
                        }
                    },
                    fontFamily: {
                        arabic: ['Scheherazade New', 'serif'],
                        display: ['Playfair Display', 'serif']
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&family=Scheherazade+New:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
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

        /* Sidebar */
        #sidebar {
            transition: width 0.3s cubic-bezier(0.16, 1, 0.3, 1),
                transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            background: linear-gradient(180deg, #1f4a43 0%, #1a3f39 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        #sidebar.collapsed {
            width: 64px;
        }

        #sidebar.collapsed .sidebar-text,
        #sidebar.collapsed .sidebar-subtitle {
            display: none;
        }

        #sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 10px;
        }

        #sidebar.collapsed .nav-link span {
            display: none;
        }

        #sidebar.collapsed .nav-submenu {
            display: none !important;
        }

        #sidebar.collapsed .nav-group-caret {
            display: none;
        }

        #sidebar.collapsed .sidebar-user-info {
            display: none;
        }

        #sidebar.collapsed .sidebar-logo-text {
            display: none;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 500;
            color: rgba(236, 253, 245, 0.82);
            transition: background 0.2s, color 0.2s;
            text-decoration: none;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #f8fafc;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.17);
            color: #fffbeb;
            font-weight: 600;
            box-shadow: inset 0 0 0 1px rgba(250, 204, 21, 0.24);
        }

        .nav-link svg {
            flex-shrink: 0;
        }

        .nav-group-toggle {
            width: 100%;
            justify-content: space-between;
        }

        .nav-group-main {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .nav-group-caret {
            width: 14px;
            height: 14px;
            opacity: 0.85;
            transition: transform 0.2s ease;
            flex-shrink: 0;
        }

        .nav-group-toggle.open .nav-group-caret {
            transform: rotate(90deg);
        }

        .nav-submenu {
            margin: 4px 0 8px 30px;
            padding-left: 12px;
            border-left: 1px solid rgba(255, 255, 255, 0.2);
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 0.24s ease, opacity 0.2s ease;
        }

        .nav-submenu.open {
            max-height: 180px;
            opacity: 1;
        }

        .nav-sublink {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 8px;
            color: rgba(236, 253, 245, 0.78);
            font-size: 0.78rem;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }

        .nav-sublink:hover {
            background: rgba(255, 255, 255, 0.11);
            color: #f8fafc;
        }

        .nav-sublink.active {
            background: rgba(255, 255, 255, 0.16);
            color: #fffbeb;
            font-weight: 600;
        }

        /* Main content area */
        #main-content {
            margin-left: 224px;
            min-height: 100vh;
            background: #f2f5f7;
            transition: margin-left 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body.sidebar-collapsed #main-content {
            margin-left: 64px;
        }

        @media(max-width:768px) {
            #main-content {
                margin-left: 0;
            }

            body.sidebar-collapsed #main-content {
                margin-left: 0;
            }
        }

        /* Toast */
        #toast-container {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            padding: 14px 18px;
            border-radius: 14px;
            font-size: 0.82rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            max-width: 320px;
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.12);
            animation: toast-in 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes toast-in {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes toast-out {
            to {
                opacity: 0;
                transform: translateY(10px) scale(0.95);
            }
        }

        .toast.success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .toast.error {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .toast.info {
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.35);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s;
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal-box {
            background: #fff;
            border-radius: 20px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 24px 56px rgba(15, 23, 42, 0.18);
            transform: translateY(20px) scale(0.97);
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .modal-overlay.open .modal-box {
            transform: translateY(0) scale(1);
        }

        /* Form elements */
        .form-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.875rem;
            color: #111827;
            background: #f9fafb;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
        }

        .form-input:focus {
            border-color: #166534;
            box-shadow: 0 0 0 3px rgba(22, 101, 52, 0.1);
            background: #fff;
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 14px;
            padding-right: 36px;
        }

        textarea.form-input {
            resize: vertical;
            min-height: 90px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary {
            background: #255f56;
            color: #fff;
        }

        .btn-primary:hover {
            background: #1f5149;
            box-shadow: 0 8px 18px rgba(37, 95, 86, 0.22);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .btn-danger:hover {
            background: #fee2e2;
        }

        .btn-ghost {
            background: transparent;
            color: #6b7280;
            border: 1px solid #e5e7eb;
        }

        .btn-ghost:hover {
            background: #f3f4f6;
        }

        /* Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            padding: 10px 16px;
            font-size: 0.72rem;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            border-bottom: 1px solid #f3f4f6;
            background: #fafafa;
        }

        .data-table td {
            padding: 14px 16px;
            font-size: 0.84rem;
            color: #374151;
            border-bottom: 1px solid #f9fafb;
            vertical-align: middle;
        }

        .data-table tr:hover td {
            background: #f8fbf9;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .badge-green {
            background: #dcfce7;
            color: #166534;
        }

        .badge-gray {
            background: #f3f4f6;
            color: #6b7280;
        }

        .badge-yellow {
            background: #fef9c3;
            color: #854d0e;
        }

        /* Stat card */
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 22px 24px;
            border: 1px solid #f3f4f6;
        }

        /* Upload preview */
        .upload-area {
            border: 2px dashed #d1fae5;
            border-radius: 12px;
            padding: 28px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }

        .upload-area:hover {
            border-color: #166534;
            background: #f0fdf4;
        }

        #current-image-preview img {
            max-height: 120px;
            border-radius: 10px;
            object-fit: cover;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #d1fae5;
            border-radius: 10px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 0.8s linear infinite;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- ============================================================ -->
    <!-- SIDEBAR -->
    <!-- ============================================================ -->
    <?php
    $current_uri = uri_string();
    /** @var Admin $CI_header */
    $CI_header   = get_instance();
    $admin_nama  = $CI_header->session->userdata('admin_nama') ?: 'Admin';
    $admin_role  = $CI_header->session->userdata('admin_role_name') ?: 'Tanpa Role';
    $admin_foto  = $CI_header->session->userdata('admin_foto');
    $admin_inisial = strtoupper(substr($admin_nama, 0, 1));
    $permission_codes = isset($permission_codes) && is_array($permission_codes)
        ? $permission_codes
        : ((array) $CI_header->session->userdata('admin_permissions'));
    $can = function ($perm) use ($permission_codes) {
        return in_array($perm, $permission_codes, true);
    };

    $nav_items = [
        ['uri' => 'panel-admin/dashboard',  'label' => 'Dashboard',       'icon' => 'grid', 'perm' => 'dashboard.view'],
        ['uri' => 'panel-admin/profil', 'label' => 'Profil Yayasan', 'icon' => 'settings', 'perm' => 'profil.view'],
        ['uri' => 'panel-admin/struktur',  'label' => 'Struktur',        'icon' => 'git-branch', 'perm' => 'struktur.view'],
        ['uri' => 'panel-admin/statistik',  'label' => 'Statistik',       'icon' => 'bar-chart-2', 'perm' => 'statistik.view'],
        ['uri' => 'panel-admin/sejarah',    'label' => 'Sejarah',         'icon' => 'clock', 'perm' => 'sejarah.view'],
        ['uri' => 'panel-admin/visi-misi',  'label' => 'Visi & Misi',     'icon' => 'eye', 'perm' => 'visi_misi.view'],
        ['uri' => 'panel-admin/galeri',     'label' => 'Galeri',          'icon' => 'image', 'perm' => 'galeri.view'],
        ['uri' => 'panel-admin/ekskul',     'label' => 'Ekstrakurikuler', 'icon' => 'star', 'perm' => 'ekskul.view'],
        ['uri' => 'panel-admin/berita',     'label' => 'Berita',          'icon' => 'file-text', 'perm' => 'berita.view'],
        ['uri' => 'panel-admin/ppdb',       'label' => 'PPDB',            'icon' => 'user-plus', 'perm' => 'ppdb.view'],
        ['uri' => 'panel-admin/popup',      'label' => 'Popup',           'icon' => 'image', 'perm' => 'popup.view'],
        ['uri' => 'panel-admin/setting',    'label' => 'Setting',         'icon' => 'shield', 'perm' => 'setting.view'],
        ['uri' => 'panel-admin/akun',       'label' => 'Akun Saya',       'icon' => 'user', 'perm' => 'akun.view'],
    ];
    ?>

    <aside id="sidebar" class="fixed top-0 left-0 h-full w-56 bg-hijau-950 flex flex-col z-40 overflow-hidden">
        <!-- Pattern overlay -->
        <div class="absolute inset-0 opacity-[0.04]" style="background-image:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

        <div class="relative z-10 flex flex-col h-full">
            <!-- Logo -->
            <div class="px-4 py-5 border-b border-white/[0.06]">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 bg-kuning-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-kuning-500/20">
                        <img src="<?= base_url('assets/images/logo.webp') ?>" alt="Logo Ar-Razaq" class="w-5 h-5 object-contain">
                    </div>
                    <div class="sidebar-logo-text">
                        <div class="font-display text-white font-bold text-sm leading-tight">Ar-Razaq</div>
                        <div class="text-hijau-400/50 text-[10px]">Panel Admin</div>
                    </div>
                </div>
            </div>

            <!-- Nav -->
            <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
                <?php foreach ($nav_items as $item):
                    if (isset($item['type']) && $item['type'] === 'group'):
                        $children = [];
                        if (!empty($item['children']) && is_array($item['children'])) {
                            foreach ($item['children'] as $child_item) {
                                if (isset($child_item['perm']) && !$can($child_item['perm'])) continue;
                                $children[] = $child_item;
                            }
                        }
                        if (empty($children)) continue;

                        $is_group_active = false;
                        foreach ($children as $child_item) {
                            if (strpos($current_uri, $child_item['uri']) === 0) {
                                $is_group_active = true;
                                break;
                            }
                        }
                        $submenu_id = 'submenu-' . md5($item['label']);
                ?>
                        <button type="button"
                            class="nav-link nav-group-toggle <?= $is_group_active ? 'active open' : '' ?>"
                            data-nav-group-toggle="1"
                            data-submenu-id="<?= $submenu_id ?>"
                            data-first-uri="<?= base_url($children[0]['uri']) ?>"
                            title="<?= $item['label'] ?>">
                            <span class="nav-group-main">
                                <i data-feather="<?= $item['icon'] ?>" class="w-4 h-4"></i>
                                <span><?= $item['label'] ?></span>
                            </span>
                            <i data-feather="chevron-right" class="nav-group-caret"></i>
                        </button>
                        <div id="<?= $submenu_id ?>" class="nav-submenu <?= $is_group_active ? 'open' : '' ?>">
                            <?php foreach ($children as $child_item):
                                $is_child_active = strpos($current_uri, $child_item['uri']) === 0;
                            ?>
                                <a href="<?= base_url($child_item['uri']) ?>" class="nav-sublink <?= $is_child_active ? 'active' : '' ?>" title="<?= $child_item['label'] ?>">
                                    <i data-feather="<?= $child_item['icon'] ?>" class="w-3.5 h-3.5"></i>
                                    <span><?= $child_item['label'] ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php
                    else:
                        if (isset($item['perm']) && !$can($item['perm'])) continue;
                        $is_active = strpos($current_uri, $item['uri']) === 0;
                    ?>
                        <a href="<?= base_url($item['uri']) ?>" class="nav-link <?= $is_active ? 'active' : '' ?>" title="<?= $item['label'] ?>">
                            <i data-feather="<?= $item['icon'] ?>" class="w-4 h-4"></i>
                            <span><?= $item['label'] ?></span>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </nav>

            <!-- User + Logout -->
            <div class="px-3 pb-4 pt-2 border-t border-white/[0.06]">
                <div class="flex items-center gap-2.5 px-2 py-3 mb-1">
                    <?php if (!empty($admin_foto)): ?>
                        <img src="<?= base_url('assets/images/uploads/admin/' . $admin_foto) ?>?v=<?= time() ?>" alt="<?= htmlspecialchars($admin_nama, ENT_QUOTES, 'UTF-8') ?>" class="w-8 h-8 rounded-lg object-cover border border-kuning-500/40 flex-shrink-0">
                    <?php else: ?>
                        <div class="w-8 h-8 bg-kuning-500 rounded-lg flex items-center justify-center text-hijau-950 font-bold text-xs flex-shrink-0">
                            <?= $admin_inisial ?>
                        </div>
                    <?php endif; ?>
                    <div class="min-w-0 sidebar-user-info">
                        <div class="text-white text-xs font-semibold truncate"><?= $admin_nama ?></div>
                        <div class="text-hijau-400/40 text-[10px]"><?= $admin_role ?></div>
                    </div>
                </div>
                <a href="<?= base_url('panel-admin/logout') ?>" onclick="return confirmLogout(event)" class="nav-link w-full" style="color:rgba(248,113,113,0.7);" title="Keluar">
                    <i data-feather="log-out" class="w-4 h-4"></i>
                    <span>Keluar</span>
                </a>
            </div>
        </div>
    </aside>

    <!-- Mobile overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden" onclick="closeSidebar()"></div>

    <!-- ============================================================ -->
    <!-- MAIN CONTENT WRAPPER -->
    <!-- ============================================================ -->
    <div id="main-content">

        <!-- Top bar -->
        <header class="sticky top-0 z-20 bg-white/92 backdrop-blur-xl border-b border-gray-200/80 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <!-- Sidebar toggle (all screens) -->
                <button onclick="toggleSidebar()" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors" title="Toggle Sidebar">
                    <i data-feather="menu" class="w-5 h-5"></i>
                </button>
                <div>
                    <h1 class="font-semibold text-gray-900 text-base leading-tight"><?= isset($title) ? $title : 'Dashboard' ?></h1>
                    <p class="text-xs text-gray-400">Panel Admin Yayasan Ar-Razaq</p>
                </div>
            </div>
            <a href="<?= base_url() ?>" target="_blank" class="flex items-center gap-1.5 text-xs text-hijau-700 font-semibold hover:text-hijau-900 transition-colors">
                <i data-feather="external-link" class="w-3.5 h-3.5"></i>
                Lihat Website
            </a>
        </header>

        <!-- Page content starts here -->
        <main class="p-6">
