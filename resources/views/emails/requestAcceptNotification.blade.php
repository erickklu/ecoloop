<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud Confirmada</title>
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
    </style>
</head>

<body>
    <h1>Tu solicitud ha sido confirmada</h1>
    <p>Hola {{ $requestedEntry->user->name }},</p>
    <p>Nos complace informarte que tu solicitud para la publicación "{{ $requestedEntry->entry->title }}" ha sido
        confirmada.</p>
    <p>Puedes comunicarte con el dueño de la publicación a través de su WhatsApp:</p>
    <div class="btn-container">
        <a class="btn-verify" href="{{ $whatsappLink }}">Enviar mensaje por WhatsApp</a>
    </div>
    <p>Gracias por usar EcoLoop.</p>
</body>

</html>