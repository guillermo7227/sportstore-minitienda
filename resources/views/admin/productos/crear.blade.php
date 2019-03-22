@extends('master')
@section('title', 'Crear Producto')
@section('content')
    <h2 class="text-center">Crear Producto</h2>
    <form action="{{ route('productos.store') }}" class="form" method="post">
        @csrf
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">
            @if ($errors->has('nombre'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('nombre') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Categoría</label>
            <input list="categorias" class="form-control" name="categoria" value="{{ old('categoria') }}">
            <datalist id="categorias">
                @foreach ($categorias as $categoria)
                    <option>{{ $categoria }}</option>
                @endforeach
            </datalist>
            @if ($errors->has('categoria'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('categoria') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
            @if ($errors->has('descripcion'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('descripcion') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Precio</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input type="text" class="form-control" name="precio" value="{{ old('precio') }}">
            </div>
            @if ($errors->has('precio'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('precio') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Imagen (URL)</label>
            <input type="text" class="form-control" name="imagen" value="{{ old('imagen') }}">
            @if ($errors->has('imagen'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('imagen') }}
                </span>
            @endif
        </div>
        <div class="text-center">
            <a class="btn btn-secondary" href="{{ route('productos.index') }}">Volver</a>
            <button class="btn btn-primary" type="submit">Guardar Producto</button>
        </div>
    </form>

@endsection
