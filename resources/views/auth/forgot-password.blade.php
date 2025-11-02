@php
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
@endphp

<x-layout>
	<section class="container container--xs auth__container">
		<h1 class="auth__title center-content">{{ __('auth.forgot_password_title') }}</h1>
		<p class="auth__subtitle center-content">{{ __('auth.forgot_password_subtitle') }}</p>

        @if(session('success'))
            <p class="auth__success">{{ str_starts_with(session('success'), 'messages.') ? __(session('success')) : session('success') }}</p>
        @else
		@if(session('error'))
		<p class="auth__error">{{ str_starts_with(session('error'), 'messages.') ? __(session('error')) : session('error') }}</p>
	@endif
		<form class="auth__form" action="{{ route('forgot-password.submit') }}" method="POST">
			@csrf
			<x-input color="transparent" type="email" name="email" placeholder="{{ __('auth.email') }}" required />
			@error('email')
				<p class="auth__error">{{ str_starts_with($message, 'messages.') ? __($message) : $message }}</p>
			@enderror

			<x-button type="submit" color="primary" size="md">{{ __('auth.send_reset_link') }}</x-button>
			<div class="auth__register">
				<p class="auth__register__text">{{ __('auth.remembered_password') }}</p>
				<x-link href="{{ LaravelLocalization::getLocalizedURL(null, '/login') }}" color="transparent" size="md">{{ __('auth.back_to_login') }}</x-link>
			</div>
		</form>
        @endif
	</section>
</x-layout>


