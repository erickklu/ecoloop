@extends("layouts.app")
@section('title', 'Publicaciones')

@section("content")
<div class="content-wrapper">
    <div class="categories-container"
        style="background-image: url('{{ Voyager::image(Voyager::setting('admin.bg_image')) }}');">
        <h1 class="title-text">Categorias</h1>
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
                        <div class="category-text">
                            <p class="category-title">{{ $categoria->name }}</p>
                            <p class="small-text">{{ $categoria->publicaciones_count }} publicaciones</p>
                        </div>
                    </div>
                </a>
        @endforeach
    </div>
    <div class="publicaciones">
        <h1 class="title-text">Publicaciones</h1>
        <div class="cards-container">

            @foreach ($publicaciones as $publicacion)
                        @php
                            $colores = [
                                'En Venta' => 'venta-bg',
                                'Donación' => 'donacion-bg',
                                'Intercambio' => 'intercambio-bg',
                            ];
                            $colorClase = $colores[$publicacion->category->name] ?? 'default-bg';
                        @endphp
                        <div class="publicacion-card">
                            <a href="{{ route('publicaciones.detalle', $publicacion->id) }}">
                                <div class="image-container">
                                    <div class="category-overlay {{ $colorClase }}">{{ $publicacion->category->name }}</div>
                                    <img src="{{ url($publicacion->image) }}" alt="">
                                </div>
                                <div class="publicacion-content">
                                    <p class="publicacion-title">{{ $publicacion->title }}</p>
                                </div>
                            </a>
                        </div>
            @endforeach

        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $publicaciones->links('pagination::bootstrap-4') }}
        </div>
    </div>

</div>
@endsection