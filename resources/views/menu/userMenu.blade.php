@php
    use TCG\Voyager\Facades\Voyager;
@endphp


<nav class="navbar">
    <div class="navbar-brand">
        <a href="#">EcoLoop</a>
    </div>
    <div class="navbar-toggle" id="navbarToggle">
        ☰
    </div>
    <ul class="navbar-menu" id="navbarMenu">
        @php
            if (Voyager::translatable($items)) {
                $items = $items->load('translations');
            }
        @endphp

        @foreach ($items as $item)
                @php
                    $originalItem = $item;
                    if (Voyager::translatable($item)) {
                        $item = $item->translate($options->locale);
                    }
                @endphp
                <li class="nav-item">
                    <a class="nav-link" href="{{ url($item->link()) }}" target="{{ $item->target }}">
                        {{ $item->title }}
                    </a>
                    @if (!$originalItem->children->isEmpty())
                        @include('voyager::menu.default', ['items' => $originalItem->children, 'options' => $options])
                    @endif
                </li>
        @endforeach
        @if (Auth::check())
            <li class="nav-item">
                <a class="nav-link login" style="padding: 0;">
                    <form action="{{ route('voyager.logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button style="padding: 14px 20px;border-radius: 8px; border: none;" type="submit" class="nav-link login">Hola, {{ Auth::user()->name }}</button>
                    </form>
                </a>

            </li>
        @else
            <li class="nav-item">
                <a class="nav-link login" href="{{ route('voyager.login') }}">Iniciar sesión</a>
            </li>
        @endif
    </ul>
</nav>

<style>
    /* Estilos del navbar */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 164px;
        /* background-color: #333; */
        padding: 0 80px;
        /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); */
        font-size: 20px;
        font-weight: 500;
        font-family: 'Inter', sans-serif;
    }

    .navbar-brand a {
        color: black;
        text-decoration: none;
        /* font-size: 20px; */
    }

    .navbar-menu {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .navbar-menu li {
        margin-left: 20px;
    }

    .navbar-menu a {
        color: black;
        text-decoration: none;
        padding: 14px 20px;
        display: block;
        border-radius: 8px;
        /* font-size: 20px; */
    }

    .nav-link.login {
        background-color: #ABC270;
        font-size: 16px;
        color: white;
    }

    .nav-link.login:hover {
        background-color: #94A861;
    }

    .navbar-menu a:hover {
        /* background-color: #575757; */
    }




    /* celular */
    .navbar-toggle {
        display: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .navbar-menu {
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: #333;
            display: none;
        }

        .navbar-menu.show {
            display: flex;
        }

        .navbar-menu li {
            margin: 0;
        }

        .navbar-toggle {
            display: block;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var navbarToggle = document.getElementById('navbarToggle');
        var navbarMenu = document.getElementById('navbarMenu');

        navbarToggle.addEventListener('click', function () {
            navbarMenu.classList.toggle('show');
        });
    });
</script>