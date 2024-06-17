@extends("layouts.app")
@section('title', 'Publicaciones')

@section("content")
<div class="categories-container" style="background-image: url('{{Voyager::image(Voyager::setting('admin.bg_image'))}}');">
    @foreach($categorias as $categoria)
        @php
            $iconos = [
                'En Venta' => 'bi bi-shop-window',
                'Donación' => 'bi bi-bag-heart',
                'Intercambio' => 'bi bi-arrow-left-right',
            ];
            $icono = $iconos[$categoria->name] ?? 'bi bi-question-circle';
        @endphp

        <a href="{{ route('publicaciones.categoria', $categoria->id) }}"
            class="{{ isset($categoryId) && $categoryId == $categoria->id ? 'category-card-active text-light' : '' }}">
            <div class="category-card">
                <i class="{{ $icono }} category-icon"></i>
                {{ $categoria->name }}
            </div>
        </a>
    @endforeach
</div>
<h1>Publicaciones</h1>
<div class="cards-container">
    @foreach ($publicaciones as $publicacion)

        <div class="publicacion-card">
            <a href="{{ route('publicaciones.detalle', $publicacion->id) }}">
                <div class="image-container">
                    <!-- <img src="{{ Voyager::image($publicacion->image) }}" alt="..."> -->
                    <div class="category-overlay">{{ $publicacion->category->name }}</div>
                    <img src="{{ url($publicacion->image) }}" alt="">

                </div>
                <div class="publicacion-content">
                    <p class="publicacion-title">{{ $publicacion->title }}</p>
                    <!-- <p class="card-text">{!! nl2br(strip_tags($publicacion->description)) !!}</p> -->
                    <!-- <p class="publicacion-text">{{ $publicacion->category->name }}</p> -->
                </div>
            </a>
        </div>
    @endforeach

</div>
<div class="d-flex justify-content-center mt-4">
    {{ $publicaciones->links('pagination::bootstrap-4') }}
</div>

@endsection