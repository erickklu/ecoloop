<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Nueva Solicitud</title>
</head>
<body>
    <div class="first-container">
        <h1>Tienes una nueva solicitud en tu publicación</h1>
    <p>Hola {{ $requestedEntry->entry->user->name ?? 'Usuario' }},</p>
    <p>{{ $requestedEntry->user->name ?? 'Un usuario' }} ha solicitado tu publicación "{{ $requestedEntry->entry->title ?? 'Título desconocido' }}".</p>
    <p>Puedes ver la solicitud en tu panel.</p>
    <a href="{{ route('voyager.requested_entries.index') }}">Ir al panel</a>
    <p>Gracias!</p>
    </div>
    
</body>
</html>
