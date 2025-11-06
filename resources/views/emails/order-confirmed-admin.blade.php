@extends('emails.layout')

@section('title', 'New Order - Order #' . $order->id)
@section('brand', config('app.name'))

@section('preheader')
  New order #{{ $order->id }} has been received and paid.
@endsection

@section('content')
  <div style="text-align: center; margin-bottom: 32px;">
    <h1 style="margin:0 0 8px 0; font-size:24px; line-height:1.3; font-weight:600;">New Order Received</h1>
    <p style="margin:0 0 16px 0; font-size:16px; line-height:1.6; color:#6b6b6b;">Order #{{ $order->id }} has been successfully paid.</p>
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

  @if($order->customer)
  <div style="background:#f6f6f6; border-radius:8px; padding:20px; margin-bottom:24px;">
    <h2 style="margin:0 0 16px 0; font-size:18px; line-height:1.3; font-weight:600; color:#232323;">Customer Information</h2>
    <div style="font-size:14px; line-height:1.8; color:#6b6b6b;">
      <p style="margin:0 0 4px 0;">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>
      <p style="margin:0;">{{ $order->customer->email ?? 'N/A' }}</p>
    </div>
  </div>
  @endif

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
@endsection

@section('footer')
  This is an automated notification for order management purposes.
@endsection

