@extends('layouts.app')
@section('title', 'Manage Tours — Admin')

@section('content')

<div class="page-header">
    <div class="container">
        <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:1rem;">
            <div>
                <div class="section-label" style="color:var(--gold);">Admin Panel</div>
                <h1 class="section-title" style="color:white;">Manage Tours</h1>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add New Tour</a>
        </div>
    </div>
</div>

<div class="container" style="padding-top:2.5rem;padding-bottom:3rem;">

    <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1rem;flex-wrap:wrap;">
        <a href="{{ route('admin.home') }}" style="font-size:0.83rem;color:var(--gray);font-weight:500;">&larr; Dashboard</a>
        <span style="color:var(--border);">|</span>
        <span style="font-size:0.83rem;color:var(--gray);">{{ $products->count() }} tours total</span>
    </div>

    @if($products->isEmpty())
        <div class="admin-card" style="padding:3rem;text-align:center;">
            <p style="color:var(--gray);font-size:0.9rem;">No tours yet. <a href="{{ route('admin.products.create') }}" style="color:var(--red);font-weight:600;">Add the first tour!</a></p>
        </div>
    @else
        <div class="admin-card">
            <div class="table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Tour</th>
                            <th>City</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:0.8rem;">
                                    @if($product->image)
                                        <img src="{{ $product->image }}" class="thumb" alt="{{ $product->title }}">
                                    @else
                                        <div class="thumb-ph">&#128247;</div>
                                    @endif
                                    <span style="font-weight:600;color:var(--navy);">{{ $product->title }}</span>
                                </div>
                            </td>
                            <td>
                                <span style="background:rgba(192,57,43,0.08);color:var(--red);font-size:0.73rem;font-weight:600;padding:0.2rem 0.65rem;border-radius:50px;">
                                    {{ $product->category->name }}
                                </span>
                            </td>
                            <td style="font-weight:700;color:var(--red);">${{ number_format($product->price, 2) }}</td>
                            <td style="color:var(--gray);">{{ $product->duration_days }} day(s)</td>
                            <td>
                                @if($product->is_available)
                                    <span style="background:#d1fae5;color:#065f46;font-size:0.72rem;font-weight:600;padding:0.2rem 0.65rem;border-radius:50px;">Available</span>
                                @else
                                    <span style="background:#fee2e2;color:#991b1b;font-size:0.72rem;font-weight:600;padding:0.2rem 0.65rem;border-radius:50px;">Unavailable</span>
                                @endif
                            </td>
                            <td>
                                <div style="display:flex;gap:0.4rem;">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit-sm">Edit</a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display:inline;" onsubmit="return confirm('Delete this tour?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-del-sm">Delete</button>
                                    </form>
                                </div>
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
