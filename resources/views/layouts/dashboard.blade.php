<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PT Akses Legal Indonesia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom variables */
        :root {
            --sidebar-width: 16rem;
            --sidebar-collapsed-width: 4rem;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #3b82f6;
            --sidebar-text: #e2e8f0;
            --sidebar-text-muted: #94a3b8;
            --sidebar-border: #334155;
            --primary-color: #3b82f6;
            --primary-dark: #2563eb;
            --transition-speed: 0.3s;
            --sidebar-transition: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Custom Scrollbar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Main container */
        .app-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar base styles */
        #sidebar {
            width: var(--sidebar-width);
            min-width: var(--sidebar-collapsed-width);
            max-width: 24rem;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            transition: width var(--transition-speed) var(--sidebar-transition);
            position: relative;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        /* Resizable handle */
        .resize-handle {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: transparent;
            cursor: col-resize;
            z-index: 100;
            transition: background-color 0.2s;
        }

        .resize-handle:hover {
            background-color: var(--primary-color);
            width: 6px;
        }

        .resize-handle.dragging {
            background-color: var(--primary-color);
            width: 6px;
        }

        /* Sidebar collapsed state */
        .sidebar-collapsed {
            width: var(--sidebar-collapsed-width) !important;
        }

        .sidebar-collapsed .sidebar-text {
            display: none;
        }

        .sidebar-collapsed .sidebar-arrow {
            display: none;
        }

        .sidebar-collapsed .sidebar-section {
            display: none;
        }

        .sidebar-collapsed .profile-section {
            justify-content: center;
            padding: 1rem 0.5rem;
        }

        .sidebar-collapsed .profile-section .flex-1 {
            display: none;
        }

        .sidebar-collapsed .sidebar-submenu {
            position: absolute;
            left: 100%;
            top: 0;
            min-width: 200px;
            background: var(--sidebar-bg);
            border-radius: 0.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            padding: 0.5rem;
            z-index: 50;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s var(--sidebar-transition);
            pointer-events: none;
            margin-left: 0 !important;
            border: 1px solid var(--sidebar-border);
        }

        .sidebar-collapsed .sidebar-item:hover .sidebar-submenu {
            opacity: 1;
            transform: translateX(0);
            pointer-events: all;
        }

        /* Profile section */
        .profile-section {
            padding: 1.25rem;
            border-bottom: 1px solid var(--sidebar-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
            position: relative;
            overflow: hidden;
        }

        .profile-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color) 0%, transparent 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s var(--sidebar-transition);
        }

        .profile-section:hover::after {
            transform: scaleX(1);
        }

        .profile-info {
            display: flex;
            align-items: center;
            space-x: 3;
            overflow: hidden;
            flex: 1;
        }

        .profile-avatar {
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            flex-shrink: 0;
            transition: all 0.3s var(--sidebar-transition);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .profile-avatar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.3) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .profile-avatar:hover::before {
            transform: translateX(100%);
        }

        .profile-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(59, 130, 246, 0.3);
        }

        .profile-details {
            margin-left: 0.75rem;
            flex: 1;
            min-width: 0;
        }

        .profile-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--sidebar-text);
            margin-bottom: 0.125rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .profile-role {
            font-size: 0.75rem;
            color: var(--sidebar-text-muted);
        }

        .toggle-button {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: var(--sidebar-text);
            padding: 0.5rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }

        .toggle-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transform: scale(0);
            border-radius: 50%;
            transition: transform 0.3s;
        }

        .toggle-button:hover::before {
            transform: scale(1);
        }

        .toggle-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        .toggle-button svg {
            position: relative;
            z-index: 1;
            transition: transform 0.3s var(--sidebar-transition);
        }

        /* Navigation */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 1rem 0;
            position: relative;
        }

        /* Section headers */
        .sidebar-section-header {
            font-size: 0.625rem;
            font-weight: 700;
            color: var(--sidebar-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin: 0 1.25rem 0.5rem;
            padding: 0 0.5rem;
            position: relative;
            display: flex;
            align-items: center;
        }

        .sidebar-section-header::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, var(--sidebar-border) 0%, transparent 100%);
            margin-left: 0.5rem;
        }

        /* Menu items */
        .sidebar-item {
            position: relative;
            margin: 0.125rem 0.75rem;
            border-radius: 0.5rem;
            transition: all 0.2s var(--sidebar-transition);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.2s var(--sidebar-transition);
            position: relative;
            overflow: hidden;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--primary-color);
            transform: scaleY(0);
            transition: transform 0.2s var(--sidebar-transition);
            border-radius: 0 3px 3px 0;
        }

        .sidebar-link::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .sidebar-link:hover {
            background: var(--sidebar-hover);
            transform: translateX(2px);
        }

        .sidebar-link:hover::before {
            transform: scaleY(1);
        }

        .sidebar-link:hover::after {
            opacity: 1;
        }

        .sidebar-link.active {
            background: var(--sidebar-active);
            color: white;
        }

        .sidebar-link.active::before {
            transform: scaleY(1);
        }

        /* Icons */
        .sidebar-icon {
            width: 1.25rem;
            height: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.2s;
            position: relative;
            z-index: 1;
        }

        .sidebar-link:hover .sidebar-icon {
            transform: scale(1.1);
            color: white;
        }

        .sidebar-link.active .sidebar-icon {
            color: white;
        }

        /* Menu text */
        .sidebar-text {
            margin-left: 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            flex: 1;
            position: relative;
            z-index: 1;
        }

        /* Dropdown arrow */
        .sidebar-arrow {
            width: 1rem;
            height: 1rem;
            transition: transform 0.3s var(--sidebar-transition);
            color: var(--sidebar-text-muted);
            position: relative;
            z-index: 1;
        }

        .sidebar-arrow.rotate-180 {
            transform: rotate(180deg);
        }

        /* Badge */
        .sidebar-badge {
            background: var(--primary-color);
            color: white;
            font-size: 0.625rem;
            font-weight: 600;
            padding: 0.125rem 0.375rem;
            border-radius: 9999px;
            margin-left: auto;
            animation: pulse 2s infinite;
            position: relative;
            z-index: 1;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        /* Submenu */
        .sidebar-submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s var(--sidebar-transition),
                opacity 0.3s var(--sidebar-transition),
                transform 0.3s var(--sidebar-transition);
            opacity: 0;
            transform: translateY(-10px);
            margin-left: 1rem;
            margin-right: 0.5rem;
        }

        .sidebar-submenu.show {
            max-height: 500px;
            opacity: 1;
            transform: translateY(0);
        }

        .sidebar-submenu .sidebar-link {
            padding: 0.5rem 0.75rem;
            font-size: 0.8125rem;
            margin: 0.125rem 0;
        }

        .sidebar-submenu .sidebar-link::before {
            width: 2px;
        }

        /* Tooltip */
        .sidebar-tooltip {
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 0.5rem;
            background: rgba(0, 0, 0, 0.9);
            color: white;
            font-size: 0.75rem;
            padding: 0.375rem 0.625rem;
            border-radius: 0.375rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s;
            z-index: 100;
            pointer-events: none;
        }

        .sidebar-tooltip::before {
            content: '';
            position: absolute;
            right: 100%;
            top: 50%;
            transform: translateY(-50%);
            border: 4px solid transparent;
            border-right-color: rgba(0, 0, 0, 0.9);
        }

        .sidebar-collapsed .sidebar-item:hover .sidebar-tooltip {
            opacity: 1;
            visibility: visible;
        }

        /* Logout section */
        .logout-section {
            border-top: 1px solid var(--sidebar-border);
            padding: 1rem 0.75rem;
            margin-top: auto;
            position: relative;
        }

        .logout-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, var(--sidebar-border) 50%, transparent 100%);
        }

        .logout-button {
            width: 100%;
            display: flex;
            align-items: center;
            padding: 0.75rem;
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.875rem;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .logout-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(239, 68, 68, 0.2), transparent);
            transition: left 0.5s;
        }

        .logout-button:hover::before {
            left: 100%;
        }

        .logout-button:hover {
            background: rgba(239, 68, 68, 0.2);
            transform: translateX(2px);
        }

        .logout-button .sidebar-icon {
            color: #ef4444;
        }

        /* Mobile styles */
        @media (max-width: 767px) {
            #sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.3s var(--sidebar-transition);
                width: 16rem;
                box-shadow: 4px 0 10px rgba(0, 0, 0, 0.2);
            }

            #sidebar.mobile-open {
                transform: translateX(0);
            }

            .resize-handle {
                display: none;
            }

            .sidebar-mobile-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s, visibility 0.3s;
            }

            .sidebar-mobile-overlay.show {
                opacity: 1;
                visibility: visible;
            }
        }

        @media (min-width: 768px) {
            .sidebar-mobile-overlay {
                display: none !important;
            }

            #menuToggle {
                display: none !important;
            }
        }

        /* Main content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: #f8fafc;
            transition: margin-left var(--transition-speed) var(--sidebar-transition);
        }

        /* Top bar */
        .top-bar {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: between;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 5;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            space-x: 4;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-left: 1rem;
        }

        .menu-toggle {
            background: none;
            border: none;
            color: #64748b;
            padding: 0.5rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .menu-toggle:hover {
            background: #f1f5f9;
            color: #334155;
        }

        .notification-button {
            background: none;
            border: none;
            color: #64748b;
            padding: 0.5rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .notification-button:hover {
            background: #f1f5f9;
            color: #334155;
        }

        .notification-dot {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            width: 0.5rem;
            height: 0.5rem;
            background: #ef4444;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .user-avatar {
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .user-avatar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.3) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .user-avatar:hover::before {
            transform: translateX(100%);
        }

        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        /* Content area */
        .content-area {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
        }

        /* Animations */
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }

        /* Enhanced animations for sidebar items */
        .sidebar-item {
            position: relative;
            overflow: hidden;
        }

        .sidebar-item::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.1) 50%, transparent 100%);
            transform: translateY(-50%) scaleX(0);
            transform-origin: left;
            transition: transform 0.3s var(--sidebar-transition);
        }

        .sidebar-item:hover::after {
            transform: translateY(-50%) scaleX(1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="app-container">
        <!-- Mobile Sidebar Overlay -->
        <div id="sidebarOverlay" class="sidebar-mobile-overlay"></div>

        <!-- Sidebar -->
        <aside id="sidebar">
            <!-- Resize Handle -->
            <div class="resize-handle" id="resizeHandle"></div>

            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-info">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(Auth::user()?->name ?? '', 0, 1)) }}
                    </div>
                    <div class="profile-details sidebar-text">
                        <div class="profile-name">{{ Auth::user()?->name ?? 'Guest' }}</div>
                        <div class="profile-role">Client</div>
                    </div>
                </div>
                <button id="sidebarToggle" class="toggle-button">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav sidebar-scroll">
                <!-- MAIN Section -->
                <div class="mb-4">
                    <div class="sidebar-section-header sidebar-text">MAIN</div>
                    <div class="sidebar-item">
                        <a href="{{ route('user.dashboard') }}"
                            class="sidebar-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                            <div class="sidebar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <span class="sidebar-text">Dashboard</span>
                            <span class="sidebar-tooltip">Dashboard</span>
                        </a>
                    </div>
                </div>

                <!-- LAYANAN Section -->
                <div class="mb-4">
                    <div class="sidebar-section-header sidebar-text">LAYANAN</div>

                    <!-- Pendirian -->
                    <div class="sidebar-item">
                        <button onclick="toggleDropdown('Pendirian')" class="sidebar-link w-full text-left">
                            <div class="sidebar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="sidebar-text">Pendirian</span>
                            <svg id="Pendirian-icon" class="sidebar-arrow" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            <span class="sidebar-tooltip">Pendirian</span>
                        </button>
                        <div id="Pendirian-menu" class="sidebar-submenu">
                            <a href="{{ route('pendirian.cv.index') }}" class="sidebar-link">• Pendirian CV</a>
                            <a href="{{ route('pendirian.pt.index') }}" class="sidebar-link">• Pendirian PT</a>
                            <a href="#" class="sidebar-link">• Pendirian PT PERORANGAN</a>
                            <a href="#" class="sidebar-link">• Pendirian PT PMA</a>
                            <a href="#" class="sidebar-link">• Pendirian Yayasan</a>
                            <a href="#" class="sidebar-link">• Pendirian Perkumpulan</a>
                        </div>
                    </div>

                    <!-- Perizinan -->
                    <div class="sidebar-item">
                        <button onclick="toggleDropdown('perizinan')" class="sidebar-link w-full text-left">
                            <div class="sidebar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <span class="sidebar-text">Perizinan</span>
                            <svg id="perizinan-icon" class="sidebar-arrow" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            <span class="sidebar-tooltip">Perizinan</span>
                        </button>
                        <div id="perizinan-menu" class="sidebar-submenu">
                            <a href="#" class="sidebar-link">• Pendaftaran Merek</a>
                            <a href="#" class="sidebar-link">• Pendaftaran Halal</a>
                            <a href="#" class="sidebar-link">• Pendaftaran PIRT</a>
                            <a href="#" class="sidebar-link">• SBU Konstruksi + KTA Asosiasi</a>
                            <a href="#" class="sidebar-link">• UJIAN TENAGA AHLI S1</a>
                            <a href="#" class="sidebar-link">• UJIAN TENAGA AHLI SMA</a>
                        </div>
                    </div>

                    <!-- Perpajakan -->
                    <div class="sidebar-item">
                        <button onclick="toggleDropdown('perpajakan')" class="sidebar-link w-full text-left">
                            <div class="sidebar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="sidebar-text">Perpajakan</span>
                            <svg id="perpajakan-icon" class="sidebar-arrow" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            <span class="sidebar-tooltip">Perpajakan</span>
                        </button>
                        <div id="perpajakan-menu" class="sidebar-submenu">
                            <a href="#" class="sidebar-link">• NPWP Badan</a>
                            <a href="#" class="sidebar-link">• NPWP Pribadi</a>
                            <a href="#" class="sidebar-link">• SPT Tahunan Badan</a>
                            <a href="#" class="sidebar-link">• SPT Tahunan Pribadi</a>
                            <a href="#" class="sidebar-link">• SPT Masa PPH</a>
                            <a href="#" class="sidebar-link">• SPT Masa PPN</a>
                            <a href="#" class="sidebar-link">• PKP</a>
                        </div>
                    </div>

                    <!-- Layanan Lainnya -->
                    <div class="sidebar-item">
                        <button onclick="toggleDropdown('layanan-lainnya')" class="sidebar-link w-full text-left">
                            <div class="sidebar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                </svg>
                            </div>
                            <span class="sidebar-text">Layanan Lainnya</span>
                            <svg id="layanan-lainnya-icon" class="sidebar-arrow" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            <span class="sidebar-tooltip">Layanan Lainnya</span>
                        </button>
                        <div id="layanan-lainnya-menu" class="sidebar-submenu">
                            <a href="#" class="sidebar-link">• Perjanjian Kerjasama</a>
                            <a href="#" class="sidebar-link">• Perjanjian Notaril</a>
                            <a href="#" class="sidebar-link">• Surat Kuasa</a>
                            <a href="#" class="sidebar-link">• Warmerking</a>
                        </div>
                    </div>
                </div>

                <!-- PENGAJUAN Section -->
                <div class="mb-4 sidebar-section">
                    <div class="sidebar-section-header sidebar-text">PENGAJUAN</div>

                    <div class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <div class="sidebar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="sidebar-text">Sedang Diproses</span>
                            <span class="sidebar-badge">0</span>
                            <span class="sidebar-tooltip">Sedang Diproses</span>
                        </a>
                    </div>

                    <div class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <div class="sidebar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span class="sidebar-text">Menunggu Bayar</span>
                            <span class="sidebar-badge">0</span>
                            <span class="sidebar-tooltip">Menunggu Bayar</span>
                        </a>
                    </div>

                    <div class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <div class="sidebar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="sidebar-text">Selesai</span>
                            <span class="sidebar-badge">0</span>
                            <span class="sidebar-tooltip">Selesai</span>
                        </a>
                    </div>

                    <div class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <div class="sidebar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <span class="sidebar-text">Riwayat Lengkap</span>
                            <span class="sidebar-tooltip">Riwayat Lengkap</span>
                        </a>
                    </div>
                </div>

                <!-- SETTINGS Section -->
                <div class="sidebar-section">
                    <div class="sidebar-section-header sidebar-text">SETTINGS</div>

                    <!-- Settings -->
                    <div class="sidebar-item">
                        <button onclick="toggleDropdown('settings')" class="sidebar-link w-full text-left">
                            <div class="sidebar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="sidebar-text">Settings</span>
                            <svg id="settings-icon" class="sidebar-arrow" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            <span class="sidebar-tooltip">Settings</span>
                        </button>
                        <div id="settings-menu" class="sidebar-submenu">
                            <a href="#" class="sidebar-link">• Profile Settings</a>
                            <a href="#" class="sidebar-link">• Account Settings</a>
                        </div>
                    </div>

                    <div class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <div class="sidebar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="sidebar-text">History</span>
                            <span class="sidebar-tooltip">History</span>
                        </a>
                    </div>

                    <div class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <div class="sidebar-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="sidebar-text">Help</span>
                            <span class="sidebar-tooltip">Help</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Logout Section -->
            <div class="logout-section">
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">
                        <div class="sidebar-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <span class="sidebar-text">Logout Account</span>
                        <span class="sidebar-tooltip">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <header class="top-bar">
                <div class="top-bar-left">
                    <button id="menuToggle" class="menu-toggle">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="top-bar-right">
                    <button class="notification-button">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="notification-dot"></span>
                    </button>
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()?->name ?? 'G', 0, 1)) }}
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="content-area">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded animate-fade-in">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded animate-fade-in">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const menuToggle = document.getElementById('menuToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const resizeHandle = document.getElementById('resizeHandle');
            const root = document.documentElement;

            let isResizing = false;
            let startX = 0;
            let startWidth = 0;

            // Check if we're on mobile
            const isMobile = window.innerWidth < 768;

            // Toggle sidebar collapse for desktop
            sidebarToggle.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                if (!isMobile) {
                    sidebar.classList.toggle('sidebar-collapsed');

                    // Rotate the toggle icon with smooth animation
                    if (sidebar.classList.contains('sidebar-collapsed')) {
                        sidebarToggle.querySelector('svg').style.transform = 'rotate(180deg)';
                    } else {
                        sidebarToggle.querySelector('svg').style.transform = 'rotate(0deg)';
                    }
                }
            });

            // Toggle mobile menu
            menuToggle.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                sidebar.classList.toggle('mobile-open');
                sidebarOverlay.classList.toggle('show');

                // Prevent body scroll when sidebar is open on mobile
                if (sidebar.classList.contains('mobile-open')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            });

            // Close mobile menu when clicking overlay
            sidebarOverlay.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                sidebar.classList.remove('mobile-open');
                sidebarOverlay.classList.remove('show');
                document.body.style.overflow = '';
            });

            // Resizable sidebar functionality
            resizeHandle.addEventListener('mousedown', function (e) {
                isResizing = true;
                startX = e.clientX;
                startWidth = sidebar.offsetWidth;
                resizeHandle.classList.add('dragging');
                document.body.style.cursor = 'col-resize';
                document.body.style.userSelect = 'none';
                e.preventDefault();
            });

            document.addEventListener('mousemove', function (e) {
                if (!isResizing) return;

                const width = startWidth + (e.clientX - startX);
                const minWidth = 64; // 4rem in pixels
                const maxWidth = 384; // 24rem in pixels

                if (width >= minWidth && width <= maxWidth) {
                    sidebar.style.width = width + 'px';
                    root.style.setProperty('--sidebar-width', width + 'px');

                    // Remove collapsed class if width is larger than collapsed width
                    if (width > minWidth) {
                        sidebar.classList.remove('sidebar-collapsed');
                    }
                }
            });

            document.addEventListener('mouseup', function () {
                if (isResizing) {
                    isResizing = false;
                    resizeHandle.classList.remove('dragging');
                    document.body.style.cursor = '';
                    document.body.style.userSelect = '';
                }
            });

            // Close mobile menu when window is resized to desktop size
            window.addEventListener('resize', function () {
                const nowMobile = window.innerWidth < 768;

                if (!nowMobile && sidebar.classList.contains('mobile-open')) {
                    sidebar.classList.remove('mobile-open');
                    sidebarOverlay.classList.remove('show');
                    document.body.style.overflow = '';
                }

                // Update mobile state
                if (nowMobile !== isMobile) {
                    location.reload(); // Simple reload to handle responsive state change
                }
            });

            // Prevent clicks inside sidebar from closing it on mobile
            sidebar.addEventListener('click', function (e) {
                e.stopPropagation();
            });

            // Handle dropdown clicks properly
            document.querySelectorAll('.sidebar-item button').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.stopPropagation();
                });
            });

            // Add ripple effect to buttons
            document.querySelectorAll('.sidebar-link, .toggle-button, .logout-button').forEach(button => {
                button.addEventListener('click', function (e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });

        // Enhanced toggle dropdown with smooth animations
        function toggleDropdown(id) {
            const menu = document.getElementById(id + '-menu');
            const icon = document.getElementById(id + '-icon');
            const button = icon.closest('button');

            // Close all other dropdowns with animation
            const dropdowns = ['Pendirian', 'perizinan', 'perpajakan', 'layanan-lainnya', 'settings'];
            dropdowns.forEach(dropdownId => {
                if (dropdownId !== id) {
                    const otherMenu = document.getElementById(dropdownId + '-menu');
                    const otherIcon = document.getElementById(dropdownId + '-icon');
                    const otherButton = otherIcon.closest('button');

                    otherMenu.classList.remove('show');
                    otherIcon.classList.remove('rotate-180');
                    otherButton.classList.remove('active');
                }
            });

            // Toggle current dropdown with animation
            const isOpen = menu.classList.contains('show');

            if (isOpen) {
                // Close dropdown
                menu.classList.remove('show');
                icon.classList.remove('rotate-180');
                button.classList.remove('active');
            } else {
                // Open dropdown
                menu.classList.add('show');
                icon.classList.add('rotate-180');
                button.classList.add('active');

                // Add subtle animation to button
                button.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    button.style.transform = 'scale(1)';
                }, 100);
            }
        }

        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add keyboard navigation support
        document.addEventListener('keydown', function (e) {
            // Press Escape to close dropdowns
            if (e.key === 'Escape') {
                const dropdowns = ['Pendirian', 'perizinan', 'perpajakan', 'layanan-lainnya', 'settings'];
                dropdowns.forEach(dropdownId => {
                    const menu = document.getElementById(dropdownId + '-menu');
                    const icon = document.getElementById(dropdownId + '-icon');
                    const button = icon.closest('button');

                    menu.classList.remove('show');
                    icon.classList.remove('rotate-180');
                    button.classList.remove('active');
                });

                // Close mobile sidebar if open
                const sidebar = document.getElementById('sidebar');
                const sidebarOverlay = document.getElementById('sidebarOverlay');
                if (sidebar.classList.contains('mobile-open')) {
                    sidebar.classList.remove('mobile-open');
                    sidebarOverlay.classList.remove('show');
                    document.body.style.overflow = '';
                }
            }
        });

        // Add CSS for ripple effect
        const style = document.createElement('style');
        style.textContent = `
        .ripple {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s ease-out;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .sidebar-link, .toggle-button, .logout-button {
            position: relative;
            overflow: hidden;
        }
    `;
        document.head.appendChild(style);
    </script>
</body>

</html>
