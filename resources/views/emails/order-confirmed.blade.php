@extends('emails.layout')

@section('title', 'Order Confirmed - Order #' . $order->id)
@section('brand', config('app.name'))

@section('preheader')
  Your order #{{ $order->id }} has been confirmed!
@endsection

@section('content')
  <div style="text-align: center; margin-bottom: 32px;">
    <h1 style="margin:0 0 8px 0; font-size:24px; line-height:1.3; font-weight:600;">Order Confirmed!</h1>
    <p style="margin:0 0 16px 0; font-size:16px; line-height:1.6; color:#6b6b6b;">Thank you for your purchase. Your order has been successfully placed.</p>
    <div style="display: inline-block; background: #f6f6f6; padding: 8px 16px; border-radius: 6px;">
      <p style="margin:0; font-size:14px; line-height:1.5; color:#232323; font-weight:600;">Order Number: #{{ $order->id }}</p>
    </div>
  </div>

  <div style="background:#f6f6f6; border-radius:8px; padding:20px; margin-bottom:24px;">
    <h2 style="margin:0 0 20px 0; font-size:18px; line-height:1.3; font-weight:600; color:#232323;">Order Details</h2>
    
    @foreach($order->items as $item)
      <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:16px; padding-bottom:16px; border-bottom:1px solid #e6e6e6;">
        <tr>
          <td width="80" valign="top" style="padding-right:12px;">
            @if($item->productVariant->product->primaryImage)
              <img src="{{ $item->productVariant->product->primaryImage->filename }}" alt="{{ $item->productVariant->product->name }}" width="80" height="80" style="width:80px; height:80px; object-fit:cover; border-radius:6px; display:block; border:1px solid #e6e6e6;">
            @else
              <div style="width:80px; height:80px; background:#e6e6e6; border-radius:6px; display:block;"></div>
            @endif
          </td>
          <td valign="top">
            <h3 style="margin:0 0 6px 0; font-size:16px; line-height:1.4; font-weight:600; color:#232323;">{{ $item->productVariant->product->name }}</h3>
            <p style="margin:0 0 4px 0; font-size:14px; line-height:1.5; color:#6b6b6b;">
              Color: {{ $item->productVariant->color->name }} | 
              Size: {{ $item->productVariant->size->name }} | 
              Quantity: {{ $item->quantity }}
            </p>
            <p style="margin:0; font-size:16px; line-height:1.5; font-weight:600; color:#232323;">€{{ number_format($item->price * $item->quantity, 2) }}</p>
          </td>
        </tr>
      </table>
    @endforeach

    <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:16px; padding-top:16px; border-top:2px solid #e6e6e6;">
      <tr>
        <td align="right" style="padding-right:12px;">
          <p style="margin:0; font-size:16px; line-height:1.5; font-weight:600; color:#232323;">Total:</p>
        </td>
        <td align="right" width="100">
          <p style="margin:0; font-size:20px; line-height:1.5; font-weight:700; color:#232323;">€{{ number_format($order->total_price, 2) }}</p>
        </td>
      </tr>
    </table>
  </div>

  <div style="background:#f6f6f6; border-radius:8px; padding:20px; margin-bottom:24px;">
    <h2 style="margin:0 0 16px 0; font-size:18px; line-height:1.3; font-weight:600; color:#232323;">Shipping Address</h2>
    <div style="font-size:14px; line-height:1.8; color:#6b6b6b;">
      @if($order->customer)
        <p style="margin:0 0 4px 0;">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>
      @endif
      <p style="margin:0 0 4px 0;">{{ $order->street }}</p>
      <p style="margin:0 0 4px 0;">{{ $order->postal_code }} {{ $order->city }}</p>
      <p style="margin:0;">{{ $order->country }}</p>
    </div>
  </div>

  <p style="margin:0 0 16px 0; font-size:16px; line-height:1.6; color:#232323;">We'll send you a shipping confirmation email once your order has been dispatched.</p>
@endsection

@section('action')
  <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td align="center" style="padding: 0;">
        <table cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <a href="{{ url('/shop') }}" class="btn" style="margin-right:12px; display:inline-block;">Continue Shopping</a>
            </td>
            @if($order->customer)
            <td>
              <a href="{{ url('/account') }}" class="btn" style="background:#6b6b6b; display:inline-block;">View My Account</a>
            </td>
            @endif
          </tr>
        </table>
      </td>
    </tr>
  </table>
@endsection

@section('footer')
  If you have any questions about your order, please contact our customer service team.
@endsection

