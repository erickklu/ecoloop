@extends("layouts.app")

@section('styles')
<style>
    .product-detail-container {
        display: flex;
        align-items: flex-start;
        gap: 150px;
        margin-top: 20px;
        padding: 0;
        box-sizing: border-box;
    }

    .product-image img {
        width: 100%;
        max-width: 640px;
        height: auto;
        max-height: 630px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .product-details {
        flex: 1;

        box-sizing: border-box;
        display: flex;
        flex-direction: column;
    }

    .product-details p {
        margin-top: 0;
        margin-bottom: 24px;
    }

    .product-title {
        font-size: 64px;
        margin-bottom: 24px;
        margin-top: 0;
        font-weight: bold;
    }

    .product-user {
        font-size: 24px;
        color: #828282;
        font-weight: 400;
    }

    .product-price {
        font-size: 1.5em;
        color: #28a745;
        margin-bottom: 20px;
    }

    .product-description {
        font-size: 20px;
        color: black;
        line-height: 1.5;
        font-weight: 500;
    }



    .btn {
        padding: 10px 20px;
        font-size: 1em;
        color: #fff;
        background-color: #FEC868;
        border-radius: 4px;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s;
        width: 100%;
        box-sizing: border-box;
        height: 52px;
        line-height: 32px;
    }

    .btn:hover {
        background-color: #F2BF63;
    }
</style>
@endsection

@section("content")
<div class="product-detail-container">

    <div class="product-details">
        <h1 class="product-title">About</h1>
        <p class="product-user">Subheading for description or instructions</p>
        <p class="product-description">Body text for your whole article or post. We’ll put in some lorem ipsum to show
            how a filled-out page might look:

            Excepteur efficient emerging, minim veniam anim aute carefully curated Ginza conversation exquisite perfect
            nostrud nisi intricate Content. Qui international first-class nulla ut. Punctual adipisicing, essential
            lovely queen tempor eiusmod irure. Exclusive izakaya charming Scandinavian impeccable aute quality of life
            soft power pariatur Melbourne occaecat discerning. Qui wardrobe aliquip, et Porter destination Toto
            remarkable officia Helsinki excepteur Basset hound. Zürich sleepy perfect consectetur.</p>

    </div>
    <div class="product-image">
        <img style="width:500px;" src="{{ asset('storage/Jardin-Botanico-3.jpg') }}" alt="Jardín Botánico">

    </div>
</div>
@endsection