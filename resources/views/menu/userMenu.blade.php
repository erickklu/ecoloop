<nav class="navbar">
    <div class="navbar-brand">
        <a>EcoLoop</a>
    </div>
    <div class="navbar-toggle" onclick="toggleNavbar()" aria-label="Toggle navigation">
        &#9776; 
    </div>
    
    <ul class="navbar-menu" id="navbarMenu">
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
            <li class="nav-item dropdown">
                <a class="nav-link login" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0;">
                    <button class="nav-link login dropdown-toggle" type="submit">
                        Hola, {{ Auth::user()->name }}
                    </button>
                </a>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('perfil', ['id' => Auth::user()->id]) }}">Perfil</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('favoritos') }}">Mis favoritos</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('voyager.entries.index')}}">Panel</a>
                    </li>
                    <li>
                        <a style="color:red;" class="dropdown-item" href="{{ route('voyager.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link login" href="{{ route('voyager.login') }}">Iniciar sesión</a>
            </li>
        @endif

        <form id="logout-form" action="{{ route('voyager.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</nav>