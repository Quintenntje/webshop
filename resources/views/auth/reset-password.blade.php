<x-layout>
	<section class="container container--xs auth__container">
		<h1 class="auth__title center-content">Reset password</h1>
		<p class="auth__subtitle center-content">Choose a new password for your account.</p>

		<form class="auth__form" action="{{ route('password.update') }}" method="POST">
			@csrf
			<input type="hidden" name="token" value="{{ $token ?? '' }}" />
			<x-input color="transparent" type="email" name="email" placeholder="Email" required />
			@error('email')
				<p class="auth__error">{{ $message }}</p>
			@enderror

			<x-input color="transparent" type="password" name="password" placeholder="New password" required />
			@error('password')
				<p class="auth__error">{{ $message }}</p>
			@enderror

			<x-input color="transparent" type="password" name="password_confirmation" placeholder="Confirm password" required />
			@error('password_confirmation')
				<p class="auth__error">{{ $message }}</p>
			@enderror

			<x-button type="submit" color="primary" size="md">Reset password</x-button>
		</form>
	</section>
</x-layout>


