<x-layout>
	<section class="container container--xs auth__container">
		<h1 class="auth__title center-content">Forgot password</h1>
		<p class="auth__subtitle center-content">Enter your email to receive reset instructions.</p>

		<form class="auth__form" action="" method="POST">
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
	</section>
</x-layout>


