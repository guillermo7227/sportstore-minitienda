@extends('master')
@section('title', 'Editar Producto')
@section('content')
    <h2 class="text-center">Editar Producto</h2>
    <form action="{{ route('productos.update', ['producto' => $producto]) }}" class="form" method="post">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label>ID</label>
            <input class="form-control" type="text" disabled value="{{ $producto->id }}">
        </div>
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre"
                value="{{ $errors->has('nombre') ? old('nombre') : $producto->nombre }}">
            @if ($errors->has('nombre'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('nombre') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Categoría</label>
            <input list="categorias" class="form-control" name="categoria"
                value="{{ $errors->has('categoria') ? old('categoria') : $producto->categoria }}">
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
            <textarea name="descripcion" class="form-control">{{
                $errors->has('descripcion') ? old('descripcion') : $producto->descripcion }}
            </textarea>
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
                <input type="text" class="form-control" name="precio"
                    value="{{ $errors->has('precio') ? old('precio') : $producto->precio }}">
            </div>
            @if ($errors->has('precio'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('precio') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Imagen (URL)</label>
            <input type="text" class="form-control" name="imagen"
                value="{{ $errors->has('imagen') ? old('imagen') : $producto->imagen }}">
            @if ($errors->has('imagen'))
                <span class="alert alert-danger p-0">
                    {{ $errors->first('imagen') }}
                </span>
            @endif
        </div>

        <div class="text-center">
            <a class="btn btn-secondary" href="{{ route('productos.index') }}">Volver</a>
            <button class="btn btn-primary" type="submit">Actualizar Producto</button>
        </div>
    </form>
@endsection
