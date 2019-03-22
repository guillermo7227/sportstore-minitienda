@extends('master')
@section('content')
    <h2 class="text-center">Mis Órdenes</h2>
    <div class="mb-1 row mx-auto">
        <h4 class="col-sm-6">Lista de Órdenes</h4>
        <form class="col-sm-6" action="{{ route('ordenes.misordenes') }}" method="get">
            <input type="checkbox" name="mostrarEnviadas" id="mostrarEnviadas" {{ app('request')->input('mostrarEnviadas') ? 'checked="true' : '' }}">
            <label for="mostrarEnviadas">Mostrar Órdenes enviadas</label>
        </form>
    </div>
    @include('ordenes.partials.lista_ordenes')
    {{ $ordenes->links() }}
@endsection
@section('script')
    @include('ordenes.mis_ordenes_js')
@endsection
