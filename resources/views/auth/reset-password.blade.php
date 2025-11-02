<x-layout>
	<section class="container container--xs auth__container">
		<h1 class="auth__title center-content">{{ __('auth.reset_password_title') }}</h1>
		<p class="auth__subtitle center-content">{{ __('auth.reset_password_subtitle') }}</p>

		<form class="auth__form" action="{{ route('reset-password.submit') }}" method="POST">
			@csrf
			<input type="hidden" name="token" value="{{ $token ?? '' }}" />
			<x-input color="transparent" type="password" name="password" placeholder="{{ __('auth.new_password') }}" required />
			@error('password')
				<p class="auth__error">{{ str_starts_with($message, 'messages.') ? __($message) : $message }}</p>
			@enderror

			<x-input color="transparent" type="password" name="password_confirmation" placeholder="{{ __('auth.confirm_password') }}" required />
			@error('password_confirmation')
				<p class="auth__error">{{ str_starts_with($message, 'messages.') ? __($message) : $message }}</p>
			@enderror

			<x-button type="submit" color="primary" size="md">{{ __('auth.reset_password_button') }}</x-button>
		</form>
	</section>
</x-layout>


