@extends('master')
@section('title', 'Tu Carrito')
@section('content')
    <h2 class="text-center mt-3">Tu Carrito</h2>
    <div class="table-responsive">
    <table class="table table-stripped ">
        <thead>
            <th>Cantidad</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Subtotal</th>
        </thead>
        <tbody>
            @foreach ($carrito->lineas() as $linea)
                <tr>
                    <td class="">
                        <form action="{{ route('carrito.modificarcantidad', ['producto' => $linea['producto']->id]) }}"
                              method="GET" class="form-horizontal nowrap">
                            @csrf
                            <input type="number" value="{{ $linea['cantidad'] }}" name="cantidad">
                            <button class="btn btn-outline-primary btn-sm fa fa-save fa-lg" type="submit" title="Guardar cantidad y actualizar carrito"></button>
                            @foreach ($errors->all() as $error)
                                <br><span class="alert alert-danger p-0">{{ $error }}</span>
                            @endforeach
                        </form>
                    </td>
                    <td>{{ $linea['producto']->nombre }}</td>
                    <td class="text-right nowrap">
                        @formatcurrency($linea['producto']->precio)
                    </td>
                    <td class="text-right nowrap">
                        @formatcurrency($linea['total_linea'])
                    </td>
                    <td class=text-center>
                        <a href="{{ route('carrito.eliminar', ['producto' => $linea['producto']->id]) }}"
                           class="btn btn-danger btn-sm fa fa-trash fa-lg eliminarProducto"
                           title="Eliminar producto del carrito">
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">
                    Total
                </th>
                <th class="text-right">
                    @formatcurrency($carrito->total_carrito())
                </th>
            </tr>
        </tfoot>
    </table>
    </div>
    <div class="text-center">
        <a class="btn btn-outline-success m-1" href="{{ route('tienda.index') }}">
            Continuar comprando
        </a>
        <a class="btn btn-primary" href="{{ route('ordenes.create') }}">
            Completar la compra
        </a>
    </div>
@endsection
@section('script')
    @include('tienda.carrito_js')
@endsection
