<x-layout>
	<section class="container container--xs auth__container">
		<h1 class="auth__title center-content">Create account</h1>
		<p class="auth__subtitle center-content">Join CoolKicks to track orders and get member perks.</p>

		<form class="auth__form" action="{{ route('register') }}" method="POST">
			@csrf
			<x-input color="transparent" type="text" name="first_name" placeholder="First name" required />
			@error('first_name')
				<p class="auth__error">{{ $message }}</p>
			@enderror
			
			<x-input color="transparent" type="text" name="last_name" placeholder="Last name" required />
			@error('last_name')
				<p class="auth__error">{{ $message }}</p>
			@enderror

			<x-input color="transparent" type="email" name="email" placeholder="Email" required />
			@error('email')
				<p class="auth__error">{{ $message }}</p>
			@enderror

			<x-input color="transparent" type="password" name="password" placeholder="Password" required />
			@error('password')
				<p class="auth__error">{{ $message }}</p>
			@enderror

			<x-input color="transparent" type="password" name="password_confirmation" placeholder="Confirm password" required />
			@error('password_confirmation')
				<p class="auth__error">{{ $message }}</p>
			@enderror

			<x-button type="submit" color="primary" size="md">Create account</x-button>
			<div class="auth__register">
				<p class="auth__register__text">Already have an account?</p>
				<x-link href="/login" color="transparent" size="md">Login</x-link>
			</div>
		</form>
	</section>
</x-layout>


