<style>
    :root {
        --primary: #6366f1;
        --primary-dark: #4f46e5;
        --primary-light: #a5b4fc;
        --accent: #8b5cf6;
        --success: #10b981;
        --danger: #ef4444;
        --warning: #f59e0b;
        --info: #0ea5e9;
        --sidebar-bg: #0f172a;
        --bg: #f1f5f9;
        --surface: #ffffff;
        --text: #1e293b;
        --muted: #64748b;
        --border: #e2e8f0;
        --radius: 16px;
        --radius-sm: 10px;
        --shadow-sm: 0 1px 3px rgba(15, 23, 42, .06);
        --shadow: 0 8px 30px rgba(15, 23, 42, .08);
        --shadow-lg: 0 20px 45px rgba(79, 70, 229, .18);
        --gradient: linear-gradient(135deg, #6366f1, #8b5cf6);
    }

    *, *::before, *::after { box-sizing: border-box; }

    body {
        margin: 0;
        font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
        background: var(--bg);
        color: var(--text);
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
    }

    h1, h2, h3, h4 { line-height: 1.25; margin: 0 0 .5rem; }
    a { color: var(--primary); text-decoration: none; }
    a:hover { color: var(--primary-dark); }
    p { margin: 0 0 1rem; }

    /* ---------- Buttons ---------- */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        font-family: inherit;
        font-size: .875rem;
        font-weight: 600;
        padding: .625rem 1.25rem;
        border: none;
        border-radius: var(--radius-sm);
        cursor: pointer;
        transition: all .2s ease;
        text-decoration: none;
        white-space: nowrap;
    }
    .btn-primary {
        background: var(--gradient);
        color: #fff;
        box-shadow: 0 6px 16px rgba(99, 102, 241, .35);
    }
    .btn-primary:hover { color: #fff; transform: translateY(-1px); box-shadow: 0 10px 22px rgba(99, 102, 241, .45); }
    .btn-secondary {
        background: #fff;
        color: var(--text);
        border: 1px solid var(--border);
    }
    .btn-secondary:hover { background: #f8fafc; color: var(--text); border-color: #cbd5e1; }
    .btn-danger {
        background: #fff;
        color: var(--danger);
        border: 1px solid #fecaca;
    }
    .btn-danger:hover { background: var(--danger); color: #fff; border-color: var(--danger); }
    .btn-sm { padding: .375rem .75rem; font-size: .8125rem; border-radius: 8px; }
    .btn-block { width: 100%; }
    .btn:disabled { opacity: .6; cursor: not-allowed; transform: none; }

    /* ---------- Cards ---------- */
    .card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }
    .card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .card-header h3 { margin: 0; font-size: 1.05rem; font-weight: 700; }
    .card-body { padding: 1.5rem; }

    /* ---------- Grids ---------- */
    .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
    .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
    .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    @media (max-width: 1024px) {
        .grid-4 { grid-template-columns: repeat(2, 1fr); }
        .grid-3 { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px) {
        .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
    }

    /* ---------- Stat cards ---------- */
    .stat-card {
        position: relative;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        gap: 1.25rem;
        transition: transform .2s ease, box-shadow .2s ease;
        overflow: hidden;
    }
    .stat-card::after {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(99, 102, 241, .12), transparent 70%);
        pointer-events: none;
    }
    .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow); }
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #fff;
    }
    .stat-icon svg { width: 26px; height: 26px; }
    .stat-icon.indigo { background: var(--gradient); box-shadow: 0 8px 18px rgba(99, 102, 241, .35); }
    .stat-icon.green { background: linear-gradient(135deg, #10b981, #34d399); box-shadow: 0 8px 18px rgba(16, 185, 129, .35); }
    .stat-icon.amber { background: linear-gradient(135deg, #f59e0b, #fbbf24); box-shadow: 0 8px 18px rgba(245, 158, 11, .35); }
    .stat-icon.rose { background: linear-gradient(135deg, #f43f5e, #fb7185); box-shadow: 0 8px 18px rgba(244, 63, 94, .35); }
    .stat-icon.sky { background: linear-gradient(135deg, #0ea5e9, #38bdf8); box-shadow: 0 8px 18px rgba(14, 165, 233, .35); }
    .stat-value { font-size: 1.75rem; font-weight: 800; line-height: 1.1; margin: 0; }
    .stat-label { font-size: .8125rem; color: var(--muted); font-weight: 500; margin: 0; }

    /* ---------- Tables ---------- */
    .table-wrap { overflow-x: auto; }
    .table { width: 100%; border-collapse: collapse; font-size: .875rem; }
    .table thead th {
        text-align: left;
        padding: .875rem 1.25rem;
        font-size: .6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: var(--muted);
        background: #f8fafc;
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }
    .table tbody td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    .table tbody tr { transition: background .15s ease; }
    .table tbody tr:hover { background: #f8faff; }
    .table tbody tr:last-child td { border-bottom: none; }

    /* ---------- Badges ---------- */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: .375rem;
        padding: .25rem .75rem;
        border-radius: 9999px;
        font-size: .75rem;
        font-weight: 600;
        line-height: 1.4;
    }
    .badge-success { background: #d1fae5; color: #065f46; }
    .badge-danger { background: #fee2e2; color: #991b1b; }
    .badge-primary { background: #e0e7ff; color: #3730a3; }
    .badge-warning { background: #fef3c7; color: #92400e; }
    .badge-info { background: #e0f2fe; color: #075985; }
    .badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

    /* ---------- Avatars ---------- */
    .avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #fff;
    }
    .avatar-sm { width: 34px; height: 34px; font-size: .75rem; }
    .avatar-lg { width: 120px; height: 120px; font-size: 2.25rem; }
    .avatar-gradient { background: var(--gradient); }
    .avatar-green { background: linear-gradient(135deg, #10b981, #34d399); }
    .avatar-amber { background: linear-gradient(135deg, #f59e0b, #fbbf24); }
    .avatar-rose { background: linear-gradient(135deg, #f43f5e, #fb7185); }
    .avatar-sky { background: linear-gradient(135deg, #0ea5e9, #38bdf8); }

    /* ---------- Forms ---------- */
    .form-group { margin-bottom: 1.25rem; }
    .form-label {
        display: block;
        margin-bottom: .375rem;
        font-size: .8125rem;
        font-weight: 600;
        color: #334155;
    }
    .form-control, .form-select, .form-textarea {
        width: 100%;
        font-family: inherit;
        font-size: .875rem;
        padding: .625rem .875rem;
        color: var(--text);
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: var(--radius-sm);
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .form-control:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .15);
    }
    .form-textarea { resize: vertical; min-height: 110px; }
    .form-hint { font-size: .75rem; color: var(--muted); margin-top: .375rem; }
    .input-error { font-size: .75rem; color: var(--danger); margin-top: .375rem; font-weight: 500; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    @media (max-width: 640px) { .form-row { grid-template-columns: 1fr; } }

    .file-drop {
        position: relative;
        border: 2px dashed #cbd5e1;
        border-radius: var(--radius-sm);
        padding: 2rem 1.25rem;
        text-align: center;
        cursor: pointer;
        transition: border-color .2s ease, background .2s ease;
        background: #f8fafc;
    }
    .file-drop:hover, .file-drop.dragover { border-color: var(--primary); background: #eef2ff; }
    .file-drop input { position: absolute; inset: 0; opacity: 0; cursor: pointer; }
    .file-drop .drop-icon {
        width: 44px;
        height: 44px;
        margin: 0 auto .5rem;
        border-radius: 12px;
        background: #e0e7ff;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .file-drop .drop-title { font-size: .875rem; font-weight: 600; color: var(--text); margin: 0; }
    .file-drop .drop-sub { font-size: .75rem; color: var(--muted); margin: 0; }

    /* ---------- Flash messages ---------- */
    .flash {
        padding: .875rem 1.25rem;
        border-radius: var(--radius-sm);
        font-size: .875rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: .625rem;
        margin-bottom: 1.5rem;
        animation: fadeDown .4s ease;
    }
    .flash-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
    .flash-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    .flash-info { background: #e0e7ff; color: #3730a3; border: 1px solid #c7d2fe; }

    /* ---------- Page heading ---------- */
    .page-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.75rem;
    }
    .page-title { font-size: 1.5rem; font-weight: 800; margin: 0; }
    .page-subtitle { color: var(--muted); font-size: .875rem; margin: .25rem 0 0; }
    .page-actions { display: flex; align-items: center; gap: .625rem; }

    /* ---------- Utilities ---------- */
    .gradient-text {
        background: var(--gradient);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .text-muted { color: var(--muted); }
    .text-right { text-align: right; }
    .text-center { text-align: center; }
    .flex-between { display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; }
    .flex-center { display: flex; align-items: center; gap: .625rem; }
    .mt-1 { margin-top: .25rem; }
    .mt-2 { margin-top: .5rem; }
    .mt-3 { margin-top: .75rem; }
    .mt-4 { margin-top: 1rem; }
    .mt-6 { margin-top: 1.5rem; }
    .mb-0 { margin-bottom: 0; }
    .mb-4 { margin-bottom: 1rem; }
    .mb-6 { margin-bottom: 1.5rem; }
    .w-full { width: 100%; }

    .link-danger { color: var(--danger); font-weight: 600; }
    .link-danger:hover { color: #b91c1c; }
    .link-primary { color: var(--primary); font-weight: 600; }
    .link-primary:hover { color: var(--primary-dark); }

    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        color: var(--muted);
    }
    .empty-state svg { width: 48px; height: 48px; margin-bottom: .75rem; color: #cbd5e1; }
    .empty-state p { margin: 0; }

    .divider {
        height: 1px;
        background: var(--border);
        margin: 1.5rem 0;
    }

    /* ---------- Animations ---------- */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-in { animation: fadeUp .45s ease both; }
    .fade-in-1 { animation: fadeUp .45s ease .08s both; }
    .fade-in-2 { animation: fadeUp .45s ease .16s both; }
    .fade-in-3 { animation: fadeUp .45s ease .24s both; }

    /* ---------- Pagination ---------- */
    .pagination { display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; margin-top: 1.5rem; }
    .pagination-info { font-size: .8125rem; color: var(--muted); }
    .pagination-links { display: flex; align-items: center; gap: .25rem; }
    .pagination-links a, .pagination-links span {
        min-width: 36px;
        height: 36px;
        padding: 0 .5rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: .8125rem;
        font-weight: 600;
        color: var(--muted);
        background: #fff;
        border: 1px solid var(--border);
        transition: all .15s ease;
    }
    .pagination-links a:hover { color: var(--primary); border-color: var(--primary); }
    .pagination-links .active, .pagination-links .active:hover {
        background: var(--gradient);
        color: #fff;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(99, 102, 241, .35);
    }
    .pagination-links .disabled {
        opacity: .45;
        cursor: not-allowed;
        pointer-events: none;
    }
    .pagination-links .dots { border: none; background: transparent; }
</style>
