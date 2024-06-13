@extends("layouts.app")
@section('title', 'Publicaciones')

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