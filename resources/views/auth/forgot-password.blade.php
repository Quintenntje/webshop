<x-layout>
	<section class="container container--xs auth__container">
		<h1 class="auth__title center-content">Forgot password</h1>
		<p class="auth__subtitle center-content">Enter your email to receive reset instructions.</p>

        @if(session('success'))
            <p class="auth__success">{{ str_starts_with(session('success'), 'messages.') ? __(session('success')) : session('success') }}</p>
       
        @else
		@if(session('error'))
		<p class="auth__error">{{ str_starts_with(session('error'), 'messages.') ? __(session('error')) : session('error') }}</p>
	@endif
		<form class="auth__form" action="{{ route('forgot-password.submit') }}" method="POST">
			@csrf
			<x-input color="transparent" type="email" name="email" placeholder="Email" required />
			@error('email')
				<p class="auth__error">{{ $message }}</p>
			@enderror

			<x-button type="submit" color="primary" size="md">Send reset link</x-button>
			<div class="auth__register">
				<p class="auth__register__text">Remembered your password?</p>
				<x-link href="{{ route('login') }}" color="transparent" size="md">Back to login</x-link>
			</div>
		</form>
        @endif
	</section>
</x-layout>


