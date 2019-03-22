<table class="table table-striped table-hover table-responsive">
    <thead>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Categoría</th>
        <th>Precio</th>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->categoria }}</td>
                <td class="text-right nowrap">@formatcurrency($producto->precio)</td>
                <td class="nowrap">
                    <form action="{{ route('productos.destroy', ['producto' => $producto]) }}" class="form-inline" method="post">
                        @method('DELETE')
                        @csrf
                        <small>
                            <a href="{{ route('productos.edit', ['producto' => $producto]) }}"
                                class="fa fa-edit fa-lg btn btn-info text-white"
                                title="Editar este producto"></a>
                            <button type="submit" title="Eliminar este producto"
                                class="fa fa-trash fa-lg btn btn-danger eliminarProducto">
                            </button>
                        </small>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
