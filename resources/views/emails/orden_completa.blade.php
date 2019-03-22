<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
    h1,h2,h3,h4 {
        margin-bottom: 4px;
    }
    td,th {
        border: 1px solid gray;
        padding: 4px;
    }
    .text-right {
        text-align: right;
    }
    .text-center {
        text-align: center;
    }
    .negrita {
        font-weight: bold;
    }
</style>
<h2>¡Su orden fue registrada!</h2>
<h3>Detalles de la orden:</h3>
<h4>Resumen</h4>
<table>
    <tbody>
            <tr>
                <td class="negrita">Cliente</td>
                <td>{{ $orden->user->name }}</td>
            </tr>
            <tr>
            <td class="negrita">ID</td>
            <td>{{ $orden->id }}</td>
        </tr>
        <tr>
            <td class="negrita">Total items</td>
            <td>{{ $orden->total_items }}</td>
        </tr>
        <tr>
            <td class="negrita">Total Orden</td>
            <td class="text-right">@formatcurrency($orden->total_orden)</td>
        </tr>
        <tr>
            <td class="negrita">Fecha</td>
            <td>@formatdate($orden->created_at)</td>
        </tr>
        <tr>
            <td class="negrita">Enviado</td>
            <td>{{ $orden->enviado ? 'Si' : 'No' }}</td>
        </tr>
    </tbody>
</table>

<h4>Productos comprados</h4>
<table>
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
<table>
    <tbody>
        <tr>
            <td class="negrita">Nombre</td>
            <td>{{ $orden->nombre }}</td>
        </tr>
        <tr>
            <td class="negrita">Dirección</td>
            <td>{{ $orden->direccion }}</td>
        </tr>
        <tr>
            <td class="negrita">Ciudad</td>
            <td>{{ $orden->ciudad }}</td>
        </tr>
        <tr>
            <td class="negrita">Estado</td>
            <td>{{ $orden->estado }}</td>
        </tr>
        <tr>
            <td class="negrita">Código Postal</td>
            <td>{{ $orden->codigo_postal }}</td>
        </tr>
        <tr>
            <td class="negrita">País</td>
            <td>{{ $orden->pais }}</td>
        </tr>
    </tbody>
</table>
