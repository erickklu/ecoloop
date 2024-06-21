@extends('voyager::auth.master')

@section('content')
<div class="login-container" style="top: 40%;">
    <p>Regístrate</p>

    <form action="{{ url('/register') }}" method="POST">
        {{ csrf_field() }}

        <div class="form-group form-group-default" id="nameGroup">
            <label>Nombre</label>
            <div class="controls">
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Nombre"
                    class="form-control" required>
            </div>
        </div>

        <div class="form-group form-group-default" id="emailGroup">
            <label>Email</label>
            <div class="controls">
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email"
                    class="form-control" required>
            </div>
        </div>

        <div class="form-group form-group-default" id="passwordGroup">
            <label>Contraseña</label>
            <div class="controls">
                <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
            </div>
        </div>

        <div class="form-group form-group-default" id="passwordConfirmGroup">
            <label>Confirmar Contraseña</label>
            <div class="controls">
                <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña"
                    class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-block login-button">
            <span class="register">Regístrate</span>
        </button>
    </form>
    <div class="register-container">
        <a href="{{ route('voyager.login') }}">
            <button type="button" class="btn btn-block login-button" style="margin-left:10px;">
                Volver
            </button>
        </a>
    </div>

    @if(!$errors->isEmpty())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection

@section('post_js')
<script>
    var btn = document.querySelector('button[type="submit"]');
    var form = document.forms[0];
    var email = document.querySelector('[name="email"]');
    var password = document.querySelector('[name="password"]');

    btn.addEventListener('click', function (ev) {
        if (form.checkValidity()) {
            btn.querySelector('.signingin').className = 'signingin';
            btn.querySelector('.signin').className = 'signin hidden';
        } else {
            ev.preventDefault();
        }
    });

    email.focus();
    document.getElementById('emailGroup').classList.add("focused");

    email.addEventListener('focusin', function () {
        document.getElementById('emailGroup').classList.add("focused");
    });
    email.addEventListener('focusout', function () {
        document.getElementById('emailGroup').classList.remove("focused");
    });

    password.addEventListener('focusin', function () {
        document.getElementById('passwordGroup').classList.add("focused");
    });
    password.addEventListener('focusout', function () {
        document.getElementById('passwordGroup').classList.remove("focused");
    });
</script>
@endsection