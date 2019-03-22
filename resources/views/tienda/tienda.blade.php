@extends('master')
@section('title', 'Home')
@section('content')
    <div class="row">
        <div class="col-sm-3 p-2">
            <a class="btn btn-block btn-outline-primary" href="/">
                Home
            </a>
            @foreach ($categorias as $categoria)
                <a class="btn btn-outline-primary btn-block container wrap"
                   href="{{ route('tienda.categoria', ['categoria' => $categoria]) }}">
                    {{ $categoria }}
                </a>
            @endforeach
            @if (\Auth::check())
                <a href="{{ route('ordenes.misordenes') }}" class="btn btn-outline-info btn-block mt-5">
                    Ver Mis Órdenes
                </a>
            @endif
            <a href="{{ route('admin.index') }}" class="btn btn-outline-danger btn-block mt-5">
                Admin
            </a>
            <a href="{{ route('acercade') }}" class="btn btn-outline-secondary btn-block">
                Acerca de
            </a>
        </div>

        <div class="col-sm-9 p-2">
            <h3 class="text-center">{{ $categoria_actual }}</h3>
            @foreach ($productos as $producto)
                <div class="border border-primary rounded mb-2">
                    <span class="badge badge-pill badge-primary float-right m-2 p-2">
                        @formatcurrency($producto->precio)
                    </span>
                    <div class="container pl-1">
                        <img src="{{ $producto->imagen ? $producto->imagen : asset('img/img-no-disponible.jpg') }}"
                            class="img-producto ">
                        <span class="mb-2 pl-2 h4 d-block d-sm-inline">
                            {{ $producto->nombre }}
                        </span>
                    </div>
                    <div class="card-text m-2">
                        <div class="row">
                            <div class="col-8">
                                {{ $producto->descripcion }}
                            </div>
                            <div class="col-4">
                                <a class="btn btn-success btn-sm float-right"
                                   href="{{ route('carrito.agregar', ['producto' => $producto->id]) }}">
                                    <strong>Agregar al Carrito</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $productos->links() }}
        </div>

    </div>
@endsection
