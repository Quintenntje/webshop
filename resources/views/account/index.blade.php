<x-layout>
    <section class="container container--xs auth__container">
        <h1 class="auth__title center-content">Account</h1>
        <p class="auth__subtitle center-content">Welcome back! Please sign in to continue.</p>
        <p class="auth__subtitle center-content">{{ $user->first_name }} {{ $user->last_name }}</p>
        <p class="auth__subtitle center-content">{{ $user->email }}</p>
        <p class="auth__subtitle center-content">{{ $user->phone_number }}</p>

        @foreach ($addresses as $address)
        <p class="auth__subtitle center-content">{{ $address->address }}</p>
            <p class="auth__subtitle center-content">{{ $address->city }}</p>
            <p class="auth__subtitle center-content">{{ $address->postal_code }}</p>
            <p class="auth__subtitle center-content">{{ $address->country }}</p>
        </div>
        @endforeach

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <x-button type="submit" color="primary" size="md">Logout</x-button>
        </form>
    </section>
</x-layout>