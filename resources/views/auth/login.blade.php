<x-layout>
    <section class="container container--xs auth__container">
		<h1 class="auth__title center-content">{{ __('auth.login') }}</h1>
		<p class="auth__subtitle center-content">{{ __('auth.welcome_back') }}</p>

		<form class="auth__form" action="{{ route('login.submit') }}" method="POST">
            @csrf
			<x-input color="transparent" type="email" name="email" placeholder="{{ __('auth.email') }}" required />
			@error('email')
				<p class="auth__error">{{ $message }}</p>
			@enderror
			<div class="auth__forgot-password">
			<x-link color="transparent" href="{{ route('forgot-password') }}" size="md">{{ __('auth.forgot_password') }}</x-link>
			<x-input color="transparent" type="password" name="password" placeholder="{{ __('auth.password') }}" required />
		</div>
			@error('password')
				<p class="auth__error">{{ $message }}</p>
			@enderror
			@error('error')
				<p class="auth__error">{{ $message }}</p>
			@enderror
		
			<x-button type="submit" color="primary" size="md">{{ __('auth.login_button') }}</x-button>
			<div class="auth__register">
				<p class="auth__register__text">{{ __('auth.no_account') }}</p>
				<x-link href="/register" color="transparent" size="md">{{ __('auth.register') }}</x-link>
			</div>
        </form>
    </section>
</x-layout>