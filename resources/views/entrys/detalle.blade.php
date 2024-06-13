@extends("layouts.app")

@section("content")
<div class="product-detail-container">
    <div class="product-image">
        <img style="width:625px;" src="{{ Voyager::image($publicacion->image) }}" class="card-img-top" alt="...">
    </div>
    <div class="product-details">
        <h1 class="product-title">{{ $publicacion->title }}</h1>
        <p class="product-user">Por {{ $publicacion->user->name }}</p>
        <p class="product-description">{!! nl2br(strip_tags($publicacion->description)) !!}</p>
        <a href="{{ route('publicaciones') }}" class="btn btn-primary">Agregar al carrito</a>
    </div>
</div>

<p class="relacion-title">Publicaciones Relacionadas</p>
<div class="related-container">
    @foreach($relacionadas as $relacionada)
        <div class="related-card">
            <a href="{{ route('publicaciones.detalle', $relacionada->id) }}">
                <img src="{{ Voyager::image($relacionada->image) }}" alt="{{ $relacionada->title }}">
                <div class="related-content">
                    <p class="related-title">{{ $relacionada->title }}</p>
                    <p class="related-category">{{ $relacionada->category->name }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection