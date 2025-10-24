@extends('emails.layout')

@section('title', $subjectLine ?? config('app.name') . ' Newsletter')
@section('brand', config('app.name'))

@section('preheader')
  Stay updated with the latest products and offers.
@endsection

@section('content')
  <h1 style="margin:0 0 12px 0; font-size:22px; line-height:1.3;">{{ $subjectLine }}</h1>
  <div style="font-size:16px; line-height:1.6;">
    {!! nl2br(e($content)) !!}
  </div>
@endsection

@section('action')
  @isset($ctaUrl)
    <a href="{{ $ctaUrl }}" class="btn">{{ $ctaText ?? 'View Now' }}</a>
  @endisset
@endsection

@section('footer')
  You’re receiving this email because you subscribed to updates from {{ config('app.name') }}.
@endsection

@section('unsubscribe')
  <a href="{{ route('newsletter.unsubscribe', $email) }}" style="text-decoration:underline;">Unsubscribe</a>
@endsection
