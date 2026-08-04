<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Console') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=space-grotesk:500,600,700|ibm-plex-mono:400,500|inter:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root{
                --bg:#0A1F33; --line:rgba(242, 245, 248, 0.14); --line2:rgba(143,196,255,.38);
                --ink:#EAF2F8; --muted:#87A6BF; --accent:#FF8A3D; --accent2:#5FD4D4;
                --f-mono:'IBM Plex Mono',monospace;
            }
            body{
                min-height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center;
                padding:24px 16px; color:var(--ink);
                background-color:var(--bg);
                background-image:
                    linear-gradient(rgba(10,31,51,.9), rgba(10,31,51,.94)),
                    linear-gradient(var(--line) 1px, transparent 1px),
                    linear-gradient(90deg, var(--line) 1px, transparent 1px),
                    url('{{ asset('images/office-bg.jpg') }}');
                background-size:cover, 44px 44px, 44px 44px, cover;
                background-position:center, -1px -1px, -1px -1px, center;
                background-attachment:fixed, scroll, scroll, fixed;
                background-repeat:no-repeat, repeat, repeat, no-repeat;
            }

            .auth-logo{display:flex; flex-direction:column; align-items:center; gap:10px; margin-bottom:22px}
            .auth-logo img{width:65px; height:65px; object-fit:cover; border-radius:10px; border:0px solid var(--line2)}
            .auth-logo span{font:11px var(--f-mono); letter-spacing:.14em; text-transform:uppercase; color:var(--accent2)}

            .auth-card{
                width:100%; max-width:420px;
                background:rgba(242, 243, 243, 0.85);
                backdrop-filter:blur(8px); -webkit-backdrop-filter:blur(8px);
                border:1px solid var(--line2); border-radius:15px;
                padding:6px;
            }
            .auth-card > div{background:#fff; border-radius:4px; padding:22px; color:#1b1b18}
        </style>
    </head>
    <body class="antialiased">

        <div class="auth-logo">
            <a href="{{ url('/') }}">
<img src="{{ asset('images/logo.jpeg') }}"
     alt="{{ config('app.name', 'Console') }} logo"
     style="
        width: 85px;
        height: 85px;
        border-radius: 50%;
        background: #ffffff;
        padding: 6px;
        border: 2px solid #d1d5db;
        box-shadow: 0 4px 12px rgba(0,0,0,0.20);
     ">            </a>
            <!-- <span>{{ config('app.name', 'Console') }} / Project Hub</span> -->
        </div>

        <div class="auth-card">
            <div>
                {{ $slot }}
            </div>
        </div>

    </body>
</html>