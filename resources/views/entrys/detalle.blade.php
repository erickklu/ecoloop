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
        /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
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
        font-size: 40px;
        margin-bottom: 24px;
        margin-top: 0;
        font-weight: 600;
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
        color: #828282;
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

    .related-title {
        font-size: 20px;
        margin-top: 24px;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .related-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .related-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: calc(25% - 20px);
        /* Cuatro tarjetas por fila */
        box-sizing: border-box;
        overflow: hidden;
    }

    .related-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
    }

    .related-content {
        padding: 10px;
        padding-top: 0;
    }

    .relacion-title {
        font-size: 24px;
        margin: 0 0 24px;
        margin-top: 80px;
    }

    .related-category {
        font-size: 14px;
        color: #828282;
        font-weight: 500;
        margin-top: 0;
    }

    a {
        text-decoration: none;
        color: inherit;
    }
</style>
@endsection

@section("content")
<div class="product-detail-container">
    <div class="product-image">
        <img style="width:625px;" src="{{ Voyager::image($publicacion->image) }}" class="card-img-top" alt="...">
    </div>
    <div class="product-details">
        <h1 class="product-title">{{ $publicacion->title }}</h1>
        <p class="product-user">Por {{ $publicacion->user->name }}</p>
        <p class="product-description">{!! nl2br(strip_tags($publicacion->description)) !!}</p>
        <a href="{{ route('publicaciones') }}" class="btn btn-primary">Agregar al carrito</a>
    </div>
</div>

<p class="relacion-title">Publicaciones Relacionadas</p>
<div class="related-container">
    @foreach($relacionadas as $relacionada)
        <div class="related-card">
            <a href="{{ route('publicaciones.detalle', $relacionada->id) }}">
                <img src="{{ Voyager::image($relacionada->image) }}" alt="{{ $relacionada->title }}">
                <div class="related-content">
                    <p class="related-title">{{ $relacionada->title }}</p>
                    <p class="related-category">{{ $relacionada->category->name }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection