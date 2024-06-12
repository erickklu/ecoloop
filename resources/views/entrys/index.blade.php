@extends("layouts.app")
@section('title', 'Publicaciones')

@section('styles')
<style>
    .cards-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 40px;
    }

    .publicacion-card {
        background: #fff;
        border-radius: 8px;
        /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
        flex: 1 1 calc(33.333% - 20px);
        box-sizing: border-box;
        overflow: hidden;
        min-width: 200px;
        max-width: calc(33.333% - 20px);
    }

    .image-container {
        width: 100%;
        height: 400px;
        overflow: hidden;
    }

    .publicacion-card img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        border-radius: 8px;
    }

    .card-content {
        padding: 20px;
        padding-left: 0;
        padding-right: 0;
    }

    .card-title {
        font-size: 20px;
        font-weight: 500;
        margin: 0 0 10px;
        color: #000000;
    }

    .card-text {
        color: #828282;
        font-size: 20px;
        line-height: 1.5;
        margin: 0;
        font-weight: 500;
    }

    .categories-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-bottom: 40px;
    }

    .category-card {
        width: 150px;
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #FEC868;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-size: 1.2em;
        font-weight: bold;
        color: white;
        text-align: center;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .category-icon {
        font-size: 3em;
        margin-bottom: 10px;
        color: white;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .category-card-active {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    a {
        text-decoration: none;
        color: inherit;
    }

</style>
@endsection


@section("content")
<!-- <h1>Categorias</h1> -->
<div class="categories-container">
    @foreach($categorias as $categoria) 
        <a href="{{ route('publicaciones.categoria', $categoria->id) }}"
            class="{{ isset($categoryId) && $categoryId == $categoria->id ? 'category-card-active text-light' : '' }}">
            <div class="category-card"><i class="fas fa-store category-icon"></i>{{ $categoria->name }}</div>
        </a>
    @endforeach
    <!-- <div class="category-card"><i class="fas fa-store category-icon"></i>Vender</div>
    <div class="category-card"><i class="fas fa-hand-holding-heart category-icon"></i>Donar</div>
    <div class="category-card"><i class="fas fa-exchange-alt category-icon"></i>Intercambiar</div> -->
</div>
<h1>Publicaciones</h1>
<div class="cards-container">
    @foreach ($publicaciones as $publicacion)

        <div class="publicacion-card">
            <a href="{{ route('publicaciones.detalle', $publicacion->id) }}">
                <div class="image-container">
                    <img src="{{ Voyager::image($publicacion->image) }}" class="card-img-top" alt="...">

                </div>
                <div class="card-content">
                    <p class="card-title">{{ $publicacion->title }}</p>
                    <!-- <p class="card-text">{!! nl2br(strip_tags($publicacion->description)) !!}</p> -->
                    <p class="card-text">{{ $publicacion->category->name }}</p>
                </div>
            </a>
        </div>

    @endforeach
</div>
@endsection