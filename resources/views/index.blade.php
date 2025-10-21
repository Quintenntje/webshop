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

    <section class="brand-section">
        <div class="container">
            <h2 class="brand-section__title">Shop by Brand</h2>
            <p class="brand-section__subtitle">Discover your favorite brands and explore their latest collections</p>
            <div class="brand-cards">
                @foreach($brands as $brand)
                    <x-brand-card :brand="$brand" />
                @endforeach
            </div>
        </div>
    </section>
</x-layout>
