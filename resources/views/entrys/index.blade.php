@extends("layouts.app")
@section('title', 'Publicaciones')

@section("content")
<div class="content-wrapper">
    <div class="categories-container"
        style="background-image: url('{{ Voyager::image(Voyager::setting('admin.bg_image')) }}');">
        <div class="container-title-categories">
            <h4 class="title-text-category">Categorias</h4>
        </div>

        @foreach($categorias as $categoria)
                @php
                    $iconos = [
                        'En Venta' => 'bi bi-shop-window',
                        'Donación' => 'bi bi-bag-heart',
                        'Intercambio' => 'bi bi-arrow-left-right',
                    ];
                    $backgrounds = [
                        'En Venta' => 'venta-bg',
                        'Donación' => 'donacion-bg',
                        'Intercambio' => 'intercambio-bg',
                    ];
                    $icono = $iconos[$categoria->name] ?? 'bi bi-question-circle';
                    $background = $backgrounds[$categoria->name] ?? '';
                    $isActive = isset($categoryId) && $categoryId == $categoria->id;
                @endphp

                <a href="{{ route('publicaciones', ['category_id' => $categoria->id, 'from_date' => $fromDate, 'to_date' => $toDate]) }}"
                    class="{{ $isActive ? $background : '' }}">
                    <div class="category-card {{ $isActive ? $background : '' }}">
                        <i class="{{ $icono }} category-icon"></i>
                        <div class="category-text">
                            <p class="category-title">{{ $categoria->name }}</p>
                            <p class="small-text">{{ $categoria->publicaciones_count }} publicaciones</p>
                        </div>
                    </div>
                </a>
        @endforeach
        <!-- <h3 class="subtitle-text">Filtrar por:</h3> -->
        <div class="filtros-container">
            <h3 class="title-text-category">Filtros</h3>
            <form method="GET" action="{{ route('publicaciones') }}" class="form-filtros">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <div class="form-content">
                    <div class="date-fields">
                        <div class="form-group">
                            <label class="label-form" for="from_date">Desde:</label>
                            <input type="date" id="from_date" name="from_date" class="form-control"
                                value="{{ request('from_date') }}">
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="to_date">Hasta:</label>
                            <input type="date" id="to_date" name="to_date" class="form-control"
                                value="{{ request('to_date') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="sort_by">Ordenar por:</label>
                        <select id="sort_by" name="sort_by" class="form-control">
                            <option value="" {{ request('sort_by') == '' ? 'selected' : '' }}>Seleccionar</option>
                            <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Más reciente
                            </option>
                            <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Más antiguo
                            </option>
                            <option value="az" {{ request('sort_by') == 'az' ? 'selected' : '' }}>A-Z</option>
                            <option value="za" {{ request('sort_by') == 'za' ? 'selected' : '' }}>Z-A</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-filtrar">Filtrar</button>
                    </div>
                </div>
            </form>



        </div>


    </div>
    <div class="entries-container">
        <div class="publicaciones">
            <h1 class="title-text">Publicaciones</h1>
            @auth
                <div class="button-add-entries-container">
                    <a href="{{ route('voyager.entries.create') }}" class="add-entries"><i
                            class="bi bi-plus"></i><!-- Crear Publicación --></a>
                </div>
            @endauth


        </div>

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
                                    <!-- <img src="{{ url($publicacion->image) }}" alt=""> -->
                                    <img src="{{ Voyager::image($publicacion->image) }}" alt="{{ $publicacion->title }}">
                                </div>
                                <div class="publicacion-content">
                                    <p class="publicacion-title">{{ $publicacion->title }}</p>
                                </div>
                            </a>
                        </div>
            @endforeach

        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $publicaciones->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection