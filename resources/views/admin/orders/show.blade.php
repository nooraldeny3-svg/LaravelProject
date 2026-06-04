@extends('layouts.app')
@section('title', 'Order #' . $order->id . ' — Admin')

@section('styles')
<style>
    .order-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 1.4rem;
        padding-top: 2.5rem;
        padding-bottom: 3rem;
    }
    .detail-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        padding: 1.4rem;
    }
    .d-label { font-size: 0.68rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: var(--gray); margin-bottom: 0.18rem; }
    .d-val   { font-weight: 600; color: var(--navy); font-size: 0.88rem; }
    .status-card {
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
        position: sticky;
        top: 80px;
    }
    .status-card-head {
        background: var(--navy);
        padding: 1.1rem 1.4rem;
        color: white;
    }
    .status-card-body { padding: 1.4rem; }
    .status-select {
        width: 100%;
        padding: 0.65rem 0.88rem;
        font-size: 0.88rem;
        color: var(--navy);
        border: 1.5px solid var(--border);
        border-radius: 6px;
        background: white;
        outline: none;
        cursor: pointer;
        transition: border-color 0.2s;
        font-family: inherit;
        margin-bottom: 1.1rem;
    }
    .status-select:focus { border-color: var(--red); }
    .status-guide { background: #f8fafc; border-radius: 6px; padding: 1rem; margin-top: 1.2rem; }
    .sg-row { display: flex; align-items: center; gap: 0.5rem; font-size: 0.77rem; color: var(--gray); margin-bottom: 0.4rem; }
    .sg-row:last-child { margin-bottom: 0; }
    @media (max-width: 860px) {
        .order-layout { grid-template-columns: 1fr; }
        .status-card { position: static; }
    }
    @media (max-width: 560px) {
        .detail-grid-2 { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <div class="section-label" style="color:var(--gold);">Admin Panel</div>
        <h1 class="section-title" style="color:white;">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h1>
    </div>
</div>

<div class="container">
    <div style="padding-top:1.5rem;margin-bottom:0.8rem;">
        <a href="{{ route('admin.orders.index') }}" style="font-size:0.83rem;color:var(--gray);font-weight:500;">&larr; All Orders</a>
    </div>

    <div class="order-layout">

        <div>
            <!-- Customer Details -->
            <div class="admin-card" style="margin-bottom:1.2rem;">
                <div class="admin-card-header">
                    <h6>Customer Details</h6>
                    @if($order->status === 'confirmed')
                        <span class="badge badge-confirmed">Confirmed</span>
                    @elseif($order->status === 'cancelled')
                        <span class="badge badge-cancelled">Cancelled</span>
                    @else
                        <span class="badge badge-pending">Pending</span>
                    @endif
                </div>
                <div class="detail-grid-2">
                    <div>
                        <div class="d-label">Customer Name</div>
                        <div class="d-val">{{ $order->customer_name }}</div>
                    </div>
                    <div>
                        <div class="d-label">Email</div>
                        <div class="d-val">{{ $order->user->email }}</div>
                    </div>
                    <div>
                        <div class="d-label">Phone</div>
                        <div class="d-val">{{ $order->customer_phone }}</div>
                    </div>
                    <div>
                        <div class="d-label">Travel Date</div>
                        <div class="d-val">{{ \Carbon\Carbon::parse($order->travel_date)->format('d F Y') }}</div>
                    </div>
                    <div>
                        <div class="d-label">Booking Date</div>
                        <div class="d-val">{{ $order->created_at->format('d F Y, H:i') }}</div>
                    </div>
                    <div>
                        <div class="d-label">Total</div>
                        <div style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:800;color:var(--red);">
                            ${{ number_format($order->total_price, 2) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tours Booked -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h6>Tours Booked</h6>
                </div>
                <div class="table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Tour</th>
                                <th>City</th>
                                <th>Price (at booking)</th>
                                <th>Travelers</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td style="font-weight:600;color:var(--navy);">{{ $item->product->title }}</td>
                                <td>
                                    <span style="background:rgba(192,57,43,0.08);color:var(--red);font-size:0.73rem;font-weight:600;padding:0.2rem 0.65rem;border-radius:50px;">
                                        {{ $item->product->category->name ?? '—' }}
                                    </span>
                                </td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td style="font-weight:700;color:var(--red);font-family:'Playfair Display',serif;">${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background:#f8fafc;">
                                <td colspan="4" style="padding:0.95rem 1.1rem;font-weight:700;text-align:right;">Grand Total</td>
                                <td style="font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:800;color:var(--red);padding:0.95rem 1.1rem;">
                                    ${{ number_format($order->total_price, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Status Update -->
        <div>
            <div class="status-card">
                <div class="status-card-head">
                    <div style="font-family:'Playfair Display',serif;font-weight:600;font-size:0.97rem;">Update Status</div>
                    <div style="font-size:0.76rem;opacity:0.58;margin-top:0.15rem;">Change booking status</div>
                </div>
                <div class="status-card-body">
                    <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                        @csrf
                        @method('PATCH')
                        <label style="display:block;font-size:0.7rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--gray);margin-bottom:0.4rem;">New Status</label>
                        <select name="status" class="status-select">
                            <option value="pending"   {{ $order->status === 'pending'   ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-block">Update Status</button>
                    </form>

                    <div class="status-guide">
                        <p style="font-size:0.73rem;font-weight:600;color:var(--navy);margin-bottom:0.6rem;">Status Guide</p>
                        <div class="sg-row"><span class="badge badge-pending">Pending</span> Awaiting review</div>
                        <div class="sg-row"><span class="badge badge-confirmed">Confirmed</span> Payment received</div>
                        <div class="sg-row"><span class="badge badge-cancelled">Cancelled</span> Booking cancelled</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
