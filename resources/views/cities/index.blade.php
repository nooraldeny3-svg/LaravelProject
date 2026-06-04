@extends('layouts.app')
@section('title', 'Cities — TurkeyTours')

@section('styles')
<style>
    .cities-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        padding: 3rem 0;
    }
    .city-showcase {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        height: 340px;
        display: block;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .city-showcase:hover { transform: translateY(-5px); box-shadow: 0 14px 36px rgba(0,0,0,0.2); }
    .city-showcase img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
        display: block;
    }
    .city-showcase:hover img { transform: scale(1.06); }
    .city-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15,23,42,0.95) 0%, rgba(15,23,42,0.38) 55%, transparent 100%);
    }
    .city-body {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 1.7rem;
    }
    .city-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        line-height: 1.2;
    }
    .city-desc {
        font-size: 0.83rem;
        color: rgba(255,255,255,0.62);
        margin-top: 0.35rem;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .city-foot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
    }
    .city-count-badge {
        display: inline-block;
        background: rgba(217,119,6,0.18);
        border: 1px solid rgba(217,119,6,0.35);
        color: #fbbf24;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
    }
    .city-explore {
        display: inline-block;
        background: var(--red);
        color: white;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.4rem 1rem;
        border-radius: 5px;
        transition: background 0.2s;
    }
    .city-showcase:hover .city-explore { background: var(--gold); color: var(--navy); }
    .city-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, var(--navy), var(--navy-mid));
    }
    @media (max-width: 700px) {
        .cities-grid { grid-template-columns: 1fr; }
        .city-showcase { height: 280px; }
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <div class="section-label" style="color:var(--gold);">Our Destinations</div>
        <h1 class="section-title" style="color:white;font-size:2.6rem;">
            Explore Turkish <em style="color:#fbbf24;font-style:italic;">Cities</em>
        </h1>
        <p style="color:rgba(255,255,255,0.62);max-width:500px;margin-top:0.7rem;line-height:1.7;font-size:0.92rem;">
            Each city tells its own story through ancient ruins, vibrant culture, and breathtaking landscapes.
        </p>
    </div>
</div>

<div class="container">
    @if($categories->isEmpty())
        <div class="text-center" style="padding:4rem 0;">
            <p class="text-muted">No cities available yet.</p>
        </div>
    @else
        <div class="cities-grid">
            @foreach($categories as $city)
            <a href="{{ route('tours', ['category' => $city->id]) }}" class="city-showcase">
                @if($city->image)
                    <img src="{{ $city->image }}" alt="{{ $city->name }}" loading="lazy">
                @else
                    <div class="city-placeholder"></div>
                @endif
                <div class="city-overlay"></div>
                <div class="city-body">
                    <div class="city-name">{{ $city->name }}</div>
                    <div class="city-desc">{{ $city->description }}</div>
                    <div class="city-foot">
                        <span class="city-count-badge">{{ $city->products_count }} tour(s)</span>
                        <span class="city-explore">Explore &rarr;</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
