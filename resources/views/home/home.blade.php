@extends("layouts.app")

@section("content")
<div class="home-detail-container">
    <div class="home-details">
        <h1 class="home-title">EcoLoop</h1>
        <p class="home-subtitle">Jardin Botanico Padre Julio Marrero</p>
        <p class="home-description">Es el primer Jardín Botánico del Ecuador acreditado por Botanic Gardens Conservation
            International. Este es el resultado de una evaluación a las acciones en investigación científica, colecciones de plantas,
            conservación de especies, horticultura, educación, cultura y especialmente en el trabajo que busca continuamente integrar a la comunidad.</p>
    </div>
    <div class="home-image">
        <img src="{{ asset('storage/Jardin-Botanico.jpg') }}" alt="Jardín Botánico">
    </div>
</div>
@endsection