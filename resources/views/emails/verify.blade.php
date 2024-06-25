<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de correo electrónico</title>
</head>

<body>
    <h1>Bienvenido,</h1>
    <p>Has creado exitosamente una cuenta en EcoLoop.</p>
    <p>Haz click en el enlace de abajo para verificar su correo electrónico y completar su registro:</p>
    <a href="{{ route('verification.verify', ['token' => $token]) }}">Verificar Correo</a>
</body>

</html>