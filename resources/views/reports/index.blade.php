@extends('layouts.app')

@section('title', 'Perfil de usuario')

@section('content')

<div class="report-container">
    <h1>Reporte de Publicaciones</h1>
    <div class="user-reports">
            <div style="background-color: #ABC270;" class="card-reports">
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
    <h2>Productos Vendidos</h2>
    @if($sold->isEmpty())
        <p>No hay Productos vendidos.</p>
    @else
        <ul>
            @foreach($sold as $publication)
                <li>{{ $publication->title }} - {{ $publication->user->name }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Productos Intercambiados</h2>
    @if($exchanged->isEmpty())
        <p>No hay Productos intercambiados.</p>
    @else
        <ul>
            @foreach($exchanged as $publication)
                <li>{{ $publication->title }} - {{ $publication->user->name }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Productos Donados</h2>
    @if($donated->isEmpty())
        <p>No hay Productos donados.</p>
    @else
        <ul>
            @foreach($donated as $publication)
                <li>{{ $publication->title }} - {{ $publication->user->name }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Productos Disponibles</h2>
    @if($available->isEmpty())
        <p>No hay Productos disponibles.</p>
    @else
        <ul>
            @foreach($available as $publication)
                <li>{{ $publication->title }} - {{ $publication->user->name }}</li>
            @endforeach
        </ul>
    @endif
</div>

@endsection