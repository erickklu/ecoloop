@extends("layouts.app")

@section("content")
<div class="home-detail-container">
    <div class="home-details">
        <h1 class="home-title">EcoLoop</h1>
        <p class="home-subtitle">Reutiliza, Recicla y Reinventa</p>
        <p class="home-description">Con EcoLoop, creemos en el poder del intercambio, la venta y la donación para crear
            una comunidad más sostenible y conectada. Nuestra plataforma está diseñada para facilitar que las
            personas intercambien, vendan y donen objetos que ya no necesitan, fomentando una economía circular y
            reduciendo el desperdicio.</p>
        <p class="home-description">Ya sea que estés buscando encontrar un nuevo hogar para esos objetos que ya no usas o estés en busca de algo
            especial, EcoLoop es el lugar perfecto para ti.</p>
        <p class="home-description">Con nuestra aplicación, puedes:</p>
        <ul class="home-description">
            <li>Intercambiar objetos</li>
            <li>Vender productos</li>
            <li>Donar objetos</li>
        </ul>
    </div>
    <div class="home-image">
        <img src="{{ asset('storage/Jardin-Botanico.jpg') }}" alt="Jardín Botánico">
    </div>
</div>
@endsection