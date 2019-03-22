@extends('master')
@section('title', 'Información de Envío')
@section('content')
    <h3 class="text-center">Información de envío</h3>
    <form action="{{ route('ordenes.store') }}" method="POST" class="mx-auto w-75">
        @csrf
        <div class="form-group">
            <label>Nombre</label>
            <input class="form-control" name="nombre" value="{{ old('nombre') }}"/>
            @if ($errors->has('nombre'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('nombre') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Dirección</label>
            <input class="form-control" name="direccion" value="{{ old('direccion') }}" />
            @if ($errors->has('direccion'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('direccion') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Ciudad</label>
            <input class="form-control" name="ciudad" value="{{ old('ciudad') }}"/>
            @if ($errors->get('ciudad'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('ciudad') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Estado/Provincia/Departamento</label>
            <input class="form-control" name="estado" value="{{ old('estado') }}"/>
            @if ($errors->has('estado'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('estado') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Código Postal</label>
            <input class="form-control" name="codigo_postal" value="{{ old('codigo_postal') }}"/>
        </div>
        <div class="form-group">
            <label>País</label>
            <input class="form-control" name="pais" value="{{ old('pais') }}"/>
            @if ($errors->has('pais'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('pais') }}
                </span>
            @endif
        </div>
        <div class="text-center">
            <a class="btn btn-outline-secondary" href="{{ route('carrito.index') }}">
                Volver
            </a>
            <button class="btn btn-primary" type="submit">
                Finalizar Orden
            </button>
        </div>
    </form>
@endsection
