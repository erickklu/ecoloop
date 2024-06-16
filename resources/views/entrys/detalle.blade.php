@extends("layouts.app")

@section("content")
<div class="product-detail-container">
    <div class="product-image">
        <!-- <img style="width:625px;" src="{{ Voyager::image($publicacion->image) }}" alt="..."> -->
        <img style="width:625px;" src="{{ url($publicacion->image) }}" alt="...">
    </div>
    <div class="product-details">
        <!-- <a href="" class="favorite-heart">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart"
                viewBox="0 0 16 16">
                <path
                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
            </svg>
        </a> -->
        <form action="{{ route('publicaciones.favorita', $publicacion->id) }}" method="POST">
            @csrf
            <button type="submit" class="favorite-heart">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart"
                    viewBox="0 0 16 16">
                    <path
                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                </svg>
            </button>
        </form>
        <h1 class="product-title">{{ $publicacion->title }}</h1>
        <p class="product-user">Por {{ $publicacion->user->name }}</p>
        <p class="product-description">{!! nl2br(strip_tags($publicacion->description)) !!}</p>
        <a href="{{ route('publicaciones') }}" class="btn-carrito">Agregar al carrito</a>
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