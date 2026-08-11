<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title', 'Dashboard') | {{ config('app.name', 'HR Management') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @include('partials.styles')

    <style>
        .app-shell { display: flex; min-height: 100vh; }

        /* ---------- Sidebar ---------- */
        .sidebar {
            width: 264px;
            flex-shrink: 0;
            background: linear-gradient(180deg, #0f172a 0%, #111827 100%);
            color: #cbd5e1;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 50;
            transition: transform .3s ease;
            border-right: 1px solid rgba(255, 255, 255, .04);
        }
        .sidebar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(600px 300px at 0% 0%, rgba(99, 102, 241, .18), transparent 60%);
            pointer-events: none;
        }
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: 1.5rem 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, .06);
            position: relative;
        }
        .sidebar-logo .logo-mark {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            box-shadow: 0 8px 20px rgba(99, 102, 241, .45);
            flex-shrink: 0;
        }
        .sidebar-logo .logo-mark svg { width: 22px; height: 22px; }
        .sidebar-logo .logo-text { line-height: 1.2; }
        .sidebar-logo .logo-text strong { display: block; color: #fff; font-size: 1rem; font-weight: 700; letter-spacing: .02em; }
        .sidebar-logo .logo-text span { font-size: .6875rem; color: #94a3b8; text-transform: uppercase; letter-spacing: .12em; }

        .sidebar-nav {
            flex: 1;
            padding: 1.25rem .875rem;
            overflow-y: auto;
            position: relative;
        }
        .sidebar-nav .nav-section {
            font-size: .6875rem;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: #64748b;
            font-weight: 600;
            padding: .5rem .875rem;
            margin-bottom: .25rem;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .6875rem .875rem;
            margin-bottom: .25rem;
            border-radius: 10px;
            color: #94a3b8;
            font-size: .875rem;
            font-weight: 500;
            transition: all .18s ease;
            position: relative;
        }
        .nav-link svg { width: 20px; height: 20px; flex-shrink: 0; }
        .nav-link:hover { color: #fff; background: rgba(255, 255, 255, .06); }
        .nav-link.active {
            color: #fff;
            background: var(--gradient);
            box-shadow: 0 8px 20px rgba(99, 102, 241, .35);
            font-weight: 600;
        }

        .sidebar-footer {
            padding: 1rem .875rem;
            border-top: 1px solid rgba(255, 255, 255, .06);
            position: relative;
        }
        .user-card {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .625rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, .05);
        }
        .user-card .user-meta { flex: 1; min-width: 0; }
        .user-card .user-meta strong { display: block; color: #fff; font-size: .8125rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-card .user-meta span { font-size: .6875rem; color: #94a3b8; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block; }

        /* ---------- Main column ---------- */
        .main-content {
            flex: 1;
            margin-left: 264px;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            position: sticky;
            top: 0;
            z-index: 40;
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: .875rem 1.75rem;
            background: rgba(255, 255, 255, .82);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
        }
        .topbar h1 { font-size: 1.125rem; font-weight: 700; margin: 0; flex: 1; }
        .hamburger {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fff;
            color: var(--text);
            cursor: pointer;
            align-items: center;
            justify-content: center;
            transition: background .15s ease;
        }
        .hamburger:hover { background: #f8fafc; }
        .hamburger svg { width: 20px; height: 20px; }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .375rem .5rem .375rem .375rem;
            border-radius: 12px;
            background: #fff;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: border-color .15s ease;
            font-family: inherit;
            color: var(--text);
        }
        .topbar-user:hover { border-color: var(--primary); }
        .topbar-user .user-meta { text-align: left; line-height: 1.2; }
        .topbar-user .user-meta strong { display: block; font-size: .8125rem; }
        .topbar-user .user-meta span { font-size: .6875rem; color: var(--muted); }

        .dropdown { position: relative; }
        .dropdown-menu {
            position: absolute;
            right: 0;
            top: calc(100% + .5rem);
            min-width: 200px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: .5rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(6px);
            transition: all .18s ease;
            z-index: 60;
        }
        .dropdown.open .dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-menu a, .dropdown-menu form {
            display: block;
            width: 100%;
        }
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: .625rem;
            width: 100%;
            padding: .5rem .75rem;
            border-radius: 8px;
            font-size: .8125rem;
            font-weight: 500;
            color: var(--text);
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
            font-family: inherit;
            transition: background .15s ease;
        }
        .dropdown-item:hover { background: #f8faff; color: var(--primary); }
        .dropdown-item.danger { color: var(--danger); }
        .dropdown-item.danger:hover { background: #fef2f2; color: var(--danger); }
        .dropdown-item svg { width: 16px; height: 16px; }
        .dropdown-divider { height: 1px; background: var(--border); margin: .375rem .25rem; }

        .content { padding: 1.75rem; flex: 1; }
        @media (max-width: 1024px) { .content { padding: 1.25rem; } }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .5);
            backdrop-filter: blur(2px);
            z-index: 45;
            opacity: 0;
            visibility: hidden;
            transition: opacity .25s ease;
        }

        /* ---------- Mobile responsive ---------- */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            body.sidebar-open .sidebar { transform: translateX(0); box-shadow: 0 0 60px rgba(0, 0, 0, .4); }
            body.sidebar-open .sidebar-overlay { opacity: 1; visibility: visible; }
            .main-content { margin-left: 0; }
            .hamburger { display: flex; }
            .topbar-user .user-meta { display: none; }
        }
    </style>
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <div class="logo-mark">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="logo-text">
                    <strong>{{ config('app.name', 'HR Suite') }}</strong>
                    <span>Management System</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">Main Menu</div>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6" /></svg>
                    Dashboard
                </a>
                <a href="{{ route('departments.index') }}" class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    Departments
                </a>
                <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Employees
                </a>

                <div class="nav-section" style="margin-top: 1rem;">Account</div>
                <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Profile
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="user-card">
                    <div class="avatar avatar-sm avatar-gradient">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <div class="user-meta">
                        <strong>{{ Auth::user()->name }}</strong>
                        <span>{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </div>
        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <div class="main-content">
            <header class="topbar">
                <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>

                <h1>@yield('page-title', 'Dashboard')</h1>

                <div class="dropdown" id="userDropdown">
                    <button class="topbar-user" type="button" id="userMenuBtn">
                        <div class="avatar avatar-sm avatar-gradient">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        <div class="user-meta">
                            <strong>{{ Auth::user()->name }}</strong>
                            <span>{{ Auth::user()->email }}</span>
                        </div>
                        <svg style="width:16px;height:16px;color:#94a3b8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                    </button>

                    <div class="dropdown-menu">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item danger">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        (function () {
            var sidebar = document.getElementById('sidebar');
            var hamburger = document.getElementById('hamburger');
            var overlay = document.getElementById('sidebarOverlay');

            function toggleSidebar() {
                document.body.classList.toggle('sidebar-open');
            }

            if (hamburger) {
                hamburger.addEventListener('click', toggleSidebar);
            }
            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }

            var dropdown = document.getElementById('userDropdown');
            var menuBtn = document.getElementById('userMenuBtn');

            if (menuBtn && dropdown) {
                menuBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('open');
                });
                document.addEventListener('click', function (e) {
                    if (!dropdown.contains(e.target)) {
                        dropdown.classList.remove('open');
                    }
                });
            }
        })();
    </script>

    @yield('scripts')
</body>
</html>
