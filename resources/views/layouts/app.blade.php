<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TurkeyTours — Discover Turkey')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* ---- Reset ---- */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        /* ---- Variables ---- */
        :root {
            --navy:     #0f172a;
            --navy-mid: #1e293b;
            --red:      #c0392b;
            --red-dark: #96281b;
            --gold:     #d97706;
            --white:    #ffffff;
            --light:    #f8fafc;
            --gray:     #64748b;
            --border:   #e2e8f0;
        }

        /* ---- Base ---- */
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light);
            color: var(--navy);
            line-height: 1.6;
            font-size: 16px;
        }
        a  { text-decoration: none; color: inherit; }
        img { max-width: 100%; display: block; }
        button, input, select, textarea { font-family: inherit; font-size: inherit; }

        /* ---- Container ---- */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* ---- Navbar ---- */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: var(--navy);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            height: 64px;
            gap: 1rem;
        }
        .nav-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.45rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }
        .nav-brand span { color: var(--gold); }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.1rem;
            list-style: none;
            flex: 1;
            justify-content: center;
        }
        .nav-links a {
            color: rgba(255,255,255,0.78);
            font-size: 0.88rem;
            font-weight: 500;
            padding: 0.45rem 0.8rem;
            border-radius: 5px;
            transition: color 0.2s, background 0.2s;
        }
        .nav-links a:hover { color: white; background: rgba(255,255,255,0.08); }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            flex-shrink: 0;
        }
        .nav-right a,
        .nav-right button {
            color: rgba(255,255,255,0.78);
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.42rem 0.8rem;
            border-radius: 5px;
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.2s, background 0.2s;
        }
        .nav-right a:hover,
        .nav-right button:hover { color: white; background: rgba(255,255,255,0.08); }
        .nav-cart { position: relative; }
        .cart-badge {
            position: absolute;
            top: 1px; right: 1px;
            background: var(--red);
            color: white;
            font-size: 0.58rem;
            font-weight: 700;
            min-width: 15px; height: 15px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .nav-btn-reg {
            background: var(--red) !important;
            color: white !important;
        }
        .nav-btn-reg:hover { background: var(--red-dark) !important; }
        .nav-admin { color: var(--gold) !important; }
        .nav-toggle {
            display: none;
            background: none;
            border: 1px solid rgba(255,255,255,0.25);
            color: white;
            font-size: 1.15rem;
            padding: 0.28rem 0.55rem;
            border-radius: 4px;
            cursor: pointer;
            flex-shrink: 0;
        }
        .nav-spacer { height: 64px; }

        /* ---- Buttons ---- */
        .btn {
            display: inline-block;
            padding: 0.65rem 1.6rem;
            border-radius: 6px;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-family: inherit;
            text-align: center;
            transition: background 0.2s, transform 0.15s, color 0.2s, border-color 0.2s;
        }
        .btn-primary { background: var(--red); color: white; }
        .btn-primary:hover { background: var(--red-dark); color: white; transform: translateY(-1px); }
        .btn-secondary { background: var(--navy); color: white; }
        .btn-secondary:hover { background: var(--navy-mid); color: white; }
        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid rgba(255,255,255,0.45);
        }
        .btn-outline:hover { background: rgba(255,255,255,0.1); border-color: white; color: white; }
        .btn-light { background: #f1f5f9; color: var(--navy); }
        .btn-light:hover { background: var(--border); color: var(--navy); }
        .btn-danger { background: #fee2e2; color: #991b1b; }
        .btn-danger:hover { background: #dc2626; color: white; }
        .btn-edit-sm {
            background: #f1f5f9;
            color: var(--navy);
            border: none;
            border-radius: 5px;
            padding: 0.35rem 0.8rem;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .btn-edit-sm:hover { background: var(--navy); color: white; }
        .btn-del-sm {
            background: #fee2e2;
            color: #991b1b;
            border: none;
            border-radius: 5px;
            padding: 0.35rem 0.8rem;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .btn-del-sm:hover { background: #dc2626; color: white; }
        .btn-sm { padding: 0.38rem 0.85rem; font-size: 0.8rem; }
        .btn-block { display: block; width: 100%; }

        /* ---- Tour Cards ---- */
        .tour-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .tour-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
        .card-img-wrap {
            position: relative;
            height: 210px;
            overflow: hidden;
        }
        .card-img-wrap img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }
        .tour-card:hover .card-img-wrap img { transform: scale(1.05); }
        .img-placeholder {
            height: 210px;
            background: linear-gradient(135deg, var(--navy), var(--navy-mid));
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.2);
            font-size: 2.5rem;
        }
        .card-city-badge {
            position: absolute;
            top: 10px; left: 10px;
            background: rgba(192,57,43,0.88);
            color: white;
            font-size: 0.68rem;
            font-weight: 600;
            padding: 0.2rem 0.6rem;
            border-radius: 3px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }
        .card-price-tag {
            position: absolute;
            bottom: 10px; right: 10px;
            background: rgba(15,23,42,0.85);
            color: #fbbf24;
            font-weight: 700;
            font-size: 0.92rem;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
        }
        .card-body {
            padding: 1.2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.02rem;
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }
        .card-text {
            font-size: 0.83rem;
            color: var(--gray);
            line-height: 1.6;
            flex: 1;
            margin-bottom: 1rem;
        }
        .card-foot {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-meta { font-size: 0.77rem; color: var(--gray); }

        /* ---- Section Headings ---- */
        .section-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 0.4rem;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.1rem;
            font-weight: 700;
            color: var(--navy);
            line-height: 1.2;
        }
        .section-title span { color: var(--red); }

        /* ---- Page Header ---- */
        .page-header {
            background: var(--navy);
            padding: 5rem 0 2.5rem;
        }

        /* ---- Flash Messages ---- */
        .flash-wrap {
            position: fixed;
            top: 74px; right: 1.5rem;
            z-index: 9999;
            width: 320px;
        }
        .flash {
            padding: 0.8rem 1rem;
            border-radius: 6px;
            font-size: 0.865rem;
            font-weight: 500;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 0.75rem;
            box-shadow: 0 4px 14px rgba(0,0,0,0.12);
            margin-bottom: 0.4rem;
        }
        .flash-success { background: #d1fae5; color: #065f46; }
        .flash-error   { background: #fee2e2; color: #991b1b; }
        .flash-close {
            background: none; border: none;
            cursor: pointer; font-size: 1rem;
            opacity: 0.5; color: inherit;
            padding: 0; line-height: 1; flex-shrink: 0;
        }
        .flash-close:hover { opacity: 1; }

        /* ---- Badges ---- */
        .badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-size: 0.72rem;
            font-weight: 600;
        }
        .badge-pending   { background: #fef3c7; color: #92400e; }
        .badge-confirmed { background: #d1fae5; color: #065f46; }
        .badge-cancelled { background: #fee2e2; color: #991b1b; }

        /* ---- Admin Card ---- */
        .admin-card {
            background: white;
            border-radius: 8px;
            border: 1px solid var(--border);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .admin-card-header {
            padding: 1.1rem 1.4rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-card-header h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 0.97rem;
            color: var(--navy);
            margin: 0;
        }

        /* ---- Admin Table ---- */
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: var(--gray);
            background: #f8fafc;
            padding: 0.85rem 1.1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }
        .admin-table td {
            padding: 0.95rem 1.1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            font-size: 0.865rem;
        }
        .admin-table tbody tr:last-child td { border-bottom: none; }
        .admin-table tbody tr:hover { background: #fafafa; }
        .table-wrap { overflow-x: auto; }

        /* ---- Form Card ---- */
        .form-card {
            background: white;
            border-radius: 8px;
            border: 1px solid var(--border);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .form-card-header {
            background: var(--navy);
            padding: 1.1rem 1.6rem;
            color: white;
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1rem;
        }
        .form-card-body { padding: 2rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 0.38rem;
        }
        .form-input {
            display: block;
            width: 100%;
            padding: 0.68rem 0.88rem;
            font-size: 0.88rem;
            color: var(--navy);
            background: white;
            border: 1.5px solid var(--border);
            border-radius: 6px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(192,57,43,0.1);
        }
        .form-input.is-invalid { border-color: #dc2626; }
        .form-error { font-size: 0.76rem; color: #dc2626; margin-top: 0.28rem; }
        .form-hint  { font-size: 0.75rem; color: var(--gray); margin-top: 0.28rem; }

        /* ---- Thumb images in admin tables ---- */
        .thumb {
            width: 58px; height: 44px;
            border-radius: 5px;
            object-fit: cover;
        }
        .thumb-ph {
            width: 58px; height: 44px;
            border-radius: 5px;
            background: linear-gradient(135deg, var(--navy), var(--navy-mid));
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.25);
            font-size: 1rem;
        }

        /* ---- Utilities ---- */
        .text-muted  { color: var(--gray) !important; }
        .text-white  { color: white !important; }
        .text-red    { color: var(--red) !important; }
        .text-gold   { color: var(--gold) !important; }
        .text-center { text-align: center; }
        .fw-bold     { font-weight: 700; }
        .mb-3  { margin-bottom: 1rem; }
        .mb-4  { margin-bottom: 1.5rem; }
        .mb-5  { margin-bottom: 2rem; }
        .mt-3  { margin-top: 1rem; }
        .mt-4  { margin-top: 1.5rem; }
        .py-5  { padding-top: 2.5rem; padding-bottom: 2.5rem; }
        .gap-2 { gap: 0.5rem; }
        .gap-3 { gap: 1rem; }

        /* ---- Footer ---- */
        .footer {
            background: var(--navy);
            color: rgba(255,255,255,0.58);
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.45rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.7rem;
        }
        .footer-brand span { color: var(--gold); }
        .footer-heading {
            font-size: 0.76rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: white;
            margin-bottom: 0.9rem;
        }
        .footer-nav { list-style: none; display: flex; flex-direction: column; gap: 0.4rem; }
        .footer-nav a { font-size: 0.85rem; color: rgba(255,255,255,0.52); transition: color 0.2s; }
        .footer-nav a:hover { color: var(--gold); }
        .footer-nav button {
            background: none; border: none;
            font-size: 0.85rem; color: rgba(255,255,255,0.52);
            cursor: pointer; padding: 0; font-family: inherit;
            transition: color 0.2s;
        }
        .footer-nav button:hover { color: var(--gold); }
        .footer-divider { border: none; border-top: 1px solid rgba(255,255,255,0.07); margin-bottom: 1.2rem; }
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.78rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        /* ---- Responsive ---- */
        @media (max-width: 900px) {
            .nav-links, .nav-right { display: none; }
            .nav-toggle { display: block; }
            .nav-links.open, .nav-right.open {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
                padding: 0.4rem 0 0.6rem;
                gap: 0.05rem;
            }
            .nav-links.open { justify-content: flex-start; }
            .nav-links a, .nav-right a, .nav-right button { display: block; width: 100%; }
            .nav-inner { flex-wrap: wrap; height: auto; padding: 0.7rem 0; align-items: flex-start; }
            .nav-spacer { height: 0; }
            .section-title { font-size: 1.7rem; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 480px) {
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }
    </style>
    @yield('styles')
</head>
<body>

<nav class="navbar">
    <div class="container">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="nav-brand">Turkey<span>Tours</span></a>

            <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">&#9776;</button>

            <ul class="nav-links" id="navLinks">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('tours') }}">Tours</a></li>
                <li><a href="{{ route('cities') }}">Cities</a></li>
            </ul>

            <div class="nav-right" id="navRight">
                @php $cartCount = collect(session()->get('cart', []))->sum('quantity'); @endphp
                <a href="{{ route('cart.index') }}" class="nav-cart">
                    Cart ({{ $cartCount }})@if($cartCount > 0)<span class="cart-badge">{{ $cartCount }}</span>@endif
                </a>

                @auth
                    @if(!auth()->user()->is_admin)
                        <a href="{{ route('orders.index') }}">My Bookings</a>
                    @endif
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.home') }}" class="nav-admin">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}" class="nav-btn-reg">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="flash-wrap">
    @if(session('success'))
        <div class="flash flash-success">
            <span>&#10003; {{ session('success') }}</span>
            <button class="flash-close" onclick="this.parentElement.remove()">&#10005;</button>
        </div>
    @endif
    @if(session('error'))
        <div class="flash flash-error">
            <span>&#9888; {{ session('error') }}</span>
            <button class="flash-close" onclick="this.parentElement.remove()">&#10005;</button>
        </div>
    @endif
</div>

<div class="nav-spacer"></div>

@yield('content')

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="footer-brand">Turkey<span>Tours</span></div>
                <p style="font-size:0.855rem;line-height:1.8;margin-bottom:1rem;">Crafting unforgettable journeys across Turkey's most spectacular destinations since 2014.</p>
                <div style="display:flex;flex-wrap:wrap;gap:0.35rem;">
                    <a href="{{ route('tours', ['category' => 1]) }}" style="font-size:0.76rem;padding:0.18rem 0.65rem;border-radius:50px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.6);transition:background 0.2s;">Istanbul</a>
                    <a href="{{ route('tours', ['category' => 2]) }}" style="font-size:0.76rem;padding:0.18rem 0.65rem;border-radius:50px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.6);transition:background 0.2s;">Cappadocia</a>
                    <a href="{{ route('tours', ['category' => 3]) }}" style="font-size:0.76rem;padding:0.18rem 0.65rem;border-radius:50px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.6);transition:background 0.2s;">Antalya</a>
                    <a href="{{ route('tours', ['category' => 4]) }}" style="font-size:0.76rem;padding:0.18rem 0.65rem;border-radius:50px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.6);transition:background 0.2s;">Pamukkale</a>
                </div>
            </div>
            <div>
                <p class="footer-heading">Explore</p>
                <ul class="footer-nav">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('tours') }}">All Tours</a></li>
                    <li><a href="{{ route('cities') }}">Cities</a></li>
                    <li><a href="{{ route('cart.index') }}">My Cart</a></li>
                </ul>
            </div>
            <div>
                <p class="footer-heading">Account</p>
                <ul class="footer-nav">
                    @auth
                        <li><a href="{{ route('orders.index') }}">My Bookings</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
            <div>
                <p class="footer-heading">Why TurkeyTours</p>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:0.45rem;font-size:0.84rem;">
                    <li style="display:flex;align-items:center;gap:0.45rem;"><span style="color:var(--gold);">&#10003;</span> Trusted since 2014</li>
                    <li style="display:flex;align-items:center;gap:0.45rem;"><span style="color:var(--gold);">&#10003;</span> Expert English guides</li>
                    <li style="display:flex;align-items:center;gap:0.45rem;"><span style="color:var(--gold);">&#10003;</span> Best price guarantee</li>
                    <li style="display:flex;align-items:center;gap:0.45rem;"><span style="color:var(--gold);">&#10003;</span> 24/7 customer support</li>
                </ul>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} <strong style="color:white;">TurkeyTours</strong>. All rights reserved.</span>
            <span>Istanbul &bull; Cappadocia &bull; Antalya &bull; Pamukkale</span>
        </div>
    </div>
</footer>

<script>
    var toggle = document.getElementById('navToggle');
    var links  = document.getElementById('navLinks');
    var right  = document.getElementById('navRight');
    toggle.addEventListener('click', function() {
        links.classList.toggle('open');
        right.classList.toggle('open');
    });

    setTimeout(function() {
        document.querySelectorAll('.flash').forEach(function(el) {
            el.style.transition = 'opacity 0.4s';
            el.style.opacity = '0';
            setTimeout(function() { el.remove(); }, 400);
        });
    }, 4000);
</script>
@yield('scripts')
</body>
</html>
