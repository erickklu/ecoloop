<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/sass/app.scss')
    <title>Verificar Correo</title>
    <style>
        .first-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100%;
            flex-direction: column;
            background-color: #94A861;
        }

        .verify-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background-color: white;
            border-radius: 8px;
            padding: 30px;
        }

        a{
            text-decoration: underline;
            color: blue;
        }

        .verify-email{
            font-weight: bold;
        }

        .btn-verify {
            background-color: #FEC868;
            border-radius: 8px;
            padding: 3px;
        }
    </style>
</head>

<body>
    <div class="first-container">
        <div class="verify-container">
            <h1>Verificación de Correo Electrónico Requerida</h1>
            <p>Hemos enviado un correo de verificación a: <p class="verify-email">{{ auth()->user()->email}}</p></p>
            <p>Para acceder a esta página, por favor verifica tu correo electrónico.</p>
            <p>Si no has recibido el correo de verificación, puedes solicitar uno nuevo:</p>
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button class="btn-verify" type="submit">Reenviar Correo de Verificación</button>
            </form>
            <a href="{{ route('home') }}">Volver a la página principal</a>
        </div>
    </div>

</body>

</html>