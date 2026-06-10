@extends('layouts.app')
@section('title', 'Order Confirmed — TechShop')

@section('content')

<div class="container">
  <div class="conf">

    <div class="conf-ico">
      <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
    </div>

    <h1>Order Placed!</h1>
    <p style="font-size:1.05rem;margin-bottom:6px">
      Thank you, <strong style="color:var(--tx)">{{ $order->customer_name }}</strong>!
    </p>
    <p>Your order <strong style="color:var(--p)">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong> has been received and is being processed.</p>

    <div class="conf-order">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;padding-bottom:16px;border-bottom:1px solid var(--bd)">
        <div>
          <div style="font-size:.72rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:4px">Order Reference</div>
          <div style="font-size:1.2rem;font-weight:800;color:var(--tx)">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
        </div>
        <span class="badge badge-pend">Pending</span>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px">
        @foreach([
          ['label'=>'Customer','value'=>$order->customer_name],
          ['label'=>'Phone','value'=>$order->customer_phone],
          ['label'=>'Delivery Date','value'=>\Carbon\Carbon::parse($order->delivery_date)->format('d F Y')],
          ['label'=>'Order Date','value'=>$order->created_at->format('d F Y')],
        ] as $r)
          <div>
            <div style="font-size:.72rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.05em;margin-bottom:3px">{{ $r['label'] }}</div>
            <div style="font-weight:600;font-size:.9375rem">{{ $r['value'] }}</div>
          </div>
        @endforeach
      </div>

      @if($order->shipping_address)
        <div style="margin-bottom:18px;padding:12px 14px;background:var(--sf2);border-radius:var(--r2)">
          <div style="font-size:.72rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px">Shipping Address</div>
          <div style="font-weight:500;font-size:.9375rem">{{ $order->shipping_address }}</div>
        </div>
      @endif

      <hr class="divider">

      <h4 style="margin-bottom:12px">Items Ordered</h4>
      @foreach($order->orderItems as $item)
        <div class="conf-row">
          <div>
            <div style="font-weight:600;font-size:.9375rem">{{ $item->product->title }}</div>
            <div style="font-size:.8rem;color:var(--tx3);margin-top:2px">{{ $item->quantity }} &times; ${{ number_format($item->price, 2) }}</div>
          </div>
          <div style="font-weight:700;color:var(--p)">${{ number_format($item->price * $item->quantity, 2) }}</div>
        </div>
      @endforeach

      <div style="display:flex;justify-content:space-between;align-items:center;margin-top:14px;padding-top:14px;border-top:2px solid var(--bd)">
        <span style="font-weight:700;font-size:1rem">Total Paid</span>
        <span style="font-size:1.6rem;font-weight:900;color:var(--p)">${{ number_format($order->total_price, 2) }}</span>
      </div>
    </div>

    {{-- What's next --}}
    <div style="background:var(--ok-bg);border:1px solid rgba(16,185,129,.2);border-radius:var(--r4);padding:24px;text-align:left;margin-bottom:28px">
      <h4 style="color:var(--ok);margin-bottom:16px">What Happens Next?</h4>
      @foreach([
        'Our team reviews your order within 24 hours.',
        'We contact you at <strong>'.e($order->customer_phone).'</strong> to confirm and arrange payment.',
        'Your order ships on or before <strong>'.\Carbon\Carbon::parse($order->delivery_date)->format('d F Y').'</strong>.',
        'Track your delivery with the tracking number we send you.',
      ] as $i => $step)
        <div style="display:flex;align-items:flex-start;gap:12px;margin-bottom:{{ $loop->last ? '0' : '12px' }}">
          <div style="width:26px;height:26px;border-radius:50%;background:rgba(16,185,129,.2);color:var(--ok);font-size:.75rem;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px">{{ $i+1 }}</div>
          <p style="font-size:.9rem;color:var(--ok);line-height:1.6;margin:0">{!! $step !!}</p>
        </div>
      @endforeach
    </div>

    <div style="display:flex;gap:12px;flex-wrap:wrap;justify-content:center">
      <a href="{{ route('orders.index') }}" class="btn btn-p btn-lg">View My Orders</a>
      <a href="{{ route('products') }}" class="btn btn-o btn-lg">Continue Shopping</a>
    </div>

  </div>
</div>

@endsection
