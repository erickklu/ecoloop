<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Correo</title>
</head>
<body>
    <h1>Verificación de Correo Electrónico Requerida</h1>
    <p>Para acceder a esta página, por favor verifica tu correo electrónico.</p>
    <p>Si no has recibido el correo de verificación, puedes solicitar uno nuevo.</p>
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Reenviar Correo de Verificación</button>
    </form>
    <a href="{{ route('home') }}">Volver a la página principal</a>
</body>
</html>
