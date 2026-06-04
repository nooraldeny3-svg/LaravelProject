@extends('layouts.app')
@section('title', 'All Tours — TurkeyTours')

@section('styles')
<style>
    .filter-bar {
        background: white;
        border-radius: 8px;
        padding: 1.25rem 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border: 1px solid var(--border);
        margin: -1.5rem 0 2.5rem;
        position: relative;
        z-index: 10;
    }
    .filter-form {
        display: flex;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 0.9rem;
    }
    .filter-group { display: flex; flex-direction: column; gap: 0.3rem; }
    .filter-label {
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: var(--gray);
    }
    .filter-select {
        padding: 0.6rem 0.9rem;
        font-size: 0.88rem;
        color: var(--navy);
        border: 1.5px solid var(--border);
        border-radius: 6px;
        background: white;
        cursor: pointer;
        outline: none;
        min-width: 200px;
        transition: border-color 0.2s;
        font-family: inherit;
    }
    .filter-select:focus { border-color: var(--red); }
    .filter-meta {
        margin-left: auto;
        font-size: 0.84rem;
        color: var(--gray);
        align-self: center;
    }
    .filter-meta strong { color: var(--navy); font-weight: 700; }
    .tours-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.4rem;
        margin-bottom: 3rem;
    }
    .empty-state {
        text-align: center;
        padding: 4rem 0;
    }
    .empty-state .empty-icon {
        font-size: 2.5rem;
        color: var(--gray);
        margin-bottom: 1rem;
    }
    @media (max-width: 900px) {
        .tours-grid { grid-template-columns: repeat(2, 1fr); }
        .filter-meta { margin-left: 0; }
    }
    @media (max-width: 560px) {
        .tours-grid { grid-template-columns: 1fr; }
        .filter-select { min-width: 100%; width: 100%; }
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <div class="section-label" style="color:var(--gold);">Our Collection</div>
        <h1 class="section-title" style="color:white;font-size:2.6rem;">
            All Tour <em style="color:#fbbf24;font-style:italic;">Packages</em>
        </h1>
        <p style="color:rgba(255,255,255,0.62);max-width:480px;margin-top:0.7rem;font-size:0.92rem;">
            Handcrafted experiences across Turkey's most spectacular destinations.
        </p>
    </div>
</div>

<div class="container" style="padding-top:3rem;">

    <!-- Filter -->
    <div class="filter-bar">
        <form method="GET" action="{{ route('tours') }}" class="filter-form">
            <div class="filter-group">
                <label class="filter-label">Filter by City</label>
                <select name="category" class="filter-select">
                    <option value="">All Cities</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">Apply Filter</button>
            @if(request('category'))
                <a href="{{ route('tours') }}" class="btn btn-light">&#10005; Clear</a>
            @endif
            <div class="filter-meta">
                <strong>{{ $tours->count() }}</strong> tour(s) found
            </div>
        </form>
    </div>

    <!-- Tours Grid -->
    @if($tours->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">&#128270;</div>
            <h4 style="font-family:'Playfair Display',serif;margin-bottom:0.5rem;">No tours found</h4>
            <p class="text-muted" style="margin-bottom:1.2rem;">Try selecting a different city or clear the filter.</p>
            <a href="{{ route('tours') }}" class="btn btn-primary">View All Tours</a>
        </div>
    @else
        <div class="tours-grid">
            @foreach($tours as $tour)
            <div class="tour-card">
                <div class="card-img-wrap">
                    @if($tour->image)
                        <img src="{{ $tour->image }}" alt="{{ $tour->title }}" loading="lazy">
                    @else
                        <div class="img-placeholder">&#128247;</div>
                    @endif
                    <span class="card-city-badge">{{ $tour->category->name }}</span>
                    <span class="card-price-tag">${{ number_format($tour->price, 0) }}<small style="font-size:0.6rem;opacity:0.75;">/pp</small></span>
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
@endsection
