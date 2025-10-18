<x-layout>
    <x-hero />
    
    <section class="container gender-section">
        <h2 class="gender-section__title">Shop by Gender</h2>
        <div class="gender-cards">
            @foreach($genders as $gender)
                <x-gender-card :gender="$gender" />
            @endforeach
        </div>
    </section>
</x-layout>
