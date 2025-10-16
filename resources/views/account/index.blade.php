<x-layout>
    <section class="container container--xs auth__container">
        <h1 class="auth__title center-content">Account</h1>
        <p class="auth__subtitle center-content">Welcome back! Please sign in to continue.</p>
        <p class="auth__subtitle center-content">{{ $user->first_name }} {{ $user->last_name }}</p>
        <p class="auth__subtitle center-content">{{ $user->email }}</p>
        <p class="auth__subtitle center-content">{{ $user->phone_number }}</p>
        <p class="auth__subtitle center-content">{{ $user->role_id }}</p>
        <p class="auth__subtitle center-content">{{ $user->created_at }}</p>
        <p class="auth__subtitle center-content">{{ $user->updated_at }}</p>
    </section>
</x-layout>