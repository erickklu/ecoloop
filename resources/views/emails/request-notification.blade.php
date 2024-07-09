<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Nueva Solicitud</title>
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
        <h1>Tienes una nueva solicitud en tu publicación</h1>
        <p>Hola {{ $requestedEntry->entry->user->name ?? 'Usuario' }},</p>
        <p>{{ $requestedEntry->user->name ?? 'Un usuario' }} ha solicitado tu publicación
            "{{ $requestedEntry->entry->title ?? 'Título desconocido' }}".</p>
        <p>Puedes ver la solicitud en tu panel.</p>
        <div class="btn-container">
            <a class="btn-verify" href="{{ route('voyager.requested_entries.index') }}">Ir al panel</a>
        </div>

        <p>Gracias!</p>
    </div>

</body>

</html>