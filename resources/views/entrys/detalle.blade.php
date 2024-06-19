@extends("layouts.app")

@section("content")
<div class="product-detail-container">
    <div class="product-image">
        <!-- <img style="width:625px;" src="{{ Voyager::image($publicacion->image) }}" alt="..."> -->
        <img style="width:625px;" src="{{ url($publicacion->image) }}" alt="...">
    </div>
    <div class="product-details">
        <form action="{{ route('publicaciones.favorita', $publicacion->id) }}" method="POST">
            @csrf
            <button type="submit" class="favorite-heart">
                @if (in_array($publicacion->id, $favoritas))
                    <i class="bi bi-heart-fill"></i>
                @else
                    <i class="bi bi-heart"></i>
                @endif
            </button>
        </form>
        @if (Auth::id() == $publicacion->user->id)
                <a href="{{ route('voyager.entries.edit', ['id' => $publicacion->id]) }}" class="btn-edit"><i class="bi bi-pencil-square"></i></a>
            @endif
        <h1 class="product-title">{{ $publicacion->title }}</h1>
        <p class="product-user">Por <a class="user-name"
                href="{{ route('perfil', ['id' => $publicacion->user->id]) }}">{{ $publicacion->user->name }}</a></p>
        <p class="product-description">{!! nl2br(strip_tags($publicacion->description)) !!}</p>
        <form action="{{ route('solicitar', $publicacion->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn-carrito">

            
            Agregar al carrito
            </button>
        </form>
        <!-- <a href="{{ route('publicaciones') }}" class="btn-carrito">Agregar al carrito</a> -->
    </div>
</div>

<p class="relacion-title">Publicaciones Relacionadas</p>
<div class="related-container">
    @foreach($relacionadas as $relacionada)
        <div class="related-card">
            <a href="{{ route('publicaciones.detalle', $relacionada->id) }}">
                <!-- <img src="{{ Voyager::image($relacionada->image) }}" alt="{{ $relacionada->title }}"> -->
                <img src="{{ url($relacionada->image) }}" alt="{{ $relacionada->title }}">
                <div class="related-content">
                    <p class="related-title">{{ $relacionada->title }}</p>
                    <p class="related-category">{{ $relacionada->category->name }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection