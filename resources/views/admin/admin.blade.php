@extends('master')
@section('title', 'Administración')
@section('content')
    <h2 class="text-center">Administración</h2>
    <div class="row">
            <div class="col-sm-3 mb-2">
                <a href="{{ route('productos.index') }}"
                    class="btn btn-outline-primary btn-block wrap">
                    Productos
                </a>
                <a href="{{ route('ordenes.index') }}"
                    class="btn btn-block btn-outline-primary wrap">
                    Órdenes
                </a>
            </div>
            <div class="col-sm-9">
                @if (isset($productos))
                    <div class="mb-1 row">
                        <h4 class="col-sm-6">Lista de Productos</h4>
                        <a href="{{ route('productos.create') }}" class="btn btn-primary col-sm-3 ml-auto">Crear Nuevo Producto</a>
                    </div>
                    @include('admin.partials.lista_productos')
                    {{ $productos->links() }}
                @elseif (isset($ordenes))
                    <div class="mb-1 row">
                        <h4 class="col-sm-6">Lista de Órdenes</h4>
                        <form action="{{ route('ordenes.index') }}" method="get" class="col-sm-6">
                            <input type="checkbox" name="mostrarEnviadas" id="mostrarEnviadas" {{ app('request')->input('mostrarEnviadas') ? 'checked="true' : '' }}">
                            <label for="mostrarEnviadas">Mostrar Órdenes enviadas</label>
                        </form>
                    </div>
                    @include('ordenes.partials.lista_ordenes')
                    {{ $ordenes->links() }}
                @else
                    <p>Por favor, seleccione del menú la entidad que quiera tratar.</p>
                    <p>La sección 'Productos' permite ver, modificar, agregar o eliminar Productos de la base de datos.</p>
                    <p>La sección 'Órdenes' permite ver y eliminar las órdenes realizadas por los clientes. También puede marcar una orden como 'Enviada' y puede filtrar las órdenes que faltan por enviar.</p>
                @endif
            </div>
        </div>
@endsection
@section('script')
    @include('admin.admin_js')
@endsection
