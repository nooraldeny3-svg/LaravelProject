@extends('layouts.app')
@section('title', $product->title . ' — TurkeyTours')

@section('styles')
<style>
    .tour-hero {
        position: relative;
        height: 50vh;
        min-height: 340px;
        overflow: hidden;
        background: var(--navy);
    }
    .tour-hero img {
        width: 100%; height: 100%;
        object-fit: cover;
        opacity: 0.58;
    }
    .tour-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, var(--navy) 0%, rgba(15,23,42,0.55) 50%, rgba(15,23,42,0.25) 100%);
    }
    .tour-hero-content {
        position: absolute;
        bottom: 2rem; left: 0; right: 0;
    }
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.82rem;
        color: rgba(255,255,255,0.58);
        margin-bottom: 0.75rem;
        flex-wrap: wrap;
    }
    .breadcrumb a { color: rgba(255,255,255,0.58); transition: color 0.2s; }
    .breadcrumb a:hover { color: white; }
    .breadcrumb span { color: rgba(255,255,255,0.35); }

    .tour-body {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 2.5rem;
        padding: 3rem 0;
    }

    .detail-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
        margin-bottom: 1.8rem;
    }
    .detail-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 0.45rem 0.9rem;
        font-size: 0.83rem;
        font-weight: 500;
        color: var(--navy);
    }
    .detail-tag .tag-icon { color: var(--red); }

    .included-box {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 1.4rem;
        margin-top: 1.5rem;
    }
    .included-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.6rem;
        margin-top: 0.9rem;
    }
    .included-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.84rem;
        color: var(--navy);
    }
    .included-item .chk { color: #10b981; font-weight: 700; }

    .booking-card {
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border);
        box-shadow: 0 4px 18px rgba(0,0,0,0.08);
        overflow: hidden;
        position: sticky;
        top: 80px;
    }
    .booking-card-head {
        background: var(--navy);
        padding: 1.3rem 1.5rem;
        color: white;
    }
    .price-display {
        font-family: 'Playfair Display', serif;
        font-size: 2.6rem;
        font-weight: 700;
        color: #fbbf24;
        line-height: 1;
    }
    .booking-card-body { padding: 1.5rem; }
    .available-note {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        font-size: 0.84rem;
        color: #065f46;
        font-weight: 600;
        margin-bottom: 1.2rem;
    }
    .unavailable-note {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        border-radius: 6px;
        padding: 1rem;
        text-align: center;
    }
    .guarantees {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: var(--gray);
        margin-top: 1.2rem;
        padding-top: 1.2rem;
        border-top: 1px solid var(--border);
    }
    .guarantee-row { display: flex; align-items: center; gap: 0.5rem; }
    .guarantee-row .g-icon { color: var(--red); }

    @media (max-width: 900px) {
        .tour-body { grid-template-columns: 1fr; }
        .booking-card { position: static; }
    }
    @media (max-width: 580px) {
        .included-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

<!-- Tour Hero -->
<div class="tour-hero">
    @if($product->image)
        <img src="{{ $product->image }}" alt="{{ $product->title }}">
    @else
        <div style="width:100%;height:100%;background:linear-gradient(135deg,var(--navy),var(--navy-mid));"></div>
    @endif
    <div class="tour-hero-overlay"></div>
    <div class="tour-hero-content">
        <div class="container">
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('tours') }}">Tours</a>
                <span>/</span>
                <span style="color:rgba(255,255,255,0.85);">{{ $product->title }}</span>
            </nav>
            <span style="background:rgba(192,57,43,0.85);color:white;font-size:0.68rem;font-weight:600;padding:0.2rem 0.65rem;border-radius:3px;text-transform:uppercase;letter-spacing:0.4px;">
                {{ $product->category->name }}
            </span>
            <h1 style="font-family:'Playfair Display',serif;font-size:clamp(1.7rem,3.5vw,2.8rem);font-weight:700;color:white;margin-top:0.65rem;line-height:1.2;">
                {{ $product->title }}
            </h1>
        </div>
    </div>
</div>

<!-- Tour Detail -->
<div class="container">
    <div class="tour-body">

        <!-- Left: Details -->
        <div>
            <div class="detail-tags">
                <span class="detail-tag"><span class="tag-icon">&#128336;</span> {{ $product->duration_days }} day(s)</span>
                <span class="detail-tag"><span class="tag-icon">&#128205;</span> {{ $product->category->name }}</span>
                <span class="detail-tag"><span class="tag-icon">&#128100;</span> Small groups</span>
                <span class="detail-tag"><span class="tag-icon">&#128172;</span> English guide</span>
            </div>

            <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:700;color:var(--navy);margin-bottom:0.9rem;">About This Tour</h2>
            <p style="font-size:0.95rem;line-height:1.9;color:var(--gray);">{{ $product->description }}</p>

            <div class="included-box">
                <h6 style="font-family:'Playfair Display',serif;font-weight:700;color:var(--navy);font-size:0.95rem;">What's Included</h6>
                <div class="included-grid">
                    @foreach(['English-speaking guide','Hotel pickup & drop-off','Entrance fees','Bottled water'] as $item)
                    <div class="included-item">
                        <span class="chk">&#10003;</span> {{ $item }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right: Booking card -->
        <div>
            <div class="booking-card">
                <div class="booking-card-head">
                    <div style="font-size:0.72rem;opacity:0.62;text-transform:uppercase;letter-spacing:1px;margin-bottom:0.2rem;">Price per person</div>
                    <div class="price-display">${{ number_format($product->price, 0) }}</div>
                    <div style="font-size:0.77rem;opacity:0.58;margin-top:0.2rem;">USD &bull; all taxes included</div>
                </div>
                <div class="booking-card-body">
                    @if($product->is_available)
                        <div class="available-note">&#10003; Available for booking</div>
                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block" style="font-size:0.95rem;padding:0.85rem;">
                                Add to Cart
                            </button>
                        </form>
                        <p style="font-size:0.76rem;color:var(--gray);text-align:center;margin-top:0.7rem;line-height:1.6;">
                            Adjust travelers in cart before checkout.
                        </p>
                    @else
                        <div class="unavailable-note">
                            <p style="color:#9a3412;font-size:0.88rem;font-weight:600;margin-bottom:0.3rem;">Currently Unavailable</p>
                            <p style="color:#c2410c;font-size:0.8rem;">Please check back later or browse other tours.</p>
                        </div>
                    @endif

                    <div class="guarantees">
                        <div class="guarantee-row"><span class="g-icon">&#10003;</span> Secure booking guaranteed</div>
                        <div class="guarantee-row"><span class="g-icon">&#10003;</span> Free cancellation policy</div>
                        <div class="guarantee-row"><span class="g-icon">&#10003;</span> 24/7 customer support</div>
                    </div>
                </div>
            </div>

            <a href="{{ route('tours') }}" class="btn btn-light btn-block" style="margin-top:0.75rem;">
                &larr; Back to All Tours
            </a>
        </div>

    </div>
</div>
@endsection
