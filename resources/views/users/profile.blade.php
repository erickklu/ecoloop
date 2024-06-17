@extends('layouts.app')

@section('title', 'Perfil de usuario')

@section('content')
<div class="profile-container">
    <div class="user-info">
        <div class="user-details">
            <img src="{{ Voyager::image($usuario->avatar) }}" alt="">
            <p class="user-name">{{ $usuario->name }}</p>
            <p class="user-email">{{ $usuario->email }}</p>
            <div class="user-numbers">
                <div>
                    <p>{{ number_format($usuario->score(), 1) }} <i class="bi bi-star-fill"></i></p>
                </div>
                <div>
                    <p>{{ $usuario->entries()->count() }} publicaciones</p>
                </div>
            </div>

        </div>
    </div>

    <div class="user-publications">
        <h1>Publicaciones</h1>
        <div class="cards-container">
            @foreach ($publicaciones as $publicacion)
                <div class="publicacion-card">
                    <a href="{{ route('publicaciones.detalle', $publicacion->id) }}">
                        <div class="image-container">
                            <img src="{{ url($publicacion->image) }}" alt="">
                        </div>
                        <div class="publicacion-content">
                            <p class="publicacion-title">{{ $publicacion->title }}</p>
                            <p class="publicacion-text">{{ $publicacion->category->name }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="rating-form">
    <form action="{{ route('calificar', $usuario->id) }}" method="POST">
        @csrf
        <label for="rating">Califica este usuario:</label>
        <div class="rating">
            @for ($i = 5; $i >= 1; $i--)
                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} />
                <label for="star{{ $i }}" title="{{ $i }} estrellas"><i class="bi bi-star-fill"></i></label>
            @endfor
        </div>
        <button type="submit">Enviar Calificación</button>
    </form>
</div>
@endsection