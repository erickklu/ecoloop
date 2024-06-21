@extends('layouts.app')
@section('title', 'Favoritos')

@section('content')
<h1 class="title-text">Mis Favoritos</h1>
@if($publicacionesFavoritas->isEmpty())
    <p>No tienes publicaciones favoritas.</p>
@else

    <div class="favorites-container">
        @foreach ($publicacionesFavoritas as $publicacion)
            <div class="publicacion-card">
                <a href="{{ route('publicaciones.detalle', $publicacion->id) }}">
                    <div class="image-container">
                        <img src="{{ Voyager::image($publicacion->image) }}" alt="...">
                        <!-- <img src="{{ url($publicacion->image) }}" alt=""> -->

                    </div>
                    <div class="publicacion-content">
                        <p class="publicacion-title">{{ $publicacion->title }}</p>
                        <!-- <p class="card-text">{!! nl2br(strip_tags($publicacion->description)) !!}</p> -->
                        <p class="publicacion-text">{{ $publicacion->category->name }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $publicacionesFavoritas->links('pagination::bootstrap-4') }}
    </div>
@endif
@endsection
<!-- <div>
    <h2>{{ $publicacion->title ?? 'Título no disponible' }}</h2>
    <p>{{ $publicacion->description ?? 'Contenido no disponible' }}</p>
</div> -->