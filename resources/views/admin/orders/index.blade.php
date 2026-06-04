@extends('layouts.app')
@section('title', 'All Orders — Admin')

@section('content')

<div class="page-header">
    <div class="container">
        <div class="section-label" style="color:var(--gold);">Admin Panel</div>
        <h1 class="section-title" style="color:white;">All Orders</h1>
        <p style="color:rgba(255,255,255,0.58);margin-top:0.4rem;font-size:0.88rem;">{{ $orders->count() }} total booking(s)</p>
    </div>
</div>

<div class="container" style="padding-top:2.5rem;padding-bottom:3rem;">

    <div style="margin-bottom:1rem;">
        <a href="{{ route('admin.home') }}" style="font-size:0.83rem;color:var(--gray);font-weight:500;">&larr; Dashboard</a>
    </div>

    @if($orders->isEmpty())
        <div class="admin-card" style="padding:3rem;text-align:center;color:var(--gray);font-size:0.9rem;">
            No orders have been placed yet.
        </div>
    @else
        <div class="admin-card">
            <div class="table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Travel Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td style="font-family:monospace;color:var(--gray);font-size:0.8rem;">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div style="font-weight:600;color:var(--navy);">{{ $order->customer_name }}</div>
                                <div style="font-size:0.74rem;color:var(--gray);">{{ $order->user->email }}</div>
                            </td>
                            <td style="color:var(--gray);font-size:0.84rem;">{{ $order->customer_phone }}</td>
                            <td style="font-size:0.84rem;">{{ \Carbon\Carbon::parse($order->travel_date)->format('d M Y') }}</td>
                            <td style="font-weight:700;color:var(--red);font-family:'Playfair Display',serif;">${{ number_format($order->total_price, 2) }}</td>
                            <td>
                                @if($order->status === 'confirmed')
                                    <span class="badge badge-confirmed">&#10003; Confirmed</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge badge-cancelled">&#10005; Cancelled</span>
                                @else
                                    <span class="badge badge-pending">&#8987; Pending</span>
                                @endif
                            </td>
                            <td style="color:var(--gray);font-size:0.8rem;">{{ $order->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-edit-sm">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
