<table class="table table-striped table-responsive table-hover mx-auto">
    <thead>
        <td style="border: none;"></td>
        <th>ID</th>
        <th>Nombre</th>
        <th>Ciudad</th>
        <th>Enviado</th>
        <th>Detalle</th>
    </thead>
    <tbody>
        @foreach ($ordenes as $orden)
            <tr>
                <td>
                    <small><a href="{{ route('ordenes.show', ['orden' => $orden]) }}"
                        class="btn btn-outline-info fa fa-eye fa-lg "
                        title="Ver detalles de la Orden"></a>
                    </small>
                </td>
                <td>{{ $orden->id }}</td>
                <td>{{ $orden->nombre }}</td>
                <td class="wrap">{{ $orden->ciudad . ', ' . $orden->pais }}</td>
                <td>{{ $orden->enviado ? 'Si' : 'No' }}</td>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                @if (\Auth::user()->esAdmin())
                    <td class="ancho-comandos"><small>
                        <form class="mr-1 float-left" action="{{ route('ordenes.enviar', ['orden' => $orden]) }}" method="post">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="1" name="enviado">
                            <button type="submit"
                                class="fa fa-truck fa-lg btn btn-info text-white"
                                title="Marcar la orden como 'Enviada'"
                                {{ $orden->enviado ? 'disabled' : '' }}>
                            </button>
                        </form>
                        <form  action="{{ route('ordenes.destroy', ['orden' => $orden]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit"
                                class="fa fa-trash fa-lg btn btn-danger eliminarOrden"
                                title="Eliminar esta orden">
                            </button>
                        </form></small>
                    </td>
                @endif
            </tr>
            @php
                // $lineas_orden = $orden->detalles->where('orden_id', $orden->id)->get();
            @endphp
            @foreach ($orden->detalles as $linea)
                <tr>
                    <td colspan="5"></td>
                    <td>{{ $linea->nombre }}</td>
                    <td class="text-center">{{ $linea->cantidad }}</td>
                    <td class="text-right nowrap">@formatcurrency($linea->total_linea)</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6"></td>
                <td>Total</td>
                <td class="text-right nowrap">@formatcurrency($orden->total_orden)</td>
            </tr>
        @endforeach
    </tbody>
</table>
