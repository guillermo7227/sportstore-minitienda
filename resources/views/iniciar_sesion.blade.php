@extends('master')
@section('title', 'Iniciar Sesión')
@section('content')
<div class="row mt-2" >
    <div class="mx-auto" style="width: 24rem;">

        <div class="card " >
            <h2 class="card-header">Iniciar Sesión</h2>
            <div class="card-body">
                <form action="{{ route('autenticacion.autenticar') }}" method="GET">
                    @csrf
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="alert alert-danger p-0">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <span class="alert alert-danger p-0">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Iniciar sesión</button>
                    </div>
                </form>
            </div>

        </div>
        <small class="row mx-auto">
            Puede iniciar sesión con las siguientes credenciales: <br>
            <div class="col-6">
                <strong>Perfil administrador</strong><br>
                Usuario: admin@admin.com <br>
                Contraseña: admin <br>
            </div>
            <div class="col-6">
                <strong>Perfil normal</strong> <br>
                Usuario: guille@agudelo.com <br>
                Contraseña: guille
            </div>
        </small>
    </div>
</div>
@endsection
