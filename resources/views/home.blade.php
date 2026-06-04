@extends('layouts.app')
@section('title', 'TurkeyTours — Discover the Magic of Turkey')

@section('styles')
<style>
    .hero {
        position: relative;
        min-height: 90vh;
        display: flex;
        align-items: center;
        background: var(--navy);
        overflow: hidden;
    }
    .hero-bg {
        position: absolute;
        inset: 0;
        background-image: url('https://images.unsplash.com/photo-1524231757912-21f4fe3a7200?w=1600&q=80');
        background-size: cover;
        background-position: center;
        opacity: 0.28;
    }
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(15,23,42,0.96) 0%, rgba(15,23,42,0.7) 60%, rgba(192,57,43,0.18) 100%);
    }
    .hero-content {
        position: relative;
        z-index: 1;
        padding: 5rem 0;
        max-width: 620px;
    }
    .hero-eyebrow {
        display: inline-block;
        background: rgba(217,119,6,0.14);
        border: 1px solid rgba(217,119,6,0.35);
        border-radius: 50px;
        padding: 0.32rem 1rem;
        color: #fbbf24;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 1.4rem;
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.4rem, 5vw, 4.8rem);
        font-weight: 700;
        color: white;
        line-height: 1.1;
        margin-bottom: 1.4rem;
    }
    .hero-title em { color: #fbbf24; font-style: italic; }
    .hero-subtitle {
        font-size: 1rem;
        color: rgba(255,255,255,0.7);
        max-width: 490px;
        line-height: 1.8;
        margin-bottom: 2.2rem;
    }
    .hero-buttons {
        display: flex;
        gap: 0.9rem;
        flex-wrap: wrap;
    }
    .hero-stats {
        display: flex;
        gap: 2rem;
        margin-top: 2.8rem;
        padding-top: 1.8rem;
        border-top: 1px solid rgba(255,255,255,0.1);
    }
    .stat-num {
        font-family: 'Playfair Display', serif;
        font-size: 1.85rem;
        font-weight: 700;
        color: #fbbf24;
        line-height: 1;
    }
    .stat-lbl {
        font-size: 0.73rem;
        color: rgba(255,255,255,0.48);
        margin-top: 0.2rem;
    }

    .features-strip {
        background: var(--navy-mid);
        padding: 1.1rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    .features-row {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 2.2rem;
    }
    .feature-item {
        font-size: 0.85rem;
        font-weight: 500;
        color: rgba(255,255,255,0.68);
        display: flex;
        align-items: center;
        gap: 0.45rem;
    }
    .feature-item .tick { color: var(--gold); font-weight: 700; }

    .section-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2.5rem;
    }

    .tours-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.4rem;
    }

    .cities-section {
        background: var(--navy);
        padding: 5rem 0;
    }
    .cities-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.2rem;
    }
    .city-card {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        display: block;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .city-card:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(0,0,0,0.3); }
    .city-card img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
        display: block;
    }
    .city-card:hover img { transform: scale(1.05); }
    .city-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15,23,42,0.9) 0%, rgba(15,23,42,0.25) 65%, transparent 100%);
    }
    .city-info {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 1.1rem;
    }
    .city-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
    }
    .city-tours { font-size: 0.76rem; color: #fbbf24; margin-top: 0.15rem; }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.4rem;
    }
    .why-card {
        background: white;
        border-radius: 8px;
        padding: 2rem 1.4rem;
        text-align: center;
        border: 1px solid var(--border);
        transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    }
    .why-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 22px rgba(0,0,0,0.08);
        border-color: rgba(192,57,43,0.18);
    }
    .why-icon {
        width: 56px; height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.1rem;
        font-size: 1.4rem;
        font-weight: 700;
    }

    .cta-section {
        background: var(--navy);
        border-radius: 10px;
        padding: 3.2rem;
    }
    .cta-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.8rem;
    }

    @media (max-width: 900px) {
        .tours-grid { grid-template-columns: repeat(2, 1fr); }
        .why-grid   { grid-template-columns: repeat(2, 1fr); }
        .cities-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 580px) {
        .tours-grid { grid-template-columns: 1fr; }
        .why-grid   { grid-template-columns: 1fr 1fr; }
        .cta-section { padding: 2rem 1.4rem; }
    }
</style>
@endsection

@section('content')

<!-- Hero -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-eyebrow">Turkey's #1 Tour Agency</div>
            <h1 class="hero-title">
                Discover the<br>
                <em>Magic</em> of<br>
                Turkey
            </h1>
            <p class="hero-subtitle">
                From the minarets of Istanbul to the fairy chimneys of Cappadocia — we craft unforgettable journeys across Turkey's most breathtaking destinations.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('tours') }}" class="btn btn-primary">Explore Tours</a>
                <a href="{{ route('cities') }}" class="btn btn-outline">Browse Cities</a>
            </div>
            <div class="hero-stats">
                <div>
                    <div class="stat-num">8+</div>
                    <div class="stat-lbl">Tour Packages</div>
                </div>
                <div>
                    <div class="stat-num">4</div>
                    <div class="stat-lbl">Turkish Cities</div>
                </div>
                <div>
                    <div class="stat-num">10+</div>
                    <div class="stat-lbl">Years Experience</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Strip -->
<div class="features-strip">
    <div class="container">
        <div class="features-row">
            <div class="feature-item"><span class="tick">&#10003;</span> Trusted Agency</div>
            <div class="feature-item"><span class="tick">&#10003;</span> Expert Local Guides</div>
            <div class="feature-item"><span class="tick">&#10003;</span> Best Price Guarantee</div>
            <div class="feature-item"><span class="tick">&#10003;</span> 24/7 Support</div>
            <div class="feature-item"><span class="tick">&#10003;</span> Flexible Booking</div>
        </div>
    </div>
</div>

<!-- Featured Tours -->
<section style="padding:5rem 0;">
    <div class="container">
        <div class="section-row">
            <div>
                <div class="section-label">Handpicked Experiences</div>
                <h2 class="section-title">Featured <span>Tours</span></h2>
                <p style="color:var(--gray);margin-top:0.7rem;max-width:490px;line-height:1.7;font-size:0.95rem;">Our most popular packages, carefully curated for an unforgettable Turkish adventure.</p>
            </div>
            <a href="{{ route('tours') }}" class="btn btn-primary">View All Tours &rarr;</a>
        </div>

        @if($featuredTours->isEmpty())
            <div class="text-center" style="padding:3rem 0;">
                <p class="text-muted">No tours available yet.</p>
            </div>
        @else
            <div class="tours-grid">
                @foreach($featuredTours as $tour)
                <div class="tour-card">
                    <div class="card-img-wrap">
                        @if($tour->image)
                            <img src="{{ $tour->image }}" alt="{{ $tour->title }}" loading="lazy">
                        @else
                            <div class="img-placeholder">&#128247;</div>
                        @endif
                        <span class="card-city-badge">{{ $tour->category->name }}</span>
                        <span class="card-price-tag">${{ number_format($tour->price, 0) }}</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $tour->title }}</h5>
                        <p class="card-text">{{ Str::limit($tour->description, 90) }}</p>
                        <div class="card-foot">
                            <span class="card-meta">&#128336; {{ $tour->duration_days }} day(s)</span>
                            <a href="{{ route('tours.show', $tour->id) }}" class="btn btn-primary btn-sm">View Tour</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Cities Showcase -->
<section class="cities-section">
    <div class="container">
        <div class="text-center" style="margin-bottom:2.8rem;">
            <div class="section-label" style="color:var(--gold);">Our Destinations</div>
            <h2 class="section-title" style="color:white;">Explore Turkish <em style="color:#fbbf24;">Cities</em></h2>
            <p style="color:rgba(255,255,255,0.58);margin-top:0.7rem;font-size:0.92rem;">Each city tells a different story. Which chapter will you write?</p>
        </div>

        <div class="cities-grid">
            <a href="{{ route('tours', ['category' => 1]) }}" class="city-card" style="height:280px;">
                <img src="https://images.unsplash.com/photo-1524231757912-21f4fe3a7200?w=800&q=80" alt="Istanbul" loading="lazy">
                <div class="city-overlay"></div>
                <div class="city-info">
                    <div class="city-name">Istanbul</div>
                    <div class="city-tours">2 tours available</div>
                </div>
            </a>
            <div style="display:grid;grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr;gap:1.2rem;height:280px;">
                <a href="{{ route('tours', ['category' => 2]) }}" class="city-card" style="grid-column:1/3;">
                    <img src="https://images.unsplash.com/photo-1570939274717-7eda259b50ed?w=800&q=80" alt="Cappadocia" loading="lazy">
                    <div class="city-overlay"></div>
                    <div class="city-info" style="padding:0.8rem;">
                        <div class="city-name" style="font-size:1.1rem;">Cappadocia</div>
                        <div class="city-tours">3 tours available</div>
                    </div>
                </a>
                <a href="{{ route('tours', ['category' => 3]) }}" class="city-card">
                    <img src="https://images.unsplash.com/photo-1571406252241-db0280bd36cd?w=800&q=80" alt="Antalya" loading="lazy">
                    <div class="city-overlay"></div>
                    <div class="city-info" style="padding:0.8rem;">
                        <div class="city-name" style="font-size:0.98rem;">Antalya</div>
                        <div class="city-tours">2 tours</div>
                    </div>
                </a>
                <a href="{{ route('tours', ['category' => 4]) }}" class="city-card">
                    <img src="https://images.unsplash.com/photo-1578922746465-3a80a228f223?w=800&q=80" alt="Pamukkale" loading="lazy">
                    <div class="city-overlay"></div>
                    <div class="city-info" style="padding:0.8rem;">
                        <div class="city-name" style="font-size:0.98rem;">Pamukkale</div>
                        <div class="city-tours">1 tour</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section style="padding:5rem 0;">
    <div class="container">
        <div class="text-center" style="margin-bottom:2.8rem;">
            <div class="section-label">Why Travel With Us</div>
            <h2 class="section-title">Your Journey, <span>Our Passion</span></h2>
        </div>
        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon" style="background:rgba(192,57,43,0.08);color:var(--red);">10+</div>
                <h6 style="font-family:'Playfair Display',serif;font-weight:700;font-size:0.97rem;margin-bottom:0.45rem;">Trusted Agency</h6>
                <p style="font-size:0.82rem;color:var(--gray);line-height:1.7;">Over 10 years crafting unforgettable Turkish experiences.</p>
            </div>
            <div class="why-card">
                <div class="why-icon" style="background:rgba(217,119,6,0.08);color:var(--gold);">&#9733;</div>
                <h6 style="font-family:'Playfair Display',serif;font-weight:700;font-size:0.97rem;margin-bottom:0.45rem;">Expert Guides</h6>
                <p style="font-size:0.82rem;color:var(--gray);line-height:1.7;">Certified, English-speaking local guides on every tour.</p>
            </div>
            <div class="why-card">
                <div class="why-icon" style="background:rgba(16,185,129,0.08);color:#10b981;">$</div>
                <h6 style="font-family:'Playfair Display',serif;font-weight:700;font-size:0.97rem;margin-bottom:0.45rem;">Best Prices</h6>
                <p style="font-size:0.82rem;color:var(--gray);line-height:1.7;">We match any lower price you find for the same tour.</p>
            </div>
            <div class="why-card">
                <div class="why-icon" style="background:rgba(99,102,241,0.08);color:#6366f1;">24h</div>
                <h6 style="font-family:'Playfair Display',serif;font-weight:700;font-size:0.97rem;margin-bottom:0.45rem;">24/7 Support</h6>
                <p style="font-size:0.82rem;color:var(--gray);line-height:1.7;">Round-the-clock assistance before, during and after your trip.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Banner -->
<section style="padding:0 0 5rem;">
    <div class="container">
        <div class="cta-section">
            <div class="cta-inner">
                <div>
                    <div class="section-label" style="color:var(--gold);">Ready to Explore?</div>
                    <h2 style="font-family:'Playfair Display',serif;font-size:2.1rem;font-weight:700;color:white;line-height:1.2;margin-top:0.2rem;">
                        Start Your Turkish<br><em style="color:#fbbf24;">Adventure Today</em>
                    </h2>
                    <p style="color:rgba(255,255,255,0.58);font-size:0.92rem;margin-top:0.7rem;max-width:440px;line-height:1.7;">
                        Browse our curated tour packages and book your dream trip to Turkey in minutes.
                    </p>
                </div>
                <div style="display:flex;gap:0.9rem;flex-wrap:wrap;">
                    <a href="{{ route('tours') }}" style="display:inline-block;background:var(--gold);color:var(--navy);padding:0.65rem 1.7rem;border-radius:6px;font-weight:700;font-size:0.88rem;">Browse Tours</a>
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-outline">Create Account</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
