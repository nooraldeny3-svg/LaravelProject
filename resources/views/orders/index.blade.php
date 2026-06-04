@extends('layouts.app')
@section('title', 'My Bookings — TurkeyTours')

@section('styles')
<style>
    .bookings-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .booking-card {
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: box-shadow 0.2s;
    }
    .booking-card:hover { box-shadow: 0 5px 18px rgba(0,0,0,0.09); }
    .booking-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.1rem 1.4rem;
        border-bottom: 1px solid #f1f5f9;
    }
    .booking-ref {
        font-family: 'Playfair Display', serif;
        font-size: 0.97rem;
        font-weight: 700;
        color: var(--navy);
    }
    .booking-body {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        padding: 1.2rem 1.4rem;
    }
    .booking-meta .b-label {
        font-size: 0.67rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--gray);
        margin-bottom: 0.18rem;
    }
    .booking-meta .b-val { font-weight: 600; color: var(--navy); font-size: 0.88rem; }
    .booking-total {
        font-family: 'Playfair Display', serif;
        font-size: 1.45rem;
        font-weight: 800;
        color: var(--red);
    }
    .info-note {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 0.8rem 1rem;
        font-size: 0.8rem;
        color: var(--gray);
        margin-top: 1.2rem;
    }
    .empty-box { text-align: center; padding: 5rem 0; }
    .empty-icon { font-size: 2.5rem; color: var(--gray); margin-bottom: 1.1rem; }
    @media (max-width: 700px) {
        .booking-body { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 420px) {
        .booking-body { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <div class="section-label" style="color:var(--gold);">Your Journey History</div>
        <h1 class="section-title" style="color:white;">My Bookings</h1>
    </div>
</div>

<div class="container" style="padding-top:3rem;padding-bottom:3rem;">

    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.8rem;margin-bottom:1.8rem;">
        <p class="text-muted" style="font-size:0.88rem;">{{ $orders->count() }} booking(s) found</p>
        <a href="{{ route('tours') }}" class="btn btn-primary btn-sm">+ New Booking</a>
    </div>

    @if($orders->isEmpty())
        <div class="empty-box">
            <div class="empty-icon">&#128218;</div>
            <h3 style="font-family:'Playfair Display',serif;margin-bottom:0.5rem;">No bookings yet</h3>
            <p class="text-muted" style="margin-bottom:1.3rem;">Start exploring Turkey's most amazing destinations.</p>
            <a href="{{ route('tours') }}" class="btn btn-primary">Browse Tours</a>
        </div>
    @else
        <div class="bookings-list">
            @foreach($orders as $order)
            <div class="booking-card">
                <div class="booking-head">
                    <div class="booking-ref">Booking #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                    @if($order->status === 'confirmed')
                        <span class="badge badge-confirmed">&#10003; Confirmed</span>
                    @elseif($order->status === 'cancelled')
                        <span class="badge badge-cancelled">&#10005; Cancelled</span>
                    @else
                        <span class="badge badge-pending">&#8987; Pending</span>
                    @endif
                </div>
                <div class="booking-body">
                    <div class="booking-meta">
                        <div class="b-label">Travel Date</div>
                        <div class="b-val">{{ \Carbon\Carbon::parse($order->travel_date)->format('d M Y') }}</div>
                    </div>
                    <div class="booking-meta">
                        <div class="b-label">Tours</div>
                        <div class="b-val">{{ $order->orderItems->count() }} type(s)</div>
                    </div>
                    <div class="booking-meta">
                        <div class="b-label">Booked On</div>
                        <div class="b-val">{{ $order->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="booking-meta">
                        <div class="b-label">Total</div>
                        <div class="booking-total">${{ number_format($order->total_price, 2) }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="info-note">
            Our team will confirm pending bookings within 24 hours and contact you by phone.
        </div>
    @endif
</div>
@endsection
