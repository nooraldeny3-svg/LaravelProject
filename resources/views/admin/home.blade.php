@extends('layouts.app')
@section('title', 'Admin Dashboard — TurkeyTours')

@section('styles')
<style>
    .admin-hero {
        background: var(--navy);
        padding: 5rem 0 2.5rem;
    }
    .admin-hero-inner {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.2rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        border: 1px solid var(--border);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 6px 18px rgba(0,0,0,0.09); }
    .stat-icon {
        width: 50px; height: 50px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 1rem;
        font-weight: 700;
    }
    .stat-num {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--navy);
        line-height: 1;
    }
    .stat-lbl {
        font-size: 0.77rem;
        font-weight: 600;
        color: var(--gray);
        margin-top: 0.28rem;
    }
    .stat-link {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 600;
        margin-top: 0.9rem;
        color: var(--gray);
        transition: color 0.2s;
    }
    .stat-link:hover { color: var(--red); }
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 1.4rem;
    }
    .quick-actions {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        padding: 1rem;
    }
    .qa-btn {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        padding: 0.85rem 1rem;
        border-radius: 6px;
        border: 1px solid var(--border);
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--navy);
        transition: border-color 0.2s, color 0.2s, background 0.2s;
    }
    .qa-btn:hover { border-color: var(--red); color: var(--red); background: rgba(192,57,43,0.03); }
    .qa-icon {
        width: 34px; height: 34px;
        border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.92rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    @media (max-width: 900px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .dashboard-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 480px) {
        .stats-grid { grid-template-columns: 1fr 1fr; }
    }
</style>
@endsection

@section('content')

<div class="admin-hero">
    <div class="container">
        <div class="admin-hero-inner">
            <div>
                <div class="section-label" style="color:var(--gold);">Control Center</div>
                <h1 class="section-title" style="color:white;">Dashboard</h1>
                <p style="color:rgba(255,255,255,0.58);margin-top:0.4rem;font-size:0.88rem;">
                    Welcome back, <strong style="color:#fbbf24;">{{ auth()->user()->name }}</strong>
                </p>
            </div>
            <a href="{{ route('home') }}" target="_blank" class="btn btn-light" style="font-size:0.83rem;">
                &#128065; View Public Site
            </a>
        </div>
    </div>
</div>

<div class="container" style="padding-top:2.5rem;padding-bottom:3rem;">

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(192,57,43,0.08);color:var(--red);">&#128506;</div>
            <div class="stat-num">{{ $totalTours }}</div>
            <div class="stat-lbl">Total Tours</div>
            <a href="{{ route('admin.products.index') }}" class="stat-link">Manage &rarr;</a>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(99,102,241,0.08);color:#6366f1;">&#127963;</div>
            <div class="stat-num" style="color:#6366f1;">{{ $totalCategories }}</div>
            <div class="stat-lbl">Cities</div>
            <a href="{{ route('admin.categories.index') }}" class="stat-link">Manage &rarr;</a>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(217,119,6,0.08);color:var(--gold);">&#128717;</div>
            <div class="stat-num" style="color:var(--gold);">{{ $totalOrders }}</div>
            <div class="stat-lbl">Total Orders</div>
            <a href="{{ route('admin.orders.index') }}" class="stat-link">View all &rarr;</a>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(16,185,129,0.08);color:#10b981;">$</div>
            <div class="stat-num" style="color:#10b981;">${{ number_format($totalRevenue, 0) }}</div>
            <div class="stat-lbl">Revenue (Confirmed)</div>
            <span class="stat-link" style="cursor:default;">Confirmed orders only</span>
        </div>
    </div>

    <div class="dashboard-grid">

        <!-- Recent Orders -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h6>Recent Orders</h6>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-light btn-sm">View All &rarr;</a>
            </div>
            @if($recentOrders->isEmpty())
                <div style="padding:3rem;text-align:center;color:var(--gray);font-size:0.88rem;">No orders yet.</div>
            @else
                <div class="table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Travel Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                            <tr>
                                <td style="color:var(--gray);font-family:monospace;font-size:0.8rem;">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <div style="font-weight:600;color:var(--navy);font-size:0.875rem;">{{ $order->customer_name }}</div>
                                    <div style="font-size:0.74rem;color:var(--gray);">{{ $order->user->email }}</div>
                                </td>
                                <td style="font-size:0.84rem;">{{ \Carbon\Carbon::parse($order->travel_date)->format('d M Y') }}</td>
                                <td style="font-weight:700;color:var(--red);font-family:'Playfair Display',serif;">${{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    @if($order->status === 'confirmed')
                                        <span class="badge badge-confirmed">Confirmed</span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="badge badge-cancelled">Cancelled</span>
                                    @else
                                        <span class="badge badge-pending">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-edit-sm">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h6>Quick Actions</h6>
            </div>
            <div class="quick-actions">
                <a href="{{ route('admin.products.create') }}" class="qa-btn">
                    <div class="qa-icon" style="background:rgba(192,57,43,0.08);color:var(--red);">+</div>
                    Add New Tour
                </a>
                <a href="{{ route('admin.categories.create') }}" class="qa-btn">
                    <div class="qa-icon" style="background:rgba(99,102,241,0.08);color:#6366f1;">+</div>
                    Add New City
                </a>
                <a href="{{ route('admin.products.index') }}" class="qa-btn">
                    <div class="qa-icon" style="background:rgba(217,119,6,0.08);color:var(--gold);">&#128506;</div>
                    Manage Tours
                </a>
                <a href="{{ route('admin.categories.index') }}" class="qa-btn">
                    <div class="qa-icon" style="background:rgba(16,185,129,0.08);color:#10b981;">&#127963;</div>
                    Manage Cities
                </a>
                <a href="{{ route('admin.orders.index') }}" class="qa-btn">
                    <div class="qa-icon" style="background:rgba(239,68,68,0.08);color:#ef4444;">&#128717;</div>
                    All Orders
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
