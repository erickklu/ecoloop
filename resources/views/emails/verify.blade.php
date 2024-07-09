<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de correo electrónico</title>
    <style>
        .first-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .btn-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .btn-verify {
            margin-top: 10px;
            border: none;
            background-color: #94A861;
            color: white;
            padding: 10px;
            border-radius: 8px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="first-container">
        <h1>Bienvenido!</h1>
        <p>Ha creado exitosamente una cuenta en EcoLoop.</p>
        <p>Antes de empezar haga click en el enlace de abajo para verificar su correo electrónico y completar su
            registro:</p>

        <div class="btn-container">
            <a class="btn-verify" href="{{ route('verification.verify', ['token' => $token]) }}">Verificar Correo</a>
        </div>
    </div>
</body>

</html>