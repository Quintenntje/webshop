<x-layout>
    <section class="container container--xs auth__container">
		<h1 class="auth__title center-content">Login</h1>
		<p class="auth__subtitle center-content">Welcome back! Please sign in to continue.</p>

		<form class="auth__form" action="{{ route('login') }}" method="POST">
            @csrf
			<x-input color="transparent" type="email" name="email" placeholder="Email" required />
			<x-input color="transparent" type="password" name="password" placeholder="Password" required />
			<x-button type="submit" color="primary" size="md">Login</x-button>
			<div class="auth__register">
				<p class="auth__register__text">Don't have an account?</p>
				<x-link href="/register" color="transparent" size="md">Register</x-link>
			</div>
        </form>
    </section>
</x-layout>