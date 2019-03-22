@extends('master')
@section('title', 'Detalles de la Orden')
@section('content')
    <h3 class="text-center">Detalles de la Orden</h3>
    <h4>Resumen</h4>
    <table class="table w-auto table-hover table-striped">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $orden->id }}</td>
            </tr>
            <tr>
                <th>ID Usuario</th>
                <td>{{ $orden->user->id }}</td>
            </tr>
            <tr>
                <th>Total items</th>
                <td>{{ $orden->total_items }}</td>
            </tr>
            <tr>
                <th>Total Orden</th>
                <td>@formatcurrency($orden->total_orden)</td>
            </tr>
            <tr>
                <th>Fecha</th>
                <td>@formatdate($orden->created_at)</td>
            </tr>
            <tr>
                <th>Enviado</th>
                <td>{{ $orden->enviado ? 'Si' : 'No' }}</td>
            </tr>
        </tbody>
    </table>

    <h4>Productos comprados</h4>
    <table class="table table-striped table-hover table-responsive">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Categoria</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total línea</th>
        </thead>
        <tbody>
            @foreach ($orden->detalles as $linea)
                <tr>
                    <td>{{ $linea->producto_id }}</td>
                    <td>{{ $linea->nombre }}</td>
                    <td>{{ $linea->descripcion }}</td>
                    <td>{{ $linea->categoria }}</td>
                    <td class="text-right">@formatcurrency($linea->precio)</td>
                    <td class="text-center">{{ $linea->cantidad }}</td>
                    <td class="text-right">@formatcurrency($linea->total_linea)</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Información de Envío</h4>
    <table class="table w-auto  table-hover table-striped">
        <tbody>
            <tr>
                <th>Nombre</th>
                <td>{{ $orden->nombre }}</td>
            </tr>
            <tr>
                <th>Dirección</th>
                <td>{{ $orden->direccion }}</td>
            </tr>
            <tr>
                <th>Ciudad</th>
                <td>{{ $orden->ciudad }}</td>
            </tr>
            <tr>
                <th>Estado</th>
                <td>{{ $orden->estado }}</td>
            </tr>
            <tr>
                <th>Código Postal</th>
                <td>{{ $orden->codigo_postal }}</td>
            </tr>
            <tr>
                <th>País</th>
                <td>{{ $orden->pais }}</td>
            </tr>
        </tbody>
    </table>

    <div class="text-center">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
