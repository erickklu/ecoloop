<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>Verificar Correo</title>
    <style :scope>
        body,
        html {
            font-family: 'Inter', sans-serif;
            /* background-color: #EAECED; */
        }

        .first-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100%;
            flex-direction: column;
            /* background-color: rgba(0, 0, 0, 0.06); */


        }

        .verify-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background-color: white;
            border-radius: 8px;
            padding: 60px;
            box-shadow: 0px 0px 25px 0px rgba(0,0,0,0.12);
        }


        a {
            text-decoration: none;
        }

        p {
            margin: 0;
        }

        .verify-email {
            font-weight: bold;
        }

        .btn-home {
            margin-top: 20px;
            border: none;
            background-color: #94A861;
            color: white;
            padding: 10px;
            border-radius: 8px;
        }

        .footer-container {
            display: flex;
            width: 100%;
            
            justify-content: center;
            align-items: center;

            margin-top: 30px;
            padding-top: 17px;
            border-top: 2px solid rgba(0, 0, 0, 0.1);
        }


        .btn-send-verify {
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: bold;
            background: none;
            border: none;
            padding: 0;
            margin-left: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="first-container">
        <div class="verify-container">
            <h1>Verificación de Correo Electrónico</h1>

            <p>Hemos enviado un correo electrónico de verificación a su cuenta.</p>
            <p>Despues de recibir el correo electrónico, siga el enlace proporcionado para completar su registro.</p>

            <a class="btn-home" href="{{ route('home') }}">Volver a la página principal</a>

            <div class="footer-container">
                <p>Si no has recibido ningun correo de confirmación </p>
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button class="btn-send-verify" type="submit">Reenviar Correo de Verificación</button>
                </form>
            </div>


        </div>
    </div>

</body>

</html>