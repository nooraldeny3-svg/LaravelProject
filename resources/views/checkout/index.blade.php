@extends('layouts.app')
@section('title', 'Checkout — TurkeyTours')

@section('styles')
<style>
    .checkout-layout {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 1.8rem;
        padding: 3rem 0;
    }
    .summary-card {
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
        position: sticky;
        top: 80px;
    }
    .summary-head {
        background: var(--navy);
        padding: 1.1rem 1.4rem;
        color: white;
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        font-size: 0.97rem;
    }
    .summary-body { padding: 1.4rem; }
    .summary-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1rem;
        padding: 0.7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .summary-item:last-child { border-bottom: none; }
    .errors-box {
        background: #fee2e2;
        border-left: 4px solid var(--red);
        border-radius: 6px;
        padding: 0.9rem 1.1rem;
        margin-bottom: 1.4rem;
    }
    .errors-box ul { padding-left: 1.2rem; font-size: 0.83rem; color: #b91c1c; }
    .payment-note {
        background: #f8fafc;
        border: 1px dashed var(--border);
        border-radius: 6px;
        padding: 0.9rem 1rem;
        margin-top: 1.1rem;
    }
    @media (max-width: 860px) {
        .checkout-layout { grid-template-columns: 1fr; }
        .summary-card { position: static; }
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <div class="section-label" style="color:var(--gold);">Almost There</div>
        <h1 class="section-title" style="color:white;">Checkout</h1>
    </div>
</div>

<div class="container">
    <div class="checkout-layout">

        <!-- Form -->
        <div>
            <div class="form-card">
                <div class="form-card-header">Your Booking Details</div>
                <div class="form-card-body">

                    @if($errors->any())
                        <div class="errors-box">
                            <p style="font-weight:600;font-size:0.87rem;color:#991b1b;margin-bottom:0.4rem;">Please fix the following:</p>
                            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('checkout.store') }}">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">Full Name <span style="color:var(--red);">*</span></label>
                            <input type="text" name="customer_name"
                                   class="form-input @error('customer_name') is-invalid @enderror"
                                   value="{{ old('customer_name', auth()->user()->name) }}"
                                   placeholder="Enter your full name" required>
                            @error('customer_name')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number <span style="color:var(--red);">*</span></label>
                            <input type="text" name="customer_phone"
                                   class="form-input @error('customer_phone') is-invalid @enderror"
                                   value="{{ old('customer_phone') }}"
                                   placeholder="+90 555 000 00 00" required>
                            @error('customer_phone')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" style="margin-bottom:2rem;">
                            <label class="form-label">Travel Date <span style="color:var(--red);">*</span></label>
                            <input type="date" name="travel_date"
                                   class="form-input @error('travel_date') is-invalid @enderror"
                                   value="{{ old('travel_date') }}"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            <div class="form-hint">Select a date at least 1 day from today.</div>
                            @error('travel_date')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" style="font-size:0.95rem;padding:0.88rem;">
                            Confirm My Booking
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div>
            <div class="summary-card">
                <div class="summary-head">Order Summary</div>
                <div class="summary-body">
                    @foreach($cart as $item)
                        <div class="summary-item">
                            <div style="flex:1;">
                                <div style="font-weight:600;font-size:0.88rem;color:var(--navy);">{{ $item['title'] }}</div>
                                <div style="font-size:0.76rem;color:var(--gray);margin-top:0.15rem;">
                                    {{ $item['quantity'] }} traveler(s) &times; ${{ number_format($item['price'], 2) }}
                                </div>
                            </div>
                            <div style="font-weight:700;color:var(--red);font-family:'Playfair Display',serif;white-space:nowrap;font-size:0.95rem;">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </div>
                        </div>
                    @endforeach

                    <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-top:0.8rem;padding-top:0.8rem;border-top:2px solid var(--navy);">
                        <span style="font-weight:600;">Total</span>
                        <div style="font-family:'Playfair Display',serif;font-size:1.85rem;font-weight:800;color:var(--red);">
                            ${{ number_format($total, 2) }}
                        </div>
                    </div>

                    <div class="payment-note">
                        <p style="font-size:0.78rem;color:var(--gray);line-height:1.7;margin:0;">
                            &#9742; No payment collected online. Our team will contact you within 24 hours to arrange payment.
                        </p>
                    </div>
                </div>
            </div>

            <a href="{{ route('cart.index') }}" class="btn btn-light btn-block" style="margin-top:0.75rem;">
                &larr; Back to Cart
            </a>
        </div>

    </div>
</div>
@endsection
