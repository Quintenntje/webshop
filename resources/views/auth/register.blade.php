<x-layout>
	<section class="container container--xs auth__container">
		<h1 class="auth__title center-content">{{ __('auth.create_account') }}</h1>
		<p class="auth__subtitle center-content">{{ __('auth.join_coolkicks') }}</p>

		<form class="auth__form" action="{{ route('register.submit') }}" method="POST">
			@csrf
			<x-input color="transparent" type="text" name="first_name" placeholder="{{ __('auth.first_name') }}" required />
			@error('first_name')
				<p class="auth__error">{{ $message }}</p>
			@enderror
			
			<x-input color="transparent" type="text" name="last_name" placeholder="{{ __('auth.last_name') }}" required />
			@error('last_name')
				<p class="auth__error">{{ $message }}</p>
			@enderror

			<x-input color="transparent" type="email" name="email" placeholder="{{ __('auth.email') }}" required />
			@error('email')
				<p class="auth__error">{{ $message }}</p>
			@enderror

			<x-input color="transparent" type="password" name="password" placeholder="{{ __('auth.password') }}" required />
			@error('password')
				<p class="auth__error">{{ $message }}</p>
			@enderror

			<x-input color="transparent" type="password" name="password_confirmation" placeholder="{{ __('auth.confirm_password') }}" required />
			@error('password_confirmation')
				<p class="auth__error">{{ $message }}</p>
			@enderror

			<x-button type="submit" color="primary" size="md">{{ __('auth.create_account_button') }}</x-button>
			<div class="auth__register">
				<p class="auth__register__text">{{ __('auth.already_have_account') }}</p>
				<x-link href="/{{ app()->getLocale() }}/login" color="transparent" size="md">{{ __('auth.login') }}</x-link>
			</div>
		</form>
	</section>
</x-layout>


