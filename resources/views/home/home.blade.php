@extends("layouts.app")

@section("content")
<div class="home-detail-container">

    <div class="home-details">
        <h1 class="home-title">About</h1>
        <p class="home-subtitle">Subheading for description or instructions</p>
        <p class="home-description">Body text for your whole article or post. We’ll put in some lorem ipsum to show
            how a filled-out page might look:

            Excepteur efficient emerging, minim veniam anim aute carefully curated Ginza conversation exquisite perfect
            nostrud nisi intricate Content. Qui international first-class nulla ut. Punctual adipisicing, essential
            lovely queen tempor eiusmod irure. Exclusive izakaya charming Scandinavian impeccable aute quality of life
            soft power pariatur Melbourne occaecat discerning. Qui wardrobe aliquip, et Porter destination Toto
            remarkable officia Helsinki excepteur Basset hound. Zürich sleepy perfect consectetur.</p>

    </div>
    <div class="home-image">
        <img style="width:500px;" src="{{ asset('storage/Jardin-Botanico-3.jpg') }}" alt="Jardín Botánico">

    </div>
</div>
@endsection