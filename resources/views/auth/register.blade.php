@extends('voyager::auth.master')

@section('content')
<div class="login-container" style="top: 21%;">
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

        <div class="form-group form-group-default" id="wtspGroup">
            <label>Numero de Whatsapp</label>
            <div class="controls">
                <input type="number" name="whatsapp" id="whatsapp" placeholder="Whatsapp" class="form-control" required>
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

        <div class="form-group" id="checkGroup">
            <label id="data_protection"> <input type="checkbox" name="data_protection" id="data_protection" required> Estoy de acuerdo con la <a href="/privacy-policy">política de privacidad</a>.</label>
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

    <div style="clear:both"></div>

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
