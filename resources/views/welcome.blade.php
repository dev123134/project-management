<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Console') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:500,600,700|ibm-plex-mono:400,500|inter:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        :root {
            --bp-bg: #0A1F33;
            --bp-bg-2: #0D2B47;
            --bp-panel: #0F2E4C;
            --bp-line: rgba(143, 196, 255, .14);
            --bp-line-strong: rgba(143, 196, 255, .38);
            --bp-ink: #EAF2F8;
            --bp-ink-muted: #87A6BF;
            --bp-accent: #FF8A3D;
            --bp-accent-2: #5FD4D4;
            --font-display: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif;
            --font-body: 'Inter', ui-sans-serif, system-ui, sans-serif;
            --font-mono: 'IBM Plex Mono', ui-monospace, SFMono-Regular, monospace;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html {
            -webkit-text-size-adjust: 100%
        }

        body {
            background-color: var(--bp-bg);
            color: var(--bp-ink);
            font-family: var(--font-body);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-image: linear-gradient(rgba(10, 31, 51, .90), rgba(10, 31, 51, .94)),
            linear-gradient(var(--bp-line) 1px, transparent 1px),
            linear-gradient(90deg, var(--bp-line) 1px, transparent 1px),
            url('{{ asset(' images/office-bg.jpg') }}');
            background-size: cover, 44px 44px, 44px 44px, cover;
            background-position: center, -1px -1px, -1px -1px, center;
            background-attachment: fixed, scroll, scroll, fixed;
            background-repeat: no-repeat, repeat, repeat, no-repeat;
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none
        }

        .bp-wrap {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 28px;
        }

        /* ---------- Header ---------- */
        .bp-header {
            padding: 28px 0 0;
            background: linear-gradient(180deg, rgba(10, 31, 51, .55), rgba(10, 31, 51, 0));
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .bp-header .bp-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            border-bottom: 1px solid var(--bp-line-strong);
            padding-bottom: 20px;
        }

        .bp-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: var(--font-mono);
            letter-spacing: .08em;
            font-size: 13px;
            text-transform: uppercase;
            color: var(--bp-ink);
        }

        .bp-brand svg {
            flex-shrink: 0
        }

        .bp-brand b {
            font-weight: 500
        }

        .bp-brand span {
            color: var(--bp-ink-muted)
        }

        .bp-nav {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bp-btn {
            position: relative;
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: .05em;
            text-transform: uppercase;
            padding: 6px 13px;
            border: 1px solid var(--bp-line-strong);
            border-radius: 2px;
            color: var(--bp-ink);
            transition: border-color .2s ease, color .2s ease, background-color .2s ease;
            white-space: nowrap;
        }

        .bp-btn:hover {
            border-color: var(--bp-accent-2);
            color: var(--bp-accent-2)
        }

        .bp-btn--solid {
            background: var(--bp-accent);
            border-color: var(--bp-accent);
            color: #12212f;
            font-weight: 500;
        }

        .bp-btn--solid:hover {
            background: transparent;
            color: var(--bp-accent);
            border-color: var(--bp-accent);
        }

        /* ---------- Hero ---------- */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 64px 0
        }

        .bp-hero {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 56px;
            align-items: center;
        }

        .bp-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: var(--font-mono);
            font-size: 12px;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--bp-accent-2);
            margin-bottom: 22px;
        }

        .bp-eyebrow .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--bp-accent-2);
            box-shadow: 0 0 0 3px rgba(95, 212, 212, .18);
        }

        .bp-title {
            font-family: var(--font-display);
            font-weight: 600;
            font-size: clamp(2.1rem, 3.6vw, 3.4rem);
            line-height: 1.08;
            letter-spacing: -.01em;
            margin-bottom: 20px;
        }

        .bp-title em {
            font-style: normal;
            color: var(--bp-accent);
        }

        .bp-sub {
            color: var(--bp-ink-muted);
            font-size: 16px;
            line-height: 1.65;
            max-width: 46ch;
            margin-bottom: 34px;
        }

        .bp-specs {
            border-top: 1px solid var(--bp-line-strong);
            margin-bottom: 34px;
        }

        .bp-spec-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 0;
            border-bottom: 1px solid var(--bp-line);
        }

        .bp-spec-row .ref {
            font-family: var(--font-mono);
            font-size: 12px;
            color: var(--bp-accent-2);
            letter-spacing: .05em;
            width: 52px;
            flex-shrink: 0;
        }

        .bp-spec-row a {
            font-weight: 500;
            border-bottom: 1px solid transparent;
            transition: border-color .2s ease, color .2s ease;
        }

        .bp-spec-row a:hover {
            color: var(--bp-accent-2);
            border-color: var(--bp-accent-2);
        }

        .bp-spec-row .desc {
            color: var(--bp-ink-muted);
            font-size: 13px;
        }

        .bp-spec-row svg {
            margin-left: auto;
            opacity: .6;
            flex-shrink: 0
        }

        .bp-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: var(--font-mono);
            font-size: 13px;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 15px 26px;
            border: 1.5px solid var(--bp-accent);
            border-radius: 2px;
            color: var(--bp-accent);
            transform: rotate(-1.2deg);
            transition: transform .25s ease, background-color .25s ease, color .25s ease;
        }

        .bp-cta:hover {
            transform: rotate(0deg);
            background: var(--bp-accent);
            color: #12212f;
        }

        /* ---------- Diagram ---------- */
        .bp-diagram-wrap {
            position: relative;
        }

        .bp-diagram-frame {
            position: relative;
            border: 1px solid var(--bp-line-strong);
            border-radius: 4px;
            background: linear-gradient(180deg, rgba(15, 46, 76, .72), rgba(13, 43, 71, .8));
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            padding: 26px 22px 22px;
        }

        .bp-diagram-frame::before {
            content: "FIG. 01 — DASHBOARD SCHEMATIC";
            position: absolute;
            top: -11px;
            left: 18px;
            background: var(--bp-bg);
            padding: 0 8px;
            font-family: var(--font-mono);
            font-size: 10px;
            letter-spacing: .1em;
            color: var(--bp-ink-muted);
        }

        .bp-stamp {
            position: absolute;
            top: -18px;
            right: -14px;
            width: 74px;
            height: 74px;
            border: 1.5px solid var(--bp-accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(-9deg);
            font-family: var(--font-mono);
            font-size: 9px;
            letter-spacing: .05em;
            color: var(--bp-accent);
            text-align: center;
            line-height: 1.5;
            background: var(--bp-bg);
            z-index: 2;
        }

        .bp-cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .bp-card {
            border: 1px dashed var(--bp-line-strong);
            border-radius: 3px;
            padding: 14px;
        }

        .bp-card .num {
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--bp-accent-2);
            letter-spacing: .06em;
            display: block;
            margin-bottom: 8px;
        }

        .bp-card .val {
            font-family: var(--font-display);
            font-size: 20px;
            font-weight: 600;
            display: block;
        }

        .bp-card .lbl {
            font-size: 11px;
            color: var(--bp-ink-muted);
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .bp-card--wide {
            grid-column: 1 / -1
        }

        /* ---------- Title block / footer ---------- */
        .bp-footer {
            border-top: 1px solid var(--bp-line-strong);
            padding: 20px 0 30px;
        }

        .bp-titleblock {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            border: 1px solid var(--bp-line-strong);
            border-radius: 2px;
            overflow: hidden;
        }

        .bp-titleblock div {
            padding: 12px 16px;
            border-right: 1px solid var(--bp-line);
            font-family: var(--font-mono);
            font-size: 11px;
        }

        .bp-titleblock div:last-child {
            border-right: none
        }

        .bp-titleblock span {
            display: block;
            color: var(--bp-ink-muted);
            letter-spacing: .08em;
            text-transform: uppercase;
            font-size: 9px;
            margin-bottom: 4px;
        }

        /* ---------- Motion ---------- */
        .bp-reveal {
            animation: bpFade .7s ease both;
        }

        .bp-reveal.d1 {
            animation-delay: .05s
        }

        .bp-reveal.d2 {
            animation-delay: .15s
        }

        .bp-reveal.d3 {
            animation-delay: .25s
        }

        @keyframes bpFade {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .bp-reveal {
                animation: none
            }
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 860px) {
            .bp-hero {
                grid-template-columns: 1fr;
                gap: 40px
            }

            .bp-titleblock {
                grid-template-columns: repeat(2, 1fr)
            }

            .bp-titleblock div:nth-child(2) {
                border-right: none
            }
        }

        @media (max-width: 480px) {
            .bp-header .bp-wrap {
                flex-wrap: wrap
            }

            .bp-titleblock {
                grid-template-columns: 1fr
            }

            .bp-titleblock div {
                border-right: none;
                border-bottom: 1px solid var(--bp-line)
            }

            .bp-titleblock div:last-child {
                border-bottom: none
            }
        }
    </style>
</head>

<body>

    <header class="bp-header">
        <div class="bp-wrap">
            <div class="bp-brand">

                <b><img src="{{ asset('images/logo.jpeg') }}"
                        alt="{{ config('app.name', 'Console') }} logo"
                        style="
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #ffffff;
        padding: 4px;
        border: 2px solid #d1d5db;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
     "></b>
                <span>/ RMS Connect 360</span>
            </div>

            @if (Route::has('login'))
            <nav class="bp-nav">
                @auth
                <a href="{{ url('/dashboard') }}" class="bp-btn bp-btn--solid">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="bp-btn">Log in</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bp-btn bp-btn--solid">Register</a>
                @endif
                @endauth
            </nav>
            @endif
        </div>
    </header>

    <main>
        <div class="bp-wrap bp-hero">

            <div>
                <div class="bp-eyebrow bp-reveal">
                    <span class="dot"></span>
                    System / Project Management Platform
                </div>

                <h1 class="bp-title bp-reveal d1">
                    Manage Projects,
                    <br>Collaborate with Teams,
                    <br>and <em>Deliver Successfully.</em>
                </h1>

                <p class="bp-sub bp-reveal d1">
                    Manage projects, assign tasks, collaborate through
                    real-time chat, schedule meetings, track progress,
                    and deliver projects from a single secure platform.
                </p>

                <div class="bp-specs bp-reveal d2">
                    <div class="bp-spec-row">
                        <span class="ref">REF.01</span>
                        <a href="{{ url('/dashboard') }}">Explore Dashboard</a>
                        <span class="desc">Live project overview</span>
                        <svg width="11" height="11" viewBox="0 0 10 11" fill="none">
                            <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" stroke="currentColor" stroke-linecap="square" />
                        </svg>
                    </div>
                    <div class="bp-spec-row">
                        <span class="ref">REF.02</span>
                        <a href="#">Support</a>
                        <span class="desc">Reach the team</span>
                        <svg width="11" height="11" viewBox="0 0 10 11" fill="none">
                            <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" stroke="currentColor" stroke-linecap="square" />
                        </svg>
                    </div>
                </div>

                <a href="{{ Route::has('register') ? route('register') : url('/dashboard') }}" class="bp-cta bp-reveal d3">
                    Get started
                    <svg width="11" height="11" viewBox="0 0 10 11" fill="none">
                        <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" stroke="currentColor" stroke-linecap="square" />
                    </svg>
                </a>
            </div>

            <div class="bp-diagram-wrap bp-reveal d2">
                <div class="bp-diagram-frame">
                    <div class="bp-stamp">APPROVED<br>REV&nbsp;A</div>
                    <div class="bp-cards">
                        <div class="bp-card">
                            <span class="num">01</span>
                            <span class="val">8</span>
                            <span class="lbl">Users</span>
                        </div>
                        <div class="bp-card">
                            <span class="num">02</span>
                            <span class="val">9</span>
                            <span class="lbl">Projects</span>
                        </div>
                        <div class="bp-card">
                            <span class="num">03</span>
                            <span class="val">3</span>
                            <span class="lbl">Clients</span>
                        </div>
                        <div class="bp-card">
                            <span class="num">04</span>
                            <span class="val">6</span>
                            <span class="lbl">Tasks</span>
                        </div>
                        <div class="bp-card bp-card--wide">
                            <span class="num">05</span>
                            <span class="val">₹ Revenue Overview</span>
                            <span class="lbl">Tracked monthly, by range</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="bp-footer">
        <div class="bp-wrap">
            <div class="bp-titleblock">
                <div><span>Framework</span>{{ config('app.name', 'Console') }}</div>
                <div><span>Version </span>v1.0</div>
                <div><span>Developer</span>RMS Connect 360</div>
                <div><span>Date</span>{{ now()->format('Y-m-d') }}</div>
            </div>
        </div>
    </footer>

</body>

</html>