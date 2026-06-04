@extends('layouts.app')
@section('title', 'Booking Confirmed — TurkeyTours')

@section('styles')
<style>
    .confirm-hero {
        background: var(--navy);
        padding: 5rem 0 3rem;
        text-align: center;
    }
    .success-icon {
        width: 80px; height: 80px;
        border-radius: 50%;
        background: #10b981;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.3rem;
        font-size: 2rem;
        color: white;
        animation: popIn 0.45s ease forwards;
    }
    @keyframes popIn {
        from { transform: scale(0); opacity: 0; }
        to   { transform: scale(1); opacity: 1; }
    }
    .confirm-body {
        max-width: 720px;
        margin: 0 auto;
        padding: 3rem 1.5rem;
    }
    .order-card {
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border);
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        overflow: hidden;
        margin-bottom: 1.4rem;
    }
    .order-card-head {
        background: var(--navy);
        padding: 1.1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
    }
    .order-card-body { padding: 1.8rem; }
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.1rem;
        margin-bottom: 1.5rem;
    }
    .detail-cell .d-label {
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--gray);
        margin-bottom: 0.2rem;
    }
    .detail-cell .d-val { font-weight: 600; color: var(--navy); font-size: 0.9rem; }
    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .item-row:last-child { border-bottom: none; }
    .next-steps-box {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        padding: 1.4rem;
        margin-bottom: 1.4rem;
    }
    .step-row {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        margin-bottom: 0.9rem;
    }
    .step-row:last-child { margin-bottom: 0; }
    .step-num {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #d1fae5;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.78rem;
        font-weight: 700;
        color: #059669;
        flex-shrink: 0;
    }
    .action-row {
        display: flex;
        gap: 0.9rem;
        flex-wrap: wrap;
    }
    @media (max-width: 560px) {
        .detail-grid { grid-template-columns: 1fr; }
        .action-row { flex-direction: column; }
        .action-row .btn { width: 100%; }
    }
</style>
@endsection

@section('content')

<div class="confirm-hero">
    <div class="container">
        <div class="success-icon">&#10003;</div>
        <h1 style="font-family:'Playfair Display',serif;font-size:2.3rem;font-weight:700;color:white;">Booking Confirmed!</h1>
        <p style="color:rgba(255,255,255,0.68);font-size:0.97rem;margin-top:0.5rem;">
            Thank you, <strong style="color:#fbbf24;">{{ $order->customer_name }}</strong>. Your adventure is one step away!
        </p>
    </div>
</div>

<div class="confirm-body">

    <!-- Order Card -->
    <div class="order-card">
        <div class="order-card-head">
            <div>
                <div style="font-size:0.68rem;opacity:0.58;letter-spacing:1px;text-transform:uppercase;">Booking Reference</div>
                <div style="font-family:'Playfair Display',serif;font-size:1.25rem;font-weight:700;">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
            </div>
            <span class="badge badge-pending" style="padding:0.3rem 0.75rem;font-size:0.78rem;">Pending Review</span>
        </div>

        <div class="order-card-body">
            <div class="detail-grid">
                <div class="detail-cell">
                    <div class="d-label">Customer Name</div>
                    <div class="d-val">{{ $order->customer_name }}</div>
                </div>
                <div class="detail-cell">
                    <div class="d-label">Phone Number</div>
                    <div class="d-val">{{ $order->customer_phone }}</div>
                </div>
                <div class="detail-cell">
                    <div class="d-label">Travel Date</div>
                    <div class="d-val">{{ \Carbon\Carbon::parse($order->travel_date)->format('d F Y') }}</div>
                </div>
                <div class="detail-cell">
                    <div class="d-label">Booking Date</div>
                    <div class="d-val">{{ $order->created_at->format('d F Y') }}</div>
                </div>
            </div>

            <hr style="border:none;border-top:1px solid var(--border);margin-bottom:1.2rem;">

            <h6 style="font-family:'Playfair Display',serif;font-weight:700;font-size:0.95rem;margin-bottom:0.9rem;">Tours Booked</h6>
            @foreach($order->orderItems as $item)
                <div class="item-row">
                    <div>
                        <div style="font-weight:600;color:var(--navy);font-size:0.9rem;">{{ $item->product->title }}</div>
                        <div style="font-size:0.77rem;color:var(--gray);">{{ $item->quantity }} traveler(s) &times; ${{ number_format($item->price, 2) }}</div>
                    </div>
                    <div style="font-family:'Playfair Display',serif;font-weight:700;color:var(--red);font-size:0.97rem;">
                        ${{ number_format($item->price * $item->quantity, 2) }}
                    </div>
                </div>
            @endforeach

            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.9rem;padding-top:0.9rem;border-top:2px solid var(--navy);">
                <span style="font-weight:700;font-size:0.97rem;">Total Amount</span>
                <span style="font-family:'Playfair Display',serif;font-size:1.9rem;font-weight:800;color:var(--red);">
                    ${{ number_format($order->total_price, 2) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Next Steps -->
    <div class="next-steps-box">
        <h6 style="font-family:'Playfair Display',serif;font-weight:700;color:#065f46;font-size:0.95rem;margin-bottom:1rem;">What Happens Next?</h6>
        <div class="step-row">
            <div class="step-num">1</div>
            <span style="font-size:0.87rem;color:#065f46;line-height:1.6;">Our team reviews your booking within 24 hours.</span>
        </div>
        <div class="step-row">
            <div class="step-num">2</div>
            <span style="font-size:0.87rem;color:#065f46;line-height:1.6;">We call you at <strong>{{ $order->customer_phone }}</strong> to confirm details and arrange payment.</span>
        </div>
        <div class="step-row">
            <div class="step-num">3</div>
            <span style="font-size:0.87rem;color:#065f46;line-height:1.6;">Get ready for your Turkish adventure!</span>
        </div>
    </div>

    <div class="action-row">
        <a href="{{ route('orders.index') }}" class="btn btn-primary">View My Bookings</a>
        <a href="{{ route('tours') }}" class="btn btn-light">Browse More Tours</a>
    </div>

</div>
@endsection
