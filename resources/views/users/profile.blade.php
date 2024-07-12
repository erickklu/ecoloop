@extends('layouts.app')

@section('title', 'Perfil de usuario')

@section('content')
<div class="profile-container">
    <meta name="success-message" content="{{ session('success') }}">
    <div class="user-info">
        <div class="user-details">
            <img src="{{ Voyager::image($usuario->avatar) }}" class="avatar"
                style="border-radius:50%; width:200px; height:200px; border:5px solid #fff;"
                alt="{{ $usuario->name }} avatar">
            <p class="user-name">{{ $usuario->name }}</p>
            <p class="user-email">{{ $usuario->email }}</p>
            <div class="user-numbers">
                <div class="score">
                    <p>{{ number_format($usuario->score(), 1) }} <i class="bi bi-star-fill"></i></p>
                    <p class="text">Puntos</p>
                </div>
                <div class="entries">
                    <p>{{ $usuario->entries()->count() }}</p>
                    <p class="text">Posts</p>
                </div>
            </div>
            @if (Auth::check())
                <div class="rating-form">
                    <form action="{{ route('calificar', $usuario->id) }}" method="POST" id="ratingForm">
                        @csrf
                        <!-- <label for="rating">Califica este usuario:</label> -->
                        <div class="rating">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ $rate && $rate->stars == $i ? 'checked' : '' }} />
                                <label for="star{{ $i }}" title="{{ $i }} estrellas"><i class="bi bi-star-fill"></i></label>
                            @endfor
                        </div>
                        <button class="btn-carrito" type="submit">Enviar Calificación</button>
                    </form>
                </div>
            @endif
        </div>
        <div class="user-reports">
            <div style="background-color: #ABC270;"  class="card-reports">
                <i class="bi bi-arrow-left-right"></i>
                <p class="card-report-title">Productos intercambiados</p>
                <p class="countEntries">{{ $intercambiados }}</p>
            </div>
            <div style="background-color: #FEC868;" class="card-reports">
                <i class="bi bi-shop-window"></i>
                <p class="card-report-title">Productos vendidos</p>
                <p class="countEntries">{{ $vendidos }}</p>
            </div>
            <div style="background-color: #473C33;" class="card-reports">
                <i class="bi bi-bag-heart"></i>
                <p class="card-report-title">Productos donados</p>
                <p class="countEntries">{{ $donados }}</p>
            </div>
        </div>
    </div>

    @if($publicaciones->isEmpty())
        <h4>No hay publicaciones para mostrar.</h4>
    @else
        <div class="user-publications">
            <div class="cards-container">
                @foreach ($publicaciones as $publicacion)
                    <div class="publicacion-card">
                        <a href="{{ route('publicaciones.detalle', $publicacion->id) }}">
                            <div class="image-container">
                                <img src="{{ Voyager::image($publicacion->image) }}" alt="{{ $publicacion->title }}">
                            </div>
                            <div class="publicacion-content">
                                <p class="publicacion-title">{{ $publicacion->title }}</p>
                                <p class="publicacion-text">{{ $publicacion->category->name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $publicaciones->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endif

</div>
@endsection