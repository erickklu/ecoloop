@php
    use TCG\Voyager\Facades\Voyager;
@endphp


<nav class="navbar">
    <div class="navbar-brand">
        <a href="#">EcoLoop</a>
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
<!-- 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var navbarToggle = document.getElementById('navbarToggle');
        var navbarMenu = document.getElementById('navbarMenu');

        navbarToggle.addEventListener('click', function () {
            navbarMenu.classList.toggle('show');
        });
    });
</script> -->