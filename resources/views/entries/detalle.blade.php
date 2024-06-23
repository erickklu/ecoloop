@extends("layouts.app")

@section("content")
<div class="product-detail-container">
    <meta name="success-message" content="{{ session('success') }}">
    <div class="product-image">
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
        <img src="{{ Voyager::image($publicacion->image) }}" alt="{{$publicacion->image}}">
        <!-- <img style="width:625px;" src="{{ url($publicacion->image) }}" alt="..."> -->
    </div>
    <div class="product-details">
        <h1 class="product-title">{{ $publicacion->title }}</h1>
        <div class="container-content">
            @if (Auth::id() == $publicacion->user->id)
                <!-- <a href="{{ route('voyager.entries.edit', ['id' => $publicacion->id]) }}" class="btn-edit"
                                placeholder="Editar"><i class="bi bi-pencil-square"></i></a> -->
                <div class="dropdown float-end">
                    <button class="btn btn-sm btn-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a href="{{ route('voyager.entries.edit', ['id' => $publicacion->id]) }}" class="dropdown-item"
                                placeholder="Editar">Editar publicación</a>
                        </li>
                    </ul>
                </div>
            @endif
            <p class="product-user">Por <a title="Ver usuario" class="user-name"
                    href="{{ route('perfil', ['id' => $publicacion->user->id]) }}">{{ $publicacion->user->name }}</a>
            </p>
            <p class="product-description">{!! nl2br(strip_tags($publicacion->description)) !!}</p>
            <!--  @php
            $solicitudExistente = \App\Models\RequestedEntry::where('user_id', Auth::id())
                ->where('entry_id', $publicacion->id)
                ->first();
        @endphp -->
            <form action="{{ route('solicitar', $publicacion->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-solicitud {{ $solicitudExistente ? 'btn-eliminar' : 'btn-enviar' }}">
                    {{ $solicitudExistente ? 'Eliminar solicitud' : 'Enviar solicitud' }}
                </button>
            </form>
            <!-- <a href="{{ route('publicaciones') }}" class="btn-carrito">Agregar al carrito</a> -->
        </div>

    </div>
</div>

<p class="relacion-title">Publicaciones Relacionadas</p>
<div class="related-container">
    @foreach($relacionadas as $relacionada)
        <div class="related-card">
            <a href="{{ route('publicaciones.detalle', $relacionada->id) }}">
                <img src="{{ Voyager::image($relacionada->image) }}" alt="{{ $relacionada->title }}">
                <!-- <img src="{{ url($relacionada->image) }}" alt="{{ $relacionada->title }}"> -->
                <div class="related-content">
                    <p class="related-title">{{ $relacionada->title }}</p>
                    <p class="related-category">{{ $relacionada->category->name }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection