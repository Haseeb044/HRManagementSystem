<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title', 'Welcome') | {{ config('app.name', 'HR Management') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @include('partials.styles')

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background: #0f172a;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: -180px;
            left: -120px;
            width: 480px;
            height: 480px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99, 102, 241, .35), transparent 70%);
            animation: floatBlob 9s ease-in-out infinite;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: -160px;
            right: -120px;
            width: 460px;
            height: 460px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(139, 92, 246, .3), transparent 70%);
            animation: floatBlob 11s ease-in-out infinite reverse;
        }
        @keyframes floatBlob {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, -30px); }
        }

        .guest-wrap {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 1;
            animation: fadeUp .5s ease both;
        }
        .guest-brand {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .guest-brand .logo-mark {
            width: 60px;
            height: 60px;
            margin: 0 auto .75rem;
            border-radius: 18px;
            background: var(--gradient);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 12px 30px rgba(99, 102, 241, .45);
        }
        .guest-brand .logo-mark svg { width: 30px; height: 30px; }
        .guest-brand h1 {
            color: #fff;
            font-size: 1.375rem;
            font-weight: 800;
            margin: 0;
        }
        .guest-brand p { color: #94a3b8; font-size: .8125rem; margin: .25rem 0 0; }

        .guest-card {
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 20px;
            padding: 2rem 1.75rem;
            backdrop-filter: blur(16px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, .35);
        }
        .guest-card .form-label { color: #e2e8f0; }
        .guest-card .form-control, .guest-card .form-select, .guest-card .form-textarea {
            background: rgba(255, 255, 255, .08);
            border-color: rgba(255, 255, 255, .14);
            color: #fff;
        }
        .guest-card .form-control::placeholder { color: #64748b; }
        .guest-card .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, .25);
            background: rgba(255, 255, 255, .1);
        }
        .guest-card .form-hint { color: #94a3b8; }
        .guest-card .input-error { color: #fca5a5; }

        .guest-check {
            display: flex;
            align-items: center;
            gap: .5rem;
            color: #cbd5e1;
            font-size: .8125rem;
            cursor: pointer;
        }
        .guest-check input {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
        }

        .guest-foot {
            text-align: center;
            margin-top: 1.25rem;
            color: #94a3b8;
            font-size: .8125rem;
        }
        .guest-foot a { color: var(--primary-light); font-weight: 600; }
        .guest-foot a:hover { color: #c7d2fe; }

        .guest-note {
            background: rgba(255, 255, 255, .05);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 12px;
            padding: .875rem 1rem;
            color: #cbd5e1;
            font-size: .8125rem;
            margin-bottom: 1.25rem;
        }
        .guest-note.success { color: #6ee7b7; border-color: rgba(16, 185, 129, .4); background: rgba(16, 185, 129, .08); }

        .btn-primary {
            box-shadow: 0 10px 24px rgba(99, 102, 241, .4);
        }
    </style>
</head>
<body>
    <div class="guest-wrap">
        <div class="guest-brand">
            <div class="logo-mark">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h1>{{ config('app.name', 'HR Suite') }}</h1>
            <p>Human Resource Management System</p>
        </div>

        <div class="guest-card">
            @yield('content')
        </div>
    </div>
</body>
</html>
