<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>@yield("title")</title>
    
    @stack("css")
    @yield('styles')
    <!-- <style>
       /*  body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }
        .container {
            padding: 0 80px;
            padding-bottom: 80px;
        } */
    </style> -->
</head>

<body>
    {!! menu('user', 'menu.userMenu') !!}
    <div class="contenedor">
        @yield('content')
    </div>
    
</body>

</html>