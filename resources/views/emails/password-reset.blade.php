@extends('emails.layout')

@section('title', 'Reset your password')
@section('brand', config('app.name'))

@section('preheader')
  Use the link below to reset your password.
@endsection

@section('content')
  <p style="margin:0 0 12px 0; font-size:16px; line-height:1.6;">We received a request to reset your password.</p>
  <p style="margin:0 0 12px 0; font-size:16px; line-height:1.6;">Your reset code:</p>
  <p class="bold-text" style="font-size:20px; margin:0 0 16px 0;">{{ $code }}</p>
  <p style="margin:0 0 16px 0; font-size:16px; line-height:1.6;">Click the button below or use the code on the reset page.</p>
@endsection

@section('action')
  <a href="{{ $resetUrl }}" class="btn">Reset password</a>
@endsection

@section('footer')
  If you didn’t request a password reset, you can safely ignore this email.
@endsection


